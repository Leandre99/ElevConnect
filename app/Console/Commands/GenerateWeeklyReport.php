<?php

namespace App\Console\Commands;

use Illuminate\Support\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\PerformanceReportController;

class GenerateWeeklyReport extends Command
{
    protected $signature = 'report:generate-weekly';
    protected $description = 'Generate weekly performance reports';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $controller = new PerformanceReportController();
        $controller->generateWeeklyReport();
    }
}
