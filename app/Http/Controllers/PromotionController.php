<?php


namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\NotificationFuture;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;


class PromotionController extends Controller
{
    public function recherche(Request $request)
    {
        $query = DB::table('notifications_futures');

        if ($request->filled('date_effet')) {
            $query->whereDate('date_changement', '=', $request->input('date_effet'));
        }

        if ($request->filled('nom_prof')) {
            $query->where('employee_id', $request->input('nom_prof'));
        }

        $notifications = $query->get();

        // Adapter les résultats pour la vue
        $resultats = [];
        foreach ($notifications as $notif) {
            $resultats[] = [
                'nom_complet'     => $notif->nom_complet,
                'ancien_grade'    => $notif->ancien_grade,
                'nouveau_grade'   => $notif->nouveau_grade,
                'ancien_echelon'  => $notif->ancien_echelon,
                'nouveau_echelon' => $notif->nouveau_echelon,
                'date_changement' => $notif->date_changement,
                'message'         => $notif->message,
            ];
        }

        // Récupérer tous les professeurs pour remplir la liste déroulante
        $professeurs = DB::table('employees')
            ->select('id', 'NOM_ET_PRENOM', 'first_name', 'last_name', 'cadre', 'date_effet1', 'date_effet2', 'ech')
            ->get()
            ->map(function ($prof) {
                $prof->cadre = $prof->cadre ?? '';
                return $prof;
            });

        $professeursData = [];
        foreach ($professeurs as $prof) {
            $professeursData[$prof->id] = $prof;
        }

        return view('promotions-prevues', [
            'professeurs' => $professeurs,
            'professeursData' => $professeursData,
            'resultats' => $resultats ?? [],
        ]);
    }


    public function details($id)
    {
        $promotion = NotificationFuture::with('employee')->findOrFail($id);
        return view('promotion-details', compact('promotion'));
    }

    public function runPromotionUpdate()
    {
        $promoYears = [
            'MC' => 2,
            'MCH' => 2,
            'PES' => 2,
        ];

        $employees = Employee::all();

        foreach ($employees as $employee) {
            $newCadre = $employee->cadre;
            $newEch = $employee->ech;
            $futureDate = null;

            if (isset($promoYears[$employee->cadre])) {
                $promotionYears = $promoYears[$employee->cadre];

                if ($employee->cadre == 'MC' && $employee->ech < 3) {
                    $newEch = $employee->ech + 1;
                    $futureDate = Carbon::parse($employee->date_effet1)->addYears($promotionYears);
                } elseif ($employee->cadre == 'MC' && $employee->ech >= 3) {
                    $newCadre = 'MCH';
                    $newEch = 1;
                    $futureDate = Carbon::parse($employee->date_effet1)->addYears($promotionYears);
                } elseif ($employee->cadre == 'MCH' && $employee->ech < 4) {
                    $newEch = $employee->ech + 1;
                    $futureDate = Carbon::parse($employee->date_effet1)->addYears($promotionYears);
                } elseif ($employee->cadre == 'MCH' && $employee->ech >= 4) {
                    $newCadre = 'PES';
                    $newEch = 1;
                    $futureDate = Carbon::parse($employee->date_effet1)->addYears($promotionYears);
                } elseif ($employee->cadre == 'PES' && $employee->ech < 6) {
                    $newEch = $employee->ech + 1;
                    $futureDate = Carbon::parse($employee->date_effet1)->addYears($promotionYears);
                }
            }

            if ($newCadre != $employee->cadre || $newEch != $employee->ech) {
                $employee->update([
                    'cadre' => $newCadre,
                    'ech' => $newEch,
                    'date_effet1' => $futureDate,
                ]);

                NotificationFuture::updateOrCreate(
                    ['employee_id' => $employee->id],
                    [
                        'nom_complet' => $employee->NOM_ET_PRENOM,
                        'ancien_grade' => $employee->cadre,
                        'nouveau_grade' => $newCadre,
                        'ancien_echelon' => $employee->ech,
                        'nouveau_echelon' => $newEch,
                        'date_changement' => $futureDate,
                        'message' => 'Promotion prévue : ' . $employee->NOM_ET_PRENOM . ' passera au cadre ' . $newCadre . ', échelon ' . $newEch . ' le ' . $futureDate->format('d/m/Y'),
                    ]
                );
            }
        }

        return redirect()->route('promotions.recherche')->with('success', 'Mise à jour des promotions effectuée avec succès.');
    }



public function prevues()
{
    $notifications = DB::table('notifications_futures')->get();

    // 🟢 récupérer tous les professeurs
    $professeurs = DB::table('employees')
        ->select('id', 'NOM_ET_PRENOM', 'first_name', 'last_name', 'prenom', 'nom', 'cadre', 'date_effet1', 'date_effet2', 'ech', 'tpr')
        ->get()
        ->map(function ($prof) {
            $prof->cadre = $prof->cadre ?? '';
            return $prof;
        });

    return view('promotions.prevues', ['professeurs' => $professeurs]);
}

}
