<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;

class CustomersImport implements ToCollection
{
    /**
     * Imported spreadsheet rows.
     */
    public Collection $rows;

    /**
     * Create a new importer instance.
     */
    public function __construct()
    {
        $this->rows = collect();
    }

    /**
     * Read the first worksheet and convert each row into
     * an associative Collection using the spreadsheet headers.
     */
    public function collection(Collection $collection): void
    {
        if ($collection->isEmpty()) {
            $this->rows = collect();

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Find the header row
        |--------------------------------------------------------------------------
        |
        | The client's spreadsheet may contain blank rows before the actual
        | headers. We therefore look for a row containing recognizable
        | customer/import headings instead of blindly assuming row 1.
        |
        */

        $headerIndex = null;

        foreach ($collection as $index => $row) {
            $normalizedValues = $row
                ->map(fn ($value) => $this->normalizeHeader($value))
                ->filter()
                ->values()
                ->all();

            $headerCandidates = [
                'first name',
                'second name',
                'contact',
                'meter no',
                'region',
                'previous readings',
                'current readings',
            ];

            $matches = 0;

            foreach ($headerCandidates as $candidate) {
                if (in_array($candidate, $normalizedValues, true)) {
                    $matches++;
                }
            }

            /*
             * At least two recognizable headers are required
             * before a row is considered the spreadsheet header.
             */
            if ($matches >= 2) {
                $headerIndex = $index;

                break;
            }
        }

        /*
        |--------------------------------------------------------------------------
        | No recognizable header found
        |--------------------------------------------------------------------------
        */

        if ($headerIndex === null) {
            $this->rows = collect();

            return;
        }

        /*
        |--------------------------------------------------------------------------
        | Build the headers
        |--------------------------------------------------------------------------
        */

        $headerRow = $collection->get($headerIndex);

        $headers = $headerRow
            ->map(fn ($header) => trim((string) $header))
            ->values()
            ->all();

        /*
        |--------------------------------------------------------------------------
        | Process rows after the header
        |--------------------------------------------------------------------------
        */

        $dataRows = $collection->slice($headerIndex + 1);

        $this->rows = $dataRows
            ->map(function ($row) use ($headers) {
                $values = $row->values()->all();

                $associativeRow = [];

                foreach ($headers as $index => $header) {
                    $header = trim((string) $header);

                    /*
                     * Ignore completely empty header columns.
                     */
                    if ($header === '') {
                        continue;
                    }

                    $associativeRow[$header] = $values[$index] ?? null;
                }

                return collect($associativeRow);
            })
            ->filter(function (Collection $row) {
                /*
                |--------------------------------------------------------------------------
                | Ignore completely empty rows
                |--------------------------------------------------------------------------
                */

                return $row->contains(function ($value) {
                    return trim((string) $value) !== '';
                });
            })
            ->values();
    }

    /**
     * Return the imported spreadsheet rows.
     *
     * The CustomerImportController uses this method after
     * Laravel Excel finishes reading the spreadsheet.
     */
    public function rows(): Collection
    {
        return $this->rows;
    }

    /**
     * Normalize a header for comparison.
     *
     * This allows the importer to recognize variations such as:
     *
     * "Previous   readings"
     * "Previous readings"
     * "PREVIOUS READINGS"
     * "previous readings"
     */
    private function normalizeHeader($header): string
    {
        $header = trim((string) $header);

        /*
         * Replace multiple spaces/whitespace characters
         * with one normal space.
         */
        $header = preg_replace('/\s+/', ' ', $header);

        return strtolower($header);
    }
}