<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use DB;
use Carbon\Carbon;
use App\LogActivity;


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
        // $schedule->command('inspire')
        //          ->hourly();

        //backups database evey day
        $schedule->exec('/home/$USERNAME/Desktop/backup.sh')->daily();


        //checks whether there are any logs older that 3 months, if so, deletes them. 
        $schedule->call(function() {
            $old = LogActivity::where('created_at', '<=', Carbon::now()->subMonth(3), 'AND', '>=', Carbon::now()->subMonth(6))
                         ->orderBy('created_at', 'desc')
                         ->get();
          if($old->count() > 0){
            $count = $old->count();
            LogActivity::where('created_at', '<=', Carbon::now()->subMonth(3), 'AND', '>=', Carbon::now()->subMonth(6))->delete();
          }
        })->daily();
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
