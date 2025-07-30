<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ModifierEchelonController extends Controller
{
    public function index(Request $request)
    {
        try {
            // Récupérer les paramètres de l'utilisateur
            $annee = $request->input('annee', date('Y'));
            $nom_prof = $request->input('nom_prof', null);

            // Appliquer les filtres pour récupérer les enseignants
            $enseignantsQuery = DB::table('employees')
                ->select('id', 'NOM_ET_PRENOM', 'cadre', 'ech', 'date_effet1', 'date_effet2')
                ->whereYear('date_effet1', '<=', $annee); // Filtre sur l'année

            if ($nom_prof) {
                $enseignantsQuery->where('NOM_ET_PRENOM', 'like', '%' . $nom_prof . '%');
            }

            $enseignants = $enseignantsQuery->get();

            // Appliquer la logique de changement d'échelon et de cadre
            foreach ($enseignants as $enseignant) {
                $nouveau_cadre = $enseignant->cadre;
                $nouveau_echelon = $enseignant->ech;

                if ($enseignant->cadre == 'MC' && $enseignant->ech < 3) {
                    $nouveau_echelon = $enseignant->ech + 1;
                } elseif ($enseignant->cadre == 'MC' && $enseignant->ech == 3) {
                    $nouveau_cadre = 'MCH';
                    $nouveau_echelon = 1;
                } elseif ($enseignant->cadre == 'MCH' && $enseignant->ech < 4) {
                    $nouveau_echelon = $enseignant->ech + 1;
                } elseif ($enseignant->cadre == 'MCH' && $enseignant->ech == 4) {
                    $nouveau_cadre = 'PES';
                    $nouveau_echelon = 1;
                } elseif ($enseignant->cadre == 'PES' && $enseignant->ech < 6) {
                    $nouveau_echelon = $enseignant->ech + 1;
                }

                // Mise à jour des informations dans la base de données
                DB::table('employees')
                    ->where('id', $enseignant->id)
                    ->update([
                        'cadre' => $nouveau_cadre,
                        'ech' => $nouveau_echelon,
                        'date_effet1' => now(),
                        'date_effet2' => now(),
                    ]);

                // Ajout de la notification dans la table 'notifications'
                DB::table('notifications')->insert([
                    'employee_id' => $enseignant->id,
                    'nom_complet' => $enseignant->NOM_ET_PRENOM,
                    'ancien_grade' => $enseignant->cadre,
                    'nouveau_grade' => $nouveau_cadre,
                    'ancien_echelon' => $enseignant->ech,
                    'nouveau_echelon' => $nouveau_echelon,
                    'date_changement' => now(),
                    'message' => "Promotion de {$enseignant->NOM_ET_PRENOM} au cadre {$nouveau_cadre} échelon {$nouveau_echelon}.",
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);
            }

            // Retourner la vue avec les enseignants et les notifications
            return view('modifier_echelon.index', compact('enseignants'));

        } catch (\Exception $e) {
            // Gestion des erreurs
            \Log::error('Erreur lors du traitement des changements d\'échelon: ' . $e->getMessage());
            return back()->withError('Une erreur est survenue lors de la mise à jour des informations.');
        }
    }
}
