<?php

namespace App\Console\Commands;

use App\Models\Data;
use Illuminate\Console\Command;
class ImportData extends Command
{
    protected $signature = 'import:data {--status= : Filter by status} {--email= : Filter by email}';
    protected $description = 'Import data from CSV and XML files into the database';

    public function handle(): void
    {
        $statusFilter = $this->option('status');
        $emailFilter = $this->option('email');

        // Your import logic goes here

        // Example CSV import
        $csvData = file('resources/data/data.csv');
        foreach ($csvData as $index => $row) {
            // Skip the first row (header row)
            if ($index === 0) {
                continue;
            }

            $data = str_getcsv($row);

            // Check if the row has the correct number of columns
            if (count($data) >= 6) {
                // Apply filters
                if (
                    (!$statusFilter || $data[5] === $statusFilter) &&
                    (!$emailFilter || $data[3] === $emailFilter)
                ) {
                    Data::updateOrCreate([
                        'ship_to_name' => $data[2],
                        'customer_email' => $data[3],
                    ], [
                        'status' => $data[5],
                    ]);
                }
            }
        }

        // Example XML import
        // ... (same as before)

        $this->info('Data import completed successfully.');
    }
}
