<?php

namespace App\Http\Controllers;

use App\Imports\CustomersImport;
use App\Models\Customer;
use App\Models\Meter;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Maatwebsite\Excel\Facades\Excel;
use Throwable;

class CustomerImportController extends Controller
{
    /**
     * Fixed billing tariff.
     */
    private const TARIFF_PER_UNIT = 120.00;

    /**
     * Maximum meter reading used by the system.
     */
    private const MAXIMUM_READING = 9999.00;

    /**
     * Display the customer import page.
     */
    public function create()
    {
        return view('customers.import');
    }

    /**
     * Read the uploaded Excel file and display the preview.
     *
     * Nothing is saved to the database at this stage.
     */
    public function preview(Request $request)
    {
        $request->validate([
            'file' => [
                'required',
                'file',
                'mimes:xlsx,xls,csv',
                'max:10240',
            ],
        ]);

        try {
            $import = new CustomersImport();

            Excel::import($import, $request->file('file'));

            $rows = $import->rows();

            if ($rows->isEmpty()) {
                return back()
                    ->withInput()
                    ->withErrors([
                        'file' => 'The spreadsheet does not contain any customer rows.',
                    ]);
            }

            $result = $this->processRows($rows);

            return view('customers.import-preview', [
                'processed' => $result['processed'],
                'valid' => $result['valid'],
                'duplicates' => $result['duplicates'],
                'errors' => $result['errors'],
                'totalRows' => $result['totalRows'],
            ]);
        } catch (Throwable $e) {
            Log::error('Customer Excel import preview failed.', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return back()
                ->withInput()
                ->withErrors([
                    'file' => 'The spreadsheet could not be processed. Please check the file format and try again.',
                ]);
        }
    }

    /**
     * Confirm and save the imported customers and meters.
     *
     * No historical bills, payments or meter-reading transactions
     * are created by this import.
     */
    public function confirm(Request $request)
    {
        $rows = $request->input('rows', []);

        if (!is_array($rows) || empty($rows)) {
            return redirect()
                ->route('customers.import.create')
                ->withErrors([
                    'file' => 'There are no valid customer records to import.',
                ]);
        }

        $imported = 0;
        $skipped = 0;

        try {
            DB::transaction(function () use ($rows, &$imported, &$skipped) {
                foreach ($rows as $row) {
                    if (!is_array($row)) {
                        $skipped++;
                        continue;
                    }

                    /*
                     * Only import rows explicitly marked as valid.
                     */
                    if (($row['status'] ?? '') !== 'valid') {
                        $skipped++;
                        continue;
                    }

                    $accountNumber = trim((string) ($row['account_number'] ?? ''));

                    if ($accountNumber === '') {
                        $skipped++;
                        continue;
                    }

                    /*
                     * Protect against a customer being created twice.
                     */
                    if (Customer::where('customer_number', $accountNumber)->exists()) {
                        $skipped++;
                        continue;
                    }

                    $firstName = trim((string) ($row['first_name'] ?? ''));
                    $secondName = trim((string) ($row['second_name'] ?? ''));

                    $fullName = trim(
                        preg_replace(
                            '/\s+/',
                            ' ',
                            $firstName . ' ' . $secondName
                        )
                    );

                    if ($fullName === '') {
                        $skipped++;
                        continue;
                    }

                    $phoneNumber = $this->normalizePhone(
                        $row['phone_number'] ?? null
                    );

                    $area = trim((string) ($row['area'] ?? ''));

                    $previousReading = $this->nullableNumber(
                        $row['previous_reading'] ?? null
                    );

                    $currentReading = $this->nullableNumber(
                        $row['current_reading'] ?? null
                    );

                    if ($previousReading === null || $currentReading === null) {
                        $skipped++;
                        continue;
                    }

                    /*
                     * Create the customer using the ACTUAL columns
                     * in the Maji Mazuri customers table.
                     */
                    $customer = Customer::create([
                        'customer_number' => $accountNumber,
                        'full_name' => $fullName,
                        'id_number' => null,
                        'phone_number' => $phoneNumber,
                        'email' => null,
                        'area' => $area !== '' ? $area : null,
                        'address' => null,
                        'status' => 'active',
                        'credit_balance' => 0,
                    ]);

                    /*
                     * IMPORTANT:
                     *
                     * Excel "Meter no" = customer's existing account number.
                     *
                     * The system generates its OWN meter number:
                     * MTR-0001, MTR-0002, etc.
                     */
                    $meterNumber = $this->generateNextMeterNumber();

                    Meter::create([
                        'customer_id' => $customer->id,
                        'meter_number' => $meterNumber,
                        'installation_date' => now()->toDateString(),
                        'initial_reading' => $previousReading,
                        'current_reading' => $currentReading,
                        'maximum_reading' => self::MAXIMUM_READING,
                        'status' => 'active',
                    ]);

                    /*
                     * We deliberately do NOT create:
                     *
                     * - bills
                     * - payments
                     * - meter reading history
                     * - previous balance transactions
                     *
                     * The Excel previous/current values become the
                     * meter's initial/current readings only.
                     */

                    $imported++;
                }
            });

            return redirect()
                ->route('customers.index')
                ->with('success', "{$imported} customer(s) imported successfully. {$skipped} row(s) skipped.");
        } catch (Throwable $e) {
            Log::error('Customer Excel import confirmation failed.', [
                'message' => $e->getMessage(),
                'file' => $e->getFile(),
                'line' => $e->getLine(),
            ]);

            return redirect()
                ->route('customers.import.create')
                ->withErrors([
                    'file' => 'The import could not be completed. No records were saved. Please check the spreadsheet and try again.',
                ]);
        }
    }

    /**
     * Process spreadsheet rows for preview.
     *
     * This method does NOT write anything to the database.
     */
    private function processRows(Collection $rows): array
    {
        $processed = [];
        $valid = [];
        $duplicates = [];
        $errors = [];

        $generatedCustomerNumbers = [];
        $generatedMeterNumbers = [];

        /*
         * Reserve all explicit account numbers from the spreadsheet.
         *
         * This prevents an automatically generated M0001-style account
         * from colliding with an explicit account number appearing later.
         */
        $reservedCustomerNumbers = [];

        foreach ($rows as $rawRow) {
            $row = $this->normalizeRow($rawRow);

            if ($this->rowIsBlank($row)) {
                continue;
            }

            if (!empty($row['account_number'])) {
                $reservedCustomerNumbers[] = strtoupper(
                    trim($row['account_number'])
                );
            }
        }

        $reservedCustomerNumbers = array_unique($reservedCustomerNumbers);

        $rowNumber = 1;

        foreach ($rows as $rawRow) {
            $rowNumber++;

            $row = $this->normalizeRow($rawRow);

            if ($this->rowIsBlank($row)) {
                continue;
            }

            $rowErrors = [];

            $firstName = trim((string) ($row['first_name'] ?? ''));
            $secondName = trim((string) ($row['second_name'] ?? ''));

            $fullName = trim(
                preg_replace(
                    '/\s+/',
                    ' ',
                    $firstName . ' ' . $secondName
                )
            );

            $accountNumber = trim(
                (string) ($row['account_number'] ?? '')
            );

            $area = trim(
                (string) ($row['area'] ?? '')
            );

            $phoneNumber = $this->normalizePhone(
                $row['phone_number'] ?? null
            );

            $previousReading = $this->nullableNumber(
                $row['previous_reading'] ?? null
            );

            $currentReading = $this->nullableNumber(
                $row['current_reading'] ?? null
            );

            /*
             * Customer name.
             */
            if ($fullName === '') {
                $rowErrors[] = 'First name or Second name is required.';
            }

            /*
             * Account number.
             *
             * Excel "Meter no" is treated as the customer's
             * existing account/customer number.
             */
            if ($accountNumber !== '') {
                $accountNumber = strtoupper($accountNumber);

                if (!preg_match('/^M\d+$/i', $accountNumber)) {
                    $rowErrors[] = 'Meter no / account number must use the customer number format, for example M0001.';
                }
            } else {
                /*
                 * Only generate a customer number when Excel
                 * did not provide one.
                 */
                $accountNumber = $this->generateNextCustomerNumber(
                    $generatedCustomerNumbers,
                    $reservedCustomerNumbers
                );

                $generatedCustomerNumbers[] = $accountNumber;
            }

            /*
             * Previous reading.
             */
            if ($previousReading === null) {
                $rowErrors[] = 'Previous readings is required.';
            } elseif ($previousReading < 0) {
                $rowErrors[] = 'Previous reading cannot be negative.';
            } elseif ($previousReading > self::MAXIMUM_READING) {
                $rowErrors[] = 'Previous reading cannot exceed 9999.';
            }

            /*
             * Current reading.
             */
            if ($currentReading === null) {
                $rowErrors[] = 'Current readings is required.';
            } elseif ($currentReading < 0) {
                $rowErrors[] = 'Current reading cannot be negative.';
            } elseif ($currentReading > self::MAXIMUM_READING) {
                $rowErrors[] = 'Current reading cannot exceed 9999.';
            }

            /*
             * Phone number is optional, but if supplied it must
             * be converted into a usable Kenyan format.
             */
            if (
                !empty($row['phone_number']) &&
                $phoneNumber === null
            ) {
                $rowErrors[] = 'The contact number is not a valid Kenyan phone number.';
            }

            /*
             * Check whether the customer number already exists.
             */
            $existingCustomer = Customer::where(
                'customer_number',
                $accountNumber
            )->first();

            if ($existingCustomer) {
                $rowErrors[] = "Customer {$accountNumber} already exists in the system.";

                $duplicates[] = [
                    'row_number' => $rowNumber,
                    'account_number' => $accountNumber,
                    'full_name' => $fullName,
                    'customer' => $existingCustomer->full_name,
                ];
            }

            /*
             * Calculate consumption.
             *
             * Normal case:
             * 14 - 12 = 2
             *
             * Rollover case:
             * 20 after 9999 = 20 units consumed
             */
            $consumption = null;

            if (
                $previousReading !== null &&
                $currentReading !== null
            ) {
                if ($currentReading >= $previousReading) {
                    $consumption = $currentReading - $previousReading;
                } else {
                    $consumption =
                        (self::MAXIMUM_READING - $previousReading)
                        + $currentReading;
                }
            }

            $amount = $consumption !== null
                ? round($consumption * self::TARIFF_PER_UNIT, 2)
                : null;

            /*
             * Previous balance and paid are used ONLY for preview.
             *
             * They are deliberately NOT imported as historical
             * billing/payment records.
             */
            $previousBalance = $this->nullableNumber(
                $row['previous_balance'] ?? null
            );

            $paid = $this->nullableNumber(
                $row['paid'] ?? null
            );

            $currentBalance = null;

            if ($previousBalance !== null && $amount !== null) {
                $currentBalance = max(
                    0,
                    round(
                        $previousBalance
                        + $amount
                        - ($paid ?? 0),
                        2
                    )
                );
            }

            /*
             * Generate the system meter number for preview.
             */
            $systemMeterNumber = $this->generateNextMeterNumber(
                $generatedMeterNumbers
            );

            $generatedMeterNumbers[] = $systemMeterNumber;

            $status = empty($rowErrors)
                ? 'valid'
                : 'error';

            $processedRow = [
                'row_number' => $rowNumber,

                'first_name' => $firstName,
                'second_name' => $secondName,
                'full_name' => $fullName,

                /*
                 * Excel Meter no.
                 * This is the customer's account/customer number.
                 */
                'account_number' => $accountNumber,

                /*
                 * System-generated physical meter number.
                 */
                'meter_number' => $systemMeterNumber,

                'phone_number' => $phoneNumber,
                'area' => $area,

                'previous_reading' => $previousReading,
                'current_reading' => $currentReading,

                'consumption' => $consumption,
                'amount' => $amount,

                'previous_balance' => $previousBalance,
                'paid' => $paid,
                'current_balance' => $currentBalance,

                'status' => $status,
                'errors' => $rowErrors,
            ];

            $processed[] = $processedRow;

            if ($status === 'valid') {
                $valid[] = $processedRow;
            } else {
                $errors[] = $processedRow;
            }
        }

        return [
            'processed' => $processed,
            'valid' => $valid,
            'duplicates' => $duplicates,
            'errors' => $errors,
            'totalRows' => count($processed),
        ];
    }

    /**
     * Normalize a spreadsheet row into the fields used by the importer.
     */
    private function normalizeRow($row): array
    {
        $normalized = [];

        foreach ($row as $header => $value) {
            $header = $this->normalizeHeader($header);

            if ($header === '') {
                continue;
            }

            $normalized[$header] = is_string($value)
                ? trim($value)
                : $value;
        }

        return [
            'first_name' => $this->firstAvailable(
                $normalized,
                [
                    'first name',
                    'firstname',
                    'first',
                ]
            ),

            'second_name' => $this->firstAvailable(
                $normalized,
                [
                    'second name',
                    'secondname',
                    'last name',
                    'lastname',
                    'surname',
                ]
            ),

            /*
             * IMPORTANT:
             *
             * "Meter no" from the client's Excel is the
             * existing customer/account number.
             */
            'account_number' => $this->firstAvailable(
                $normalized,
                [
                    'meter no',
                    'meter number',
                    'meter',
                    'account number',
                    'account no',
                    'account',
                    'customer number',
                    'customer no',
                ]
            ),

            'phone_number' => $this->firstAvailable(
                $normalized,
                [
                    'contact',
                    'phone',
                    'phone number',
                    'mobile',
                    'mobile number',
                ]
            ),

            'area' => $this->firstAvailable(
                $normalized,
                [
                    'region',
                    'area',
                ]
            ),

            'previous_reading' => $this->firstAvailable(
                $normalized,
                [
                    'previous readings',
                    'previous reading',
                    'previous',
                    'opening reading',
                    'opening',
                ]
            ),

            'current_reading' => $this->firstAvailable(
                $normalized,
                [
                    'current readings',
                    'current reading',
                    'current',
                ]
            ),

            'previous_balance' => $this->firstAvailable(
                $normalized,
                [
                    'previous balance',
                    'balance',
                    'outstanding balance',
                ]
            ),

            'paid' => $this->firstAvailable(
                $normalized,
                [
                    'paid',
                    'payment',
                    'amount paid',
                ]
            ),
        ];
    }

    /**
     * Find the first matching value from a normalized row.
     */
    private function firstAvailable(array $row, array $keys)
    {
        foreach ($keys as $key) {
            if (
                array_key_exists($key, $row) &&
                $row[$key] !== null &&
                trim((string) $row[$key]) !== ''
            ) {
                return $row[$key];
            }
        }

        return null;
    }

    /**
     * Normalize spreadsheet header names.
     */
    private function normalizeHeader($header): string
    {
        $header = trim((string) $header);

        $header = strtolower($header);

        $header = str_replace(
            ['_', '-', '/'],
            ' ',
            $header
        );

        $header = preg_replace(
            '/\s+/',
            ' ',
            $header
        );

        return trim($header);
    }

    /**
     * Determine whether a spreadsheet row is empty.
     */
    private function rowIsBlank(array $row): bool
    {
        foreach ($row as $value) {
            if (
                $value !== null &&
                trim((string) $value) !== ''
            ) {
                return false;
            }
        }

        return true;
    }

    /**
     * Convert numeric spreadsheet values safely.
     */
    private function nullableNumber($value): ?float
    {
        if ($value === null) {
            return null;
        }

        if (is_string($value)) {
            $value = trim($value);

            if ($value === '') {
                return null;
            }

            /*
             * Remove commas and currency symbols that may appear
             * in Excel exports.
             */
            $value = str_replace(
                [',', 'KSh', 'KES'],
                '',
                $value
            );

            $value = trim($value);
        }

        if (!is_numeric($value)) {
            return null;
        }

        return round((float) $value, 2);
    }

    /**
     * Normalize Kenyan phone numbers.
     *
     * Examples:
     * 0792245880 -> 254792245880
     * 0722123456 -> 254722123456
     * +254792245880 -> 254792245880
     * 254792245880 -> 254792245880
     */
    private function normalizePhone($phone): ?string
    {
        if ($phone === null) {
            return null;
        }

        $phone = trim((string) $phone);

        if ($phone === '') {
            return null;
        }

        /*
         * Excel sometimes converts numbers to formats such as
         * 792245880.0
         */
        if (
            preg_match(
                '/^(\d+)\.0+$/',
                $phone,
                $matches
            )
        ) {
            $phone = $matches[1];
        }

        /*
         * Remove spaces, brackets, hyphens and other formatting.
         */
        $phone = preg_replace(
            '/[^0-9+]/',
            '',
            $phone
        );

        if (str_starts_with($phone, '+254')) {
            $phone = '254' . substr($phone, 4);
        } elseif (str_starts_with($phone, '254')) {
            // Already normalized.
        } elseif (str_starts_with($phone, '0')) {
            $phone = '254' . substr($phone, 1);
        } elseif (
            strlen($phone) === 9 &&
            (
                str_starts_with($phone, '7') ||
                str_starts_with($phone, '1')
            )
        ) {
            $phone = '254' . $phone;
        } else {
            return null;
        }

        if (!preg_match('/^254(7|1)\d{8}$/', $phone)) {
            return null;
        }

        return $phone;
    }

    /**
     * Generate the next available customer number.
     *
     * This is used ONLY when Excel does not provide
     * an account/customer number.
     */
    private function generateNextCustomerNumber(
        array $generatedNumbers = [],
        array $reservedNumbers = []
    ): string {
        $highest = 0;

        $existingNumbers = Customer::query()
            ->where('customer_number', 'like', 'M%')
            ->pluck('customer_number');

        foreach ($existingNumbers as $number) {
            if (
                preg_match(
                    '/^M(\d+)$/i',
                    (string) $number,
                    $matches
                )
            ) {
                $highest = max(
                    $highest,
                    (int) $matches[1]
                );
            }
        }

        foreach ($generatedNumbers as $number) {
            if (
                preg_match(
                    '/^M(\d+)$/i',
                    (string) $number,
                    $matches
                )
            ) {
                $highest = max(
                    $highest,
                    (int) $matches[1]
                );
            }
        }

        do {
            $highest++;

            $candidate = 'M' . str_pad(
                (string) $highest,
                4,
                '0',
                STR_PAD_LEFT
            );
        } while (
            Customer::where(
                'customer_number',
                $candidate
            )->exists()
            ||
            in_array(
                strtoupper($candidate),
                array_map('strtoupper', $reservedNumbers),
                true
            )
            ||
            in_array(
                strtoupper($candidate),
                array_map('strtoupper', $generatedNumbers),
                true
            )
        );

        return $candidate;
    }

    /**
     * Generate the next system meter number.
     *
     * These are completely separate from customer/account numbers.
     *
     * Example:
     * MTR-0001
     * MTR-0002
     * MTR-0003
     */
    private function generateNextMeterNumber(
        array $generatedMeterNumbers = []
    ): string {
        $highest = 0;

        $existingNumbers = Meter::query()
            ->where('meter_number', 'like', 'MTR-%')
            ->pluck('meter_number');

        foreach ($existingNumbers as $number) {
            if (
                preg_match(
                    '/^MTR-(\d+)$/i',
                    (string) $number,
                    $matches
                )
            ) {
                $highest = max(
                    $highest,
                    (int) $matches[1]
                );
            }
        }

        foreach ($generatedMeterNumbers as $number) {
            if (
                preg_match(
                    '/^MTR-(\d+)$/i',
                    (string) $number,
                    $matches
                )
            ) {
                $highest = max(
                    $highest,
                    (int) $matches[1]
                );
            }
        }

        do {
            $highest++;

            $candidate = 'MTR-' . str_pad(
                (string) $highest,
                4,
                '0',
                STR_PAD_LEFT
            );
        } while (
            Meter::where(
                'meter_number',
                $candidate
            )->exists()
            ||
            in_array(
                strtoupper($candidate),
                array_map('strtoupper', $generatedMeterNumbers),
                true
            )
        );

        return $candidate;
    }
}