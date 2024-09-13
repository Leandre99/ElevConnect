<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Task;
use App\Models\Ferme;
use App\Models\Tache;
use App\Models\Animal;
use Illuminate\Http\Request;
use App\Models\CompletedTask;
use App\Models\PerformanceReport;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class PerformanceReportController extends Controller
{

    public function index(Request $request, $ferme_id)
    {

        $taches = Tache::where('ferme_id', $ferme_id)->get();

        $startDate = $request->input('start_date', Carbon::now()->startOfWeek()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfWeek()->toDateString());

        $userId = auth()->id();

        $fermes = Ferme::where('user_id', $userId)->get();

        $races = $fermes->pluck('race_id')->unique();

        $tasks = Task::whereIn('race_id', $races)->get();

        $completedTasks = CompletedTask::where('ferme_id', $ferme_id)
            ->where('user_id', $userId)
            ->whereBetween(DB::raw('DATE(created_at)'), [$startDate, $endDate])
            ->get();

        $averageAgeWeeks = Animal::where('ferme_id', $ferme_id)
            ->avg('age');

        $totalTasks = $taches->count();
        $completedTasksCount = $completedTasks->count();
        $performanceStatus = $totalTasks > 0 ? ($completedTasksCount / $totalTasks > 0.8 ? 'Bon' : 'À Améliorer') : 'Aucune tâche';

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

        $reportLabels = $completedTasks->pluck('created_at')->map(function ($date) {
            return Carbon::parse($date)->format('d-m-Y');
        });
        $completedTasksData = $completedTasks->groupBy(function ($date) {
            return Carbon::parse($date->created_at)->format('d-m-Y');
        })->map(function ($tasks, $key) {
            return $tasks->count();
        })->values();

        return view('performance-reports', [
            'completedTasks' => $completedTasks,
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

    public function getPerformanceReports(Request $request, $ferme_id)
    {
        $startDate = $request->input('start_date', Carbon::now()->startOfMonth()->toDateString());
        $endDate = $request->input('end_date', Carbon::now()->endOfMonth()->toDateString());
        $user_id = Auth::id();

        $ferme = Ferme::find($ferme_id);

        if (!$ferme) {
            return redirect()->back()->withErrors('La ferme spécifiée n\'existe pas.');
        }

        $race = $ferme->race;

        if (!$race) {
            return redirect()->back()->withErrors('La race associée à la ferme n\'est pas définie.');
        }

        $averageAgeWeeks = 8;
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

        $speciesName = $race->name ?? 'Vache';
        $remainingWeeks = isset($speciesDuration[$speciesName]) ? $speciesDuration[$speciesName] - $averageAgeWeeks : 0;
        $endDatePrediction = Carbon::now()->addWeeks($remainingWeeks);

        $date_ferme = Carbon::parse($ferme->created_at);
        $date = $date_ferme->diffInDays(Carbon::parse($startDate));

        if ($race) {
            $total_task = Task::where('race_id', $race->id)
                ->where('jour', '<=', $date)
                ->count();
        } else {
            $total_task = 0;
        }

        $completedTasks = CompletedTask::where('user_id', $user_id)
            ->where('ferme_id', $ferme_id)
            ->whereBetween('created_at', [Carbon::parse($startDate), Carbon::parse($endDate)])
            ->with(['task'])
            ->get();

        $completedTasksCount = $completedTasks->count();

        return view('performance-reports', [
            'completedTasks' => $completedTasks,
            'ferme_id' => $ferme_id,
            'completedTasksCount' => $completedTasksCount,
            'endDatePrediction' => $endDatePrediction->toDateString(),
            'total_task' => $total_task
        ]);
    }
}
