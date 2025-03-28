<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            app(\App\Http\Controllers\LinkController::class)->checkExpiredLinks();
        })->daily(); // ✅ Ye task har din chalega
    }

    /**
     * Register the commands for the application.
     */
    protected function commands()
    {
        $this->load(_DIR_.'/Commands');
        require base_path('routes/console.php');
    }
}