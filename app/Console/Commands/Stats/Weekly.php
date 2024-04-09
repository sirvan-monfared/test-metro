<?php

namespace App\Console\Commands\Stats;

use App\Services\TelegramNotificationService;
use Illuminate\Console\Command;

class Weekly extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stats:weekly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This Command Send a Telegram Notification For Weekly Stats';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        TelegramNotificationService::weeklyStats();
    }
}
