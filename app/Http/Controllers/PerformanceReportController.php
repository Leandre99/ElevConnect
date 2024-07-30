<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\Ferme;
use Illuminate\Http\Request;
use App\Models\CompletedTask;
use App\Models\PerformanceReport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PerformanceReportController extends Controller
{

    public function index(Request $request, $ferme_id)
    {

        $startDate = $request->input('start_date', Carbon::now()->startOfWeek()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfWeek()->toDateString());

        $userId = auth()->id();

        // Récupérer toutes les fermes de l'utilisateur
        $fermes = Ferme::where('user_id', $userId)->get();

        // Récupérer les races des fermes de l'utilisateur
        $races = $fermes->pluck('race_id')->unique();

        // Récupérer toutes les tâches pertinentes pour les races de l'utilisateur
        $tasks = Task::whereIn('race_id', $races)->get();

        // Récupérer toutes les tâches complétées par l'utilisateur
        $completedTasks = CompletedTask::where('user_id', $userId)
            ->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate])
            ->get();


        $totalTasks = $tasks->count(); // Nombre total de tâches spécifiques à la race

        // Calculer le nombre de tâches complétées
        $completedTasksCount = $completedTasks->count();
        $performanceStatus = $totalTasks > 0 ? ($completedTasksCount / $totalTasks > 0.8 ? 'Bon' : 'À Améliorer') : 'Aucune tâche';

        // Calculer le temps restant pour l'élevage
        $averageAgeWeeks = 8; // Mettre à jour en fonction de votre application
        $speciesDuration = [
            'Vache' => 52,
            'Taureaux' => 52,
            'Veau' => 30,
            'Balibali' => 30,
            'Autres' => 30,
            'Chèvre Djallonké' => 30,
            'Chèvre du Sahel' => 30,
            'Porc Local' => 20,
            'Porc Landrace' => 20,
            'Pintade' => 12,
            'Poulet de chair' => 6,
            'Poule pondeuse' => 52,
            'Dinde' => 12,
            'Poulet locale (Bicyclette)' => 6,
        ];

        $species = $fermes->first()->race->name ?? 'Vache';
        $remainingWeeks = isset($speciesDuration[$species]) ? $speciesDuration[$species] - $averageAgeWeeks : 0;
        $endDatePrediction = Carbon::now()->addWeeks($remainingWeeks);

        // Préparer les données pour les graphiques
        $reportLabels = $completedTasks->pluck('created_at')->map(function ($date) {
            return Carbon::parse($date)->format('d-m-Y');
        });
        $completedTasksData = $completedTasks->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('d-m-Y');
        })->map(function ($tasks, $key) {
            return $tasks->count();
        })->values();

        return view('performance-reports', [
            'reports' => $completedTasks,
            'performanceStatus' => $performanceStatus,
            'totalTasks' => $totalTasks,
            'completedTasksCount' => $completedTasksCount,
            'endDatePrediction' => $endDatePrediction->toDateString(),
            'reportLabels' => $reportLabels,
            'completedTasksData' => $completedTasksData,
            'ferme_id' => $ferme_id,
            'total_task' => 0
        ]);
    }

    // public function generateWeeklyReport()
    // {
    //     $userId = Auth::id();

    //     // Définir les dates de début et de fin de la semaine
    //     $startOfWeek = Carbon::now()->startOfWeek()->toDateString();
    //     $endOfWeek = Carbon::now()->endOfWeek()->toDateString();

    //     // Calculer les tâches complètes et totales
    //     $completedTasks = Task::where('completed', true)->count();
    //     $totalTasks = Task::count();

    //     // Créer le rapport de performance
    //     PerformanceReport::create([
    //         'user_id' => $userId,
    //         'week_start_date' => $startOfWeek,
    //         'week_end_date' => $endOfWeek,
    //         'completed_tasks' => $completedTasks,
    //         'total_tasks' => $totalTasks
    //     ]);

    //     return response()->json(['success' => true, 'message' => 'Rapport de performance généré.']);
    // }

    public function getPerformanceReports(Request $request, $ferme_id)
    {

        // Définir les dates de début et de fin pour les rapports
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->toDateString());
        $user_id = Auth::id();

        $fermes = Ferme::where('user_id', $user_id)->get();

        // // Récupérer toutes les tâches pertinentes pour les races de l'utilisateur
        // $tasks = Task::whereIn('race_id', $races)->get();

        // $totalTasks = $tasks->count(); // Nombre total de tâches spécifiques à la race


        $averageAgeWeeks = 8; // Mettre à jour en fonction de votre application
        $speciesDuration = [
            'Vache' => 52,
            'Taureaux' => 52,
            'Veau' => 30,
            'Balibali' => 30,
            'Autres' => 30,
            'Chèvre Djallonké' => 30,
            'Chèvre du Sahel' => 30,
            'Porc Local' => 20,
            'Porc Landrace' => 20,
            'Pintade' => 12,
            'Poulet de chair' => 6,
            'Poule pondeuse' => 52,
            'Dinde' => 12,
            'Poulet locale (Bicyclette)' => 6,
        ];
        // Préparer les données pour les graphiques
    //  :   $reportLabels = $completedTasks->pluck('created_at')->map(function ($date) {
    //         return Carbon::parse($date)->format('d-m-Y');
    // //     });
    //     $completedTasksData = $completedTasks->groupBy(function ($date) {
    //         return Carbon::parse($date->created_at)->format('d-m-Y');
    //     })->map(function ($tasks, $key) {
    //         return $tasks->count();
    //     })->values();


        $species = $fermes->first()->race->name ?? 'Vache';
        $remainingWeeks = isset($speciesDuration[$species]) ? $speciesDuration[$species] - $averageAgeWeeks : 0;
        $endDatePrediction = Carbon::now()->addWeeks($remainingWeeks);





        $fermes = Ferme::find($ferme_id);
        $race = $fermes->race;
        // dd($fermes->created_at);
        $date_ferme = Carbon::parse($fermes->created_at);
        $date =  $date_ferme->diffInDays($startDate);;
        // dd($date);
        $total_task = Task::where('race_id', $race)->where('jour', '<=', $date)->count();
        $startDate = Carbon::parse($startDate);
        $endDate = Carbon::parse($endDate);

        $completedTasks = CompletedTask::where('user_id', $user_id)
            ->where('ferme_id', $ferme_id)
            ->whereBetween('created_at', [$startDate, $endDate])
            ->with(['task'])
            ->get();
            $completedTasksCount = $completedTasks->count();


        // Afficher les rapports dans une vue
        return view('performance-reports', [
            'completedTasks' => $completedTasks,
            'ferme_id' => $ferme_id,
            'reports' => $completedTasks,
            // 'performanceStatus' => $performanceStatus,
            // 'totalTasks' => $totalTasks,
            'completedTasksCount' => $completedTasksCount,
            'endDatePrediction' => $endDatePrediction->toDateString(),
            // 'reportLabels' => $reportLabels,
            // 'completedTasksData' => $completedTasksData,
            'total_task' => $total_task
        ]);
    }
}
