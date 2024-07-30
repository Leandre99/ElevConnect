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
                // Logique pour déterminer les tâches en fonction de l'espèce, de la race et de l'âge
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

    private function generateTasksForAnimal($animal)
{
    $tasks = [];
    switch ($animal->especes) {
        case 'volailles':
            $tasks[] = 'Feed the chickens';
            $tasks[] = 'Check for eggs';
            $tasks[] = 'Clean the chicken coop';
            $tasks[] = 'Provide fresh water';
            break;
        case 'bovins':
            $tasks[] = 'Feed the cows';
            $tasks[] = 'Milk the cows';
            $tasks[] = 'Check cows for health issues';
            $tasks[] = 'Clean the barn';
            break;
        case 'caprins':
            $tasks[] = 'Feed the sheep';
            $tasks[] = 'Shear the sheep if necessary';
            $tasks[] = 'Check for lambs';
            $tasks[] = 'Provide fresh water';
            break;
        case 'ovins':
            $tasks[] = 'Feed the goats';
            $tasks[] = 'Milk the goats if necessary';
            $tasks[] = 'Check for health issues';
            $tasks[] = 'Provide fresh water';
            break;
        // Ajoutez d'autres espèces et leurs tâches ici
        default:
            $tasks[] = 'Feed the animals';
            $tasks[] = 'Check for health issues';
            $tasks[] = 'Provide fresh water';
            break;
    }
    return $tasks;
}

}
