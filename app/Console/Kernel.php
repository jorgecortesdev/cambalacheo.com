<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        \App\Console\Commands\Inspire::class,
        \App\Console\Commands\StatsImagesGenerate::class,
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // Queues
        $schedule->command('queue:work --queue=emails --tries=3')->cron('* * * * * *');
        $schedule->command('queue:work --queue=facebook --tries=3')->cron('* * * * * *');

        // Statistics
        $schedule->command('stats:images')->cron('* * * * * *');
    }
}
