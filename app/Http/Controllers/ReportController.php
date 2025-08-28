<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\PerformanceReport;

class ReportController extends Controller
{
    public function showWeeklyReport()
    {
        // Récupérer tous les rapports classés par semaine
        $reports = PerformanceReport::with('user')
            ->orderBy('week_start_date', 'asc')
            ->get();

        // Regrouper par semaine et préparer les données
        $weeklyData = $reports->groupBy('week_start_date')->map(function ($weekReports) {
            return [
                'week' => $weekReports->first()->week_start_date->format('d/m'),
                'completed' => $weekReports->sum('completed_tasks'), // cumul par semaine
                'total' => $weekReports->max('total_tasks'), // le total reste fixe ou max
            ];
        });

        $reportLabels = $weeklyData->pluck('week');
        $completedTasksData = $weeklyData->pluck('completed');
        $totalTasksData = $weeklyData->pluck('total');

        return view('reports.weekly', [
            'reportLabels' => $reportLabels,
            'completedTasksData' => $completedTasksData,
            'totalTasksData' => $totalTasksData,
        ]);
    }
}
