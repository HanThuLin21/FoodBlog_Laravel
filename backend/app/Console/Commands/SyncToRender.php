<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class SyncToRender extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'db:sync-to-render';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Sync data from local MySQL to remote PostgreSQL';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Starting data synchronization from local MySQL to remote PostgreSQL...');

        $tables = ['tbladmin', 'user', 'blogpost', 'recipe', 'restaurant', 'comment'];

        foreach ($tables as $table) {
            $this->info("Syncing table: {$table}");
            
            try {
                // Get all records from local MySQL
                $records = DB::connection('mysql')->table($table)->get()->map(function ($item) {
                    return (array) $item;
                })->toArray();

                $count = count($records);
                $this->info("Found {$count} records in local {$table}.");

                if ($count > 0) {
                    // Truncate remote table first to avoid duplicates
                    DB::connection('pgsql_render')->table($table)->truncate();
                    
                    // Insert into remote PostgreSQL
                    // Chunk the inserts to avoid memory or query size limits
                    $chunks = array_chunk($records, 100);
                    foreach ($chunks as $chunk) {
                        DB::connection('pgsql_render')->table($table)->insert($chunk);
                    }
                    
                    $this->info("Successfully synced {$table} to remote database.");
                }
            } catch (\Exception $e) {
                $this->error("Failed to sync {$table}: " . $e->getMessage());
            }
        }

        $this->info('Data synchronization completed successfully!');
    }
}
