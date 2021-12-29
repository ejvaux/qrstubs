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
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->command('transaction:export 1')
                  ->dailyAt('08:00');
                  /*->everyMinute();*/

        $schedule->command('transaction:export 2')
                ->monthlyOn(1, '08:00');

        $schedule->command('transaction:export 2')
                ->monthlyOn(16, '08:00');

        $schedule->command('summary-report:file')
                ->monthlyOn(1, '08:00');

        $schedule->command('summary-report:file')
                ->monthlyOn(16, '08:00');
        // $schedule->command('inspire')
        //          ->hourly();

    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
