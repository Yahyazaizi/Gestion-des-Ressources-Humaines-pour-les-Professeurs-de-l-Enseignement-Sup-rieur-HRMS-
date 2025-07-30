<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class ExecuteGradeProcedure extends Command
{
    protected $signature = 'grades:run-procedure';
    protected $description = 'Exécute la procédure de mise à jour des grades et échelons';

    public function handle()
    {
        DB::statement("CALL update_grades_and_echelons()");
        $this->info('✅ Procédure exécutée avec succès.');
    }
}
// update_grades_and_echelons
