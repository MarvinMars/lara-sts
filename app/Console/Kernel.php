<?php

namespace App\Console;

use App;
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
        'App\Console\Commands\CreateTokenForAllUsersCommand',
        'App\Console\Commands\ImportProcessingCommand',
        'App\Console\Commands\StatsRemoveDuplicatesCommand',
	    'App\Console\Commands\CheckFilesChangesCommand',
	    'App\Console\Commands\LiveStatsCommand',
        'App\Console\Commands\UserCreate',
        'App\Console\Commands\XsdDebugerCommand',
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected function schedule(Schedule $schedule): void
    {
        if (App::isLocal()) {
            return;
        }

        $schedule->command('stats:processing')
            ->everyMinute()
            ->withoutOverlapping();

	    $schedule->command('files:changes:check')
	             ->everyMinute()
	             ->withoutOverlapping();

	    $schedule->command('stats:live')
		         ->daily()
	             ->withoutOverlapping();
//        $schedule->command('stats:players:build')
//            ->daily()
//            ->withoutOverlapping();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }
}
