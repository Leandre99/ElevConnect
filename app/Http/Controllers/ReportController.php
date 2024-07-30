<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\PerformanceReport;

class ReportController extends Controller
{
    public function showWeeklyReport()
    {
        $reports = PerformanceReport::with('user')
            ->whereBetween('week_start_date', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get();

        return view('reports.weekly', ['reports' => $reports]);
    }
}
