<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use App\Http\Services\StreamerService;
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
        $schedule->call(function () {
           $streamerService = new StreamerService('2ec58lis2tte9fscri8mujdvzayeyb');
//           $streamerService->fetchStreamsAndInsert(100, 100);
//           $streamerService->updatePopularGames();
        })->everyFiveMinutes();
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
