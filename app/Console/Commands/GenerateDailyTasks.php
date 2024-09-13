<?php

namespace App\Console\Commands;

use App\Models\Task;
use Illuminate\Console\Command;
use App\Models\Ferme;
use Carbon\Carbon;

class GenerateDailyTasks extends Command
{
    protected $signature = 'tasks:generate-daily';
    protected $description = 'Generate daily tasks for farmers';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $farms = Ferme::all();

        foreach ($farms as $farm) {
            $animals = $farm->animals;

            foreach ($animals as $animal) {
                $tasks = $this->generateTasksForAnimal($animal);

                foreach ($tasks as $taskDescription) {
                    Task::create([
                        'ferme_id' => $farm->id,
                        'animal_id' => $animal->id,
                        'description' => $taskDescription,
                        'due_date' => Carbon::now()->startOfDay()->addHours(8),
                        'completed' => false,
                    ]);
                }
            }
        }

        $this->info('Daily tasks generated successfully.');
    }

}
