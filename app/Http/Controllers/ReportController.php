<?php

namespace App\Http\Controllers;

use App\Models\Bill;
use App\Models\Customer;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    private const PAYMENT_METHODS = [
        'cash',
        'mpesa',
        'bank',
    ];

    /**
     * Display the reports dashboard.
     *
     * The existing Reports filters and the Income Report filters
     * intentionally remain separate.
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | EXISTING REPORT FILTERS
        |--------------------------------------------------------------------------
        */

        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');
        $month = $request->input('month');
        $region = $request->input('region');

        /*
        |--------------------------------------------------------------------------
        | AVAILABLE REGIONS
        |--------------------------------------------------------------------------
        */

        $regions = Customer::query()
            ->whereNotNull('area')
            ->where('area', '!=', '')
            ->select('area')
            ->distinct()
            ->orderBy('area')
            ->pluck('area');

        /*
        |--------------------------------------------------------------------------
        | EXISTING BILLING REPORT
        |--------------------------------------------------------------------------
        */

        $billsQuery = Bill::query();

        if ($startDate) {
            $billsQuery->whereDate(
                'billing_date',
                '>=',
                $startDate
            );
        }

        if ($endDate) {
            $billsQuery->whereDate(
                'billing_date',
                '<=',
                $endDate
            );
        }

        if ($month) {
            if ($selectedMonth = $this->monthStart($month)) {
                $billsQuery
                    ->whereDate(
                        'billing_date',
                        '>=',
                        $selectedMonth->toDateString()
                    )
                    ->whereDate(
                        'billing_date',
                        '<=',
                        $selectedMonth
                            ->copy()
                            ->endOfMonth()
                            ->toDateString()
                    );
            }
        }

        if ($region) {
            $billsQuery->whereHas(
                'customer',
                fn ($query) => $query->where(
                    'area',
                    $region
                )
            );
        }

        $bills = $billsQuery
            ->with('customer')
            ->latest('billing_date')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | EXISTING PAYMENT REPORT
        |--------------------------------------------------------------------------
        */

        $paymentsQuery = Payment::query();

        if ($startDate) {
            $paymentsQuery->whereDate(
                'payment_date',
                '>=',
                $startDate
            );
        }

        if ($endDate) {
            $paymentsQuery->whereDate(
                'payment_date',
                '<=',
                $endDate
            );
        }

        if ($month) {
            if ($selectedMonth = $this->monthStart($month)) {
                $paymentsQuery
                    ->whereDate(
                        'payment_date',
                        '>=',
                        $selectedMonth->toDateString()
                    )
                    ->whereDate(
                        'payment_date',
                        '<=',
                        $selectedMonth
                            ->copy()
                            ->endOfMonth()
                            ->toDateString()
                    );
            }
        }

        if ($region) {
            $paymentsQuery->whereHas(
                'customer',
                fn ($query) => $query->where(
                    'area',
                    $region
                )
            );
        }

        $payments = $paymentsQuery
            ->with('customer', 'bill')
            ->latest('payment_date')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | EXISTING BILLING TOTALS
        |--------------------------------------------------------------------------
        */

        $totalBills = $bills->count();

        $totalBilled = $bills->sum('water_charge');

        $totalPaidAgainstBills = $bills->sum('amount_paid');

        $totalOutstanding = $bills->sum('balance');

        /*
        |--------------------------------------------------------------------------
        | EXISTING BILL STATUS COUNTS
        |--------------------------------------------------------------------------
        */

        $paidBills = $bills
            ->where('status', 'paid')
            ->count();

        $partiallyPaidBills = $bills
            ->where('status', 'partially_paid')
            ->count();

        $unpaidBills = $bills
            ->where('status', 'unpaid')
            ->count();

        /*
        |--------------------------------------------------------------------------
        | EXISTING PAYMENT TOTALS
        |--------------------------------------------------------------------------
        */

        $totalPayments = $payments->count();

        $totalCollected = $payments->sum('amount');

        $cashCollected = $payments
            ->where('payment_method', 'cash')
            ->sum('amount');

        $mpesaCollected = $payments
            ->where('payment_method', 'mpesa')
            ->sum('amount');

        $bankCollected = $payments
            ->where('payment_method', 'bank')
            ->sum('amount');

        /*
        |--------------------------------------------------------------------------
        | EXISTING INCOME BY REGION
        |--------------------------------------------------------------------------
        */

        $incomeByRegion = $payments
            ->groupBy(
                fn ($payment) =>
                    $payment->customer->area ?? 'Unknown'
            )
            ->map(
                fn ($regionPayments, $area) => [
                    'region' => $area,
                    'payments' => $regionPayments->count(),
                    'income' => $regionPayments->sum('amount'),
                ]
            )
            ->sortByDesc('income')
            ->values();

        /*
        |--------------------------------------------------------------------------
        | EXISTING INCOME BY MONTH
        |--------------------------------------------------------------------------
        */

        $incomeByMonth = $payments
            ->groupBy(
                fn ($payment) =>
                    $payment->payment_date
                        ? $payment->payment_date->format('Y-m')
                        : 'Unknown'
            )
            ->map(function ($monthPayments, $monthKey) {
                $label = 'Unknown';

                if ($monthKey !== 'Unknown') {
                    $label =
                        $this->monthStart($monthKey)?->format('F Y')
                        ?? $monthKey;
                }

                return [
                    'month' => $monthKey,
                    'label' => $label,
                    'payments' => $monthPayments->count(),
                    'income' => $monthPayments->sum('amount'),
                ];
            })
            ->sortByDesc('month')
            ->values();

        /*
        |--------------------------------------------------------------------------
        | INCOME REPORT FILTERS
        |--------------------------------------------------------------------------
        |
        | These are intentionally independent from:
        |
        | start_date
        | end_date
        | month
        | region
        |
        */

        $incomePreset = $request->input('income_preset');

        $incomeFromMonth = $request->input('income_from_month');

        $incomeToMonth = $request->input('income_to_month');

        $incomeRegion = $request->input('income_region');

        $incomePaymentMethod = $request->input(
            'income_payment_method'
        );

        /*
        |--------------------------------------------------------------------------
        | VALIDATE PAYMENT METHOD
        |--------------------------------------------------------------------------
        */

        if (
            ! in_array(
                $incomePaymentMethod,
                self::PAYMENT_METHODS,
                true
            )
        ) {
            $incomePaymentMethod = null;
        }

        /*
        |--------------------------------------------------------------------------
        | INCOME REPORT PRESETS
        |--------------------------------------------------------------------------
        */

        if (
            $incomePreset
            && ($range = $this->presetRange($incomePreset))
        ) {
            [
                $incomeFromMonth,
                $incomeToMonth,
            ] = $range;
        }

        /*
        |--------------------------------------------------------------------------
        | COMPLETE SINGLE-MONTH SELECTION
        |--------------------------------------------------------------------------
        */

        if ($incomeFromMonth && ! $incomeToMonth) {
            $incomeToMonth = $incomeFromMonth;
        }

        if ($incomeToMonth && ! $incomeFromMonth) {
            $incomeFromMonth = $incomeToMonth;
        }

        /*
        |--------------------------------------------------------------------------
        | NORMALIZE INCOME MONTH RANGE
        |--------------------------------------------------------------------------
        */

        $incomeFromBounds = $this->monthStart(
            $incomeFromMonth
        );

        $incomeToBounds = $this->monthStart(
            $incomeToMonth
        );

        if (
            ! $incomeFromBounds
            || ! $incomeToBounds
        ) {
            $incomeFromBounds = null;
            $incomeToBounds = null;

            $incomeFromMonth = null;
            $incomeToMonth = null;
        }

        /*
        |--------------------------------------------------------------------------
        | CORRECT REVERSED DATE RANGE
        |--------------------------------------------------------------------------
        */

        if (
            $incomeFromBounds
            && $incomeToBounds
            && $incomeFromBounds->gt($incomeToBounds)
        ) {
            [
                $incomeFromBounds,
                $incomeToBounds,
            ] = [
                $incomeToBounds,
                $incomeFromBounds,
            ];

            [
                $incomeFromMonth,
                $incomeToMonth,
            ] = [
                $incomeToMonth,
                $incomeFromMonth,
            ];
        }

        /*
        |--------------------------------------------------------------------------
        | INCOME DATE RANGE
        |--------------------------------------------------------------------------
        */

        $incomeRangeStart =
            $incomeFromBounds?->toDateString();

        $incomeRangeEnd = $incomeToBounds
            ? $incomeToBounds
                ->copy()
                ->endOfMonth()
                ->toDateString()
            : null;

        /*
        |--------------------------------------------------------------------------
        | INCOME PAYMENTS
        |--------------------------------------------------------------------------
        */

        $incomePaymentsQuery = Payment::query();

        if ($incomeRangeStart) {
            $incomePaymentsQuery->whereDate(
                'payment_date',
                '>=',
                $incomeRangeStart
            );
        }

        if ($incomeRangeEnd) {
            $incomePaymentsQuery->whereDate(
                'payment_date',
                '<=',
                $incomeRangeEnd
            );
        }

        if ($incomeRegion) {
            $incomePaymentsQuery->whereHas(
                'customer',
                fn ($query) => $query->where(
                    'area',
                    $incomeRegion
                )
            );
        }

        if ($incomePaymentMethod) {
            $incomePaymentsQuery->where(
                'payment_method',
                $incomePaymentMethod
            );
        }

        $incomePayments = $incomePaymentsQuery
            ->with('customer', 'bill')
            ->latest('payment_date')
            ->get();

        /*
        |--------------------------------------------------------------------------
        | INCOME BILLS
        |--------------------------------------------------------------------------
        |
        | Used for:
        | - Outstanding amount
        | - Collection rate
        |
        */

        $incomeBillsQuery = Bill::query();

        if ($incomeRangeStart) {
            $incomeBillsQuery->whereDate(
                'billing_date',
                '>=',
                $incomeRangeStart
            );
        }

        if ($incomeRangeEnd) {
            $incomeBillsQuery->whereDate(
                'billing_date',
                '<=',
                $incomeRangeEnd
            );
        }

        if ($incomeRegion) {
            $incomeBillsQuery->whereHas(
                'customer',
                fn ($query) => $query->where(
                    'area',
                    $incomeRegion
                )
            );
        }

        $incomeBills = $incomeBillsQuery->get();

        /*
        |--------------------------------------------------------------------------
        | INCOME TOTALS
        |--------------------------------------------------------------------------
        */

        $incomeTotalPayments = $incomePayments->count();

        $incomeTotalCollected = $incomePayments->sum(
            'amount'
        );

        $incomeCashCollected = $incomePayments
            ->where('payment_method', 'cash')
            ->sum('amount');

        $incomeMpesaCollected = $incomePayments
            ->where('payment_method', 'mpesa')
            ->sum('amount');

        $incomeBankCollected = $incomePayments
            ->where('payment_method', 'bank')
            ->sum('amount');

        /*
        |--------------------------------------------------------------------------
        | INCOME BY REGION
        |--------------------------------------------------------------------------
        */

        $incomeByRegionAnalysis = $incomePayments
            ->groupBy(
                fn ($payment) =>
                    $payment->customer->area ?? 'Unknown'
            )
            ->map(
                fn ($regionPayments, $area) => [
                    'region' => $area,
                    'payments' => $regionPayments->count(),
                    'income' => $regionPayments->sum('amount'),
                ]
            )
            ->sortByDesc('income')
            ->values();

        /*
        |--------------------------------------------------------------------------
        | INCOME BY MONTH
        |--------------------------------------------------------------------------
        |
        | Retained because it is part of the existing Income Report
        | calculations and may be useful to the view later.
        |
        */

        $incomeByMonthAnalysis = $incomePayments
            ->groupBy(
                fn ($payment) =>
                    $payment->payment_date
                        ? $payment->payment_date->format('Y-m')
                        : 'Unknown'
            )
            ->map(function ($monthPayments, $monthKey) {
                $label = 'Unknown';

                if ($monthKey !== 'Unknown') {
                    $label =
                        $this->monthStart($monthKey)?->format('F Y')
                        ?? $monthKey;
                }

                return [
                    'month' => $monthKey,
                    'label' => $label,
                    'payments' => $monthPayments->count(),
                    'income' => $monthPayments->sum('amount'),
                ];
            })
            ->sortByDesc('month')
            ->values();

        /*
        |--------------------------------------------------------------------------
        | CUSTOMERS PAID
        |--------------------------------------------------------------------------
        */

        $incomeCustomersPaid = $incomePayments
            ->pluck('customer_id')
            ->filter()
            ->unique()
            ->count();

        /*
        |--------------------------------------------------------------------------
        | CUSTOMERS IN SCOPE
        |--------------------------------------------------------------------------
        */

        $incomeCustomersInScope = Customer::query()
            ->when(
                $incomeRegion,
                fn ($query) => $query->where(
                    'area',
                    $incomeRegion
                )
            )
            ->count();

        /*
        |--------------------------------------------------------------------------
        | AVERAGE PAYMENT
        |--------------------------------------------------------------------------
        */

        $incomeAveragePayment =
            $incomeTotalPayments > 0
                ? $incomeTotalCollected
                    / $incomeTotalPayments
                : 0;

        /*
        |--------------------------------------------------------------------------
        | INCOME BILLING TOTALS
        |--------------------------------------------------------------------------
        */

        $incomeTotalBilled =
            $incomeBills->sum('water_charge');

        $incomeTotalOutstanding =
            $incomeBills->sum('balance');

        $incomeTotalPaidAgainstBills =
            $incomeBills->sum('amount_paid');

        /*
        |--------------------------------------------------------------------------
        | COLLECTION RATE
        |--------------------------------------------------------------------------
        */

        $incomeCollectionRate =
            $incomeTotalBilled > 0
                ? (int) round(
                    min(
                        100,
                        (
                            $incomeTotalPaidAgainstBills
                            / $incomeTotalBilled
                        ) * 100
                    )
                )
                : 0;

        /*
        |--------------------------------------------------------------------------
        | CHANGE VS PREVIOUS PERIOD
        |--------------------------------------------------------------------------
        */

        $incomeChange = null;

        if ($incomeFromBounds && $incomeToBounds) {
            $months =
                $incomeFromBounds->diffInMonths(
                    $incomeToBounds
                ) + 1;

            $previousStart = $incomeFromBounds
                ->copy()
                ->subMonthsNoOverflow($months)
                ->startOfMonth();

            $previousEnd = $previousStart
                ->copy()
                ->addMonthsNoOverflow($months - 1)
                ->endOfMonth();

            $previousIncomeQuery = Payment::query()
                ->whereDate(
                    'payment_date',
                    '>=',
                    $previousStart->toDateString()
                )
                ->whereDate(
                    'payment_date',
                    '<=',
                    $previousEnd->toDateString()
                );

            if ($incomeRegion) {
                $previousIncomeQuery->whereHas(
                    'customer',
                    fn ($query) => $query->where(
                        'area',
                        $incomeRegion
                    )
                );
            }

            if ($incomePaymentMethod) {
                $previousIncomeQuery->where(
                    'payment_method',
                    $incomePaymentMethod
                );
            }

            $previousIncome =
                $previousIncomeQuery->sum('amount');

            if ($previousIncome > 0) {
                $incomeChange = round(
                    (
                        (
                            $incomeTotalCollected
                            - $previousIncome
                        )
                        / $previousIncome
                    ) * 100
                );
            }
        }

        /*
        |--------------------------------------------------------------------------
        | SIX-MONTH INCOME TREND
        |--------------------------------------------------------------------------
        */

        $trendEnd = (
            $incomeToBounds
            ?? Carbon::now()
        )
            ->copy()
            ->endOfMonth();

        $trendStart = $trendEnd
            ->copy()
            ->subMonthsNoOverflow(5)
            ->startOfMonth();

        $trendPaymentsQuery = Payment::query()
            ->whereDate(
                'payment_date',
                '>=',
                $trendStart->toDateString()
            )
            ->whereDate(
                'payment_date',
                '<=',
                $trendEnd->toDateString()
            );

        if ($incomeRegion) {
            $trendPaymentsQuery->whereHas(
                'customer',
                fn ($query) => $query->where(
                    'area',
                    $incomeRegion
                )
            );
        }

        if ($incomePaymentMethod) {
            $trendPaymentsQuery->where(
                'payment_method',
                $incomePaymentMethod
            );
        }

        $trendPayments = $trendPaymentsQuery->get([
            'payment_date',
            'amount',
        ]);

        $trend = collect(range(0, 5))
            ->map(function ($index) use (
                $trendStart,
                $trendPayments,
                $incomeFromMonth,
                $incomeToMonth
            ) {
                $month = $trendStart
                    ->copy()
                    ->addMonthsNoOverflow($index);

                $key = $month->format('Y-m');

                return [
                    'key' => $key,

                    'label' => $month->format('M'),

                    'income' => $trendPayments
                        ->filter(
                            fn ($payment) =>
                                $payment->payment_date
                                && $payment->payment_date->format('Y-m') === $key
                        )
                        ->sum('amount'),

                    'selected' =>
                        ! $incomeFromMonth
                        || (
                            $key >= $incomeFromMonth
                            && $key <= $incomeToMonth
                        ),
                ];
            });

        /*
        |--------------------------------------------------------------------------
        | INCOME PERIOD / REGION LABELS
        |--------------------------------------------------------------------------
        */

        $incomePeriodLabel = 'all time';

        if ($incomeFromBounds && $incomeToBounds) {
            $incomePeriodLabel =
                $incomeFromMonth === $incomeToMonth
                    ? $incomeFromBounds->format('F Y')
                    : $incomeFromBounds->format('M Y')
                        . ' to '
                        . $incomeToBounds->format('M Y');
        }

        $incomeRegionLabel =
            $incomeRegion ?: 'all regions';

        /*
        |--------------------------------------------------------------------------
        | CSV EXPORT
        |--------------------------------------------------------------------------
        */

        if ($request->input('income_export') === 'csv') {
            return $this->exportCsv(
                $incomePayments
            );
        }

        /*
        |--------------------------------------------------------------------------
        | RETURN REPORTS VIEW
        |--------------------------------------------------------------------------
        |
        | The Income Report is now a normal Blade include:
        |
        | resources/views/reports/income.blade.php
        |
        | No Blade::render(), heredoc template, or HTML injection is needed.
        |
        */

        return view(
            'reports.index',
            compact(
                'bills',
                'payments',
                'startDate',
                'endDate',
                'month',
                'region',
                'regions',

                'totalBills',
                'totalBilled',
                'totalPaidAgainstBills',
                'totalOutstanding',

                'paidBills',
                'partiallyPaidBills',
                'unpaidBills',

                'totalPayments',
                'totalCollected',
                'cashCollected',
                'mpesaCollected',
                'bankCollected',

                'incomeByRegion',
                'incomeByMonth',

                'incomeRegion',
                'incomePreset',
                'incomeFromMonth',
                'incomeToMonth',
                'incomePaymentMethod',

                'incomeTotalPayments',
                'incomeTotalCollected',
                'incomeTotalOutstanding',

                'incomeCashCollected',
                'incomeMpesaCollected',
                'incomeBankCollected',

                'incomeByRegionAnalysis',
                'incomeByMonthAnalysis',

                'incomeCustomersPaid',
                'incomeCustomersInScope',
                'incomeAveragePayment',
                'incomeCollectionRate',
                'incomeChange',

                'trend',

                'incomePeriodLabel',
                'incomeRegionLabel'
            )
        );
    }

    /**
     * Export Income Report payments as CSV.
     */
    private function exportCsv($payments)
    {
        $filename =
            'income-report-'
            . now()->format('Ymd-His')
            . '.csv';

        return response()->streamDownload(
            function () use ($payments) {
                $out = fopen(
                    'php://output',
                    'w'
                );

                fputcsv(
                    $out,
                    [
                        'Date',
                        'Customer',
                        'Customer Number',
                        'Region',
                        'Method',
                        'Amount (KSh)',
                        'Reference',
                    ]
                );

                foreach ($payments as $payment) {
                    fputcsv(
                        $out,
                        [
                            optional(
                                $payment->payment_date
                            )->format('Y-m-d'),

                            $payment->customer->full_name
                                ?? '',

                            $payment->customer->customer_number
                                ?? '',

                            $payment->customer->area
                                ?? 'Unknown',

                            strtoupper(
                                (string) $payment->payment_method
                            ),

                            $payment->amount,

                            $payment->reference_number
                                ?? '',
                        ]
                    );
                }

                fclose($out);
            },
            $filename,
            [
                'Content-Type' => 'text/csv',
            ]
        );
    }

    /**
     * Apply the existing report filters.
     *
     * Retained for compatibility with the existing Reports
     * implementation.
     */
    private function applyFilters(
        Builder $query,
        string $dateColumn,
        ?string $start,
        ?string $end,
        ?string $month,
        ?string $region
    ): Builder {
        if ($start) {
            $query->whereDate(
                $dateColumn,
                '>=',
                $start
            );
        }

        if ($end) {
            $query->whereDate(
                $dateColumn,
                '<=',
                $end
            );
        }

        if ($monthStart = $this->monthStart($month)) {
            $query
                ->whereDate(
                    $dateColumn,
                    '>=',
                    $monthStart->toDateString()
                )
                ->whereDate(
                    $dateColumn,
                    '<=',
                    $monthStart
                        ->copy()
                        ->endOfMonth()
                        ->toDateString()
                );
        }

        if ($region) {
            $query->whereHas(
                'customer',
                fn ($query) =>
                    $query->where(
                        'area',
                        $region
                    )
            );
        }

        return $query;
    }

    /**
     * Parse a Y-m month into the first day of that month.
     */
    private function monthStart(
        ?string $value
    ): ?Carbon {
        if (! $value) {
            return null;
        }

        try {
            return Carbon::createFromFormat(
                '!Y-m',
                $value
            )->startOfMonth();
        } catch (\Throwable $e) {
            return null;
        }
    }

    /**
     * Resolve quick Income Report presets.
     */
    private function presetRange(
        string $preset
    ): ?array {
        $now = Carbon::now()->startOfMonth();

        $lastMonth = $now
            ->copy()
            ->subMonthNoOverflow()
            ->format('Y-m');

        return match ($preset) {
            'this_month' => [
                $now->format('Y-m'),
                $now->format('Y-m'),
            ],

            'last_month' => [
                $lastMonth,
                $lastMonth,
            ],

            'last_3_months' => [
                $now
                    ->copy()
                    ->subMonthsNoOverflow(2)
                    ->format('Y-m'),
                $now->format('Y-m'),
            ],

            default => null,
        };
    }
}