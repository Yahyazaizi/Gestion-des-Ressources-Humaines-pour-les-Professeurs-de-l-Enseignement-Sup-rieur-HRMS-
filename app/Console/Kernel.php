<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */





    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
    // app/Console/Kernel.php

    // protected function schedule(Schedule $schedule)
    // {
    //     $schedule->command('update:grades')->everyMinute(); // التحديث كل دقيقة
    // }
//     protected function schedule(Schedule $schedule)
// {
//     $schedule->command('grades:upgrade')->yearlyOn(1, 1, '00:00');
// }

// protected function schedule(Schedule $schedule)
// {
//     // Planifie la commande pour qu'elle s'exécute après 5 minutes
//     $schedule->command('app:upgrade-grades')->delay(now()->addMinutes(5));
// }

// protected function schedule(Schedule $schedule)
// {
//     // $schedule->command('app:upgrade-grades')->delay(now()->addSeconds(5));
//     $schedule->command('app:upgrade-grades')->everyMinute();
//  // Test avec un délai de 5 secondes
// }
protected function schedule(Schedule $schedule)
{
    // Planification de la commande 'upgrade-grades' toutes les minutes
    $schedule->command('app:upgrade-grades')->everyMinute();

    // Planification de la commande 'promotion:execute' une fois par jour
    $schedule->command('promotion:execute')->daily();

    // Exemple de test avec un délai de 5 secondes
    // $schedule->command('app:upgrade-grades')->delay(now()->addSeconds(5));
}





}

