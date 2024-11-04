<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class DeleteOldLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'logs:delete-old';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Delete logs older than 30 days';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        DB::table('logs')->where('created_at', '<', now()->subDays(30))->delete();
        $this->info('Old logs deleted successfully.');

        return 0;
    }
}