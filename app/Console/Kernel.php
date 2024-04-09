<?php

namespace App\Console;

use App\Services\TelegramNotificationService;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected $commands = [
    ];

    /**
     * Define the application's command schedule.
     *
     * @param Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        /*
         * This is the Command that should be put in cpanel cronJob:
         * /usr/local/bin/php /home/laraplus/sources/laraplus/artisan schedule:run >> /dev/null 2>&1
         */
        $schedule->command('queue:work --queue=default  --sleep=2 --tries=3 --timeout=5 --stop-when-empty')
            ->everyMinute()
            ->withoutOverlapping()
            ->appendOutputTo(storage_path() . '/logs/scheduler.log');
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
