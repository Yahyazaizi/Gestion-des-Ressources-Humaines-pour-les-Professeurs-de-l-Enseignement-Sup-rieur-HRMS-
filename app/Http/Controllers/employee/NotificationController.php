<?php

namespace App\Http\Controllers;
use App\Models\Employee;

use Illuminate\Http\Request;
use DB;

class NotificationController extends Controller
{
    public function index(Request $request)
{
    dd('Hello World');
    $query = DB::table('notifications')
    ->join('employees', 'notifications.employee_id', '=', 'employees.id')
    ->select('notifications.*', 'employees.NOM_ET_PRENOM');

// Filtrer par année
if ($request->filled('year')) {
    $query->whereYear('notifications.date_changement', $request->year);
}

// Filtrer par Employé
if ($request->filled('employee_id')) {
    $query->where('employees.id', $request->employee_id);
}

// Filtrer par TPR
if ($request->filled('tpr')) {
    $query->where('employees.tpr', $request->tpr);
}

$notifications = $query->latest('notifications.date_changement')
                       ->paginate(15);

$employees = Employee::orderBy('NOM_ET_PRENOM')->get();


    return view('notifications.index', compact('notifications', 'employees'));
}


public function getFuturEch($id)
{
    $employee = Employee::findOrFail($id);

    $currentEch = $employee->ech;
    $newEch = $currentEch + 1;
    $dateEffet = now()->format('Y-m-d'); // أو الحساب حسب الحالة

    return response()->json([
        'futur_grade' => $employee->grade,
        'futur_ech' => $newEch,
        'date_effet' => $dateEffet,
    ]);
}
// public function getTeachersByCadre(Request $request)
// {
//     $query = Employee::query();

//     if ($request->filled('cadre')) {
//         $query->where('cadre', $request->cadre);
//     }

//     $teachers = $query->select('id', \DB::raw("CONCAT(first_name, ' ', last_name) as NOM_ET_PRENOM"))->get();

//     return response()->json($teachers);
// }

// public function filterTeachers(Request $request)
// {
//     $query = Employee::query();

//     if ($request->filled('cadre')) {
//         $query->where('cadre', $request->cadre);
//     }

//     $teachers = $query->get(['id', 'NOM_ET_PRENOM']);
//     return response()->json($teachers);
// }

public function getTeachersByCadre(Request $request)
{
    $query = Employee::query();

    // Filtrer par cadre
    if ($request->filled('cadre')) {
        $query->where('cadre', $request->cadre);
    }

    // Filtrer par TPR
    if ($request->filled('tpr')) {
        $query->where('tpr', $request->tpr);
    }

    $teachers = $query->select('id', DB::raw("CONCAT(first_name, ' ', last_name) as NOM_ET_PRENOM"))->orderBy('NOM_ET_PRENOM')->get();

    return response()->json($teachers);
}

}
