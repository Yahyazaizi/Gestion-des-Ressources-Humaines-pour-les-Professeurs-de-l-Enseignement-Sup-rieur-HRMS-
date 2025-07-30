<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ExecutePromotionProcedure extends Command
{
    // Nom de la commande artisan
    protected $signature = 'promotion:execute';

    // Description de la commande artisan
    protected $description = 'Exécute la procédure de promotion futures pour mettre à jour la table notifications_futures.';

    public function handle()
    {
        // Exécuter la procédure MySQL
        DB::statement("CALL promotion_futures_update()");

        $this->info('La procédure de promotion a été exécutée avec succès.');
    }
}
