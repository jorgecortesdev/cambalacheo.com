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
        \App\Console\Commands\StatsTotalsGenerate::class
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
        $schedule->command('stats:totals images file_mime')->everyFiveMinutes();
        $schedule->command('stats:totals users provider')->everyFiveMinutes();
        $schedule->command('stats:totals users state_id')->everyFiveMinutes();
        $schedule->command('stats:totals articles condition_id')->everyFiveMinutes();
        $schedule->command('stats:totals articles category_id')->everyFiveMinutes();
        $schedule->command('stats:totals articles status')->everyFiveMinutes();
        $schedule->command('stats:totals offers status')->everyFiveMinutes();
    }
}
