<?php

namespace App\Observers;

use App\Models\Animal;
use App\Models\Ferme;
use App\Models\Race;
use App\Models\Task;
use App\Models\Tache;
use Illuminate\Support\Facades\Auth;

class AnimalObserver
{
    /**
     * Handle the Animal "created" event.
     *
     * @param  \App\Models\Animal  $animal
     * @return void
     */
    public function created(Animal $animal)
    {
        $ferme = Ferme::find($animal->ferme_id);
        $race = Race::find($animal->race_id);

        $tasks = Task::where('race_id', $race->id)
            ->where('age_min', '<=', $animal->age)
            ->where('age_max', '>=', $animal->age)
            ->get();

        foreach ($tasks as $task) {
            $frequency = $task->frequence;

            for ($i = 0; $i < 7; $i += $frequency) {
                $tache = new Tache();
                $tache->race_id = $race->id;
                $tache->ferme_id = $ferme->id;
                $tache->task_id = $task->id;
                $tache->nomtache = $task->nomtache;
                $tache->quantite = $task->quantite;
                $tache->user_id = Auth::id();
                $tache->status = 0;
                $tache->type = $task->type;
                $tache->affichage_date = date('Y-m-d', strtotime($ferme->created_at . ' + ' . $i . ' days'));
                $tache->save();
            }
        }

        $ferme->expired_date = date('Y-m-d', strtotime($ferme->created_at . ' + 7 days'));
        $ferme->save();
    }
}
