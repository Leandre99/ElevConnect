<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Race;
use App\Models\Ferme;
use App\Models\Tache;
use App\Models\Animal;
use Illuminate\Http\Request;
use App\Models\CompletedTask;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;

class TacheController extends Controller
{
    public function index($ferme_id)
    {
        $ferme_id = (int)$ferme_id;
        $ferme = Ferme::find($ferme_id);
        if (!$ferme) {
            return redirect()->route('fermes.index')->withErrors('Ferme non trouvée.');
        }

        $currentDate = Carbon::now()->toDateString();

        // Récupérer les races associées à la ferme
        $races = Race::whereIn('id', Animal::where('ferme_id', $ferme_id)->pluck('race_id'))->distinct()->get();

        // Récupérer les tâches du jour pour la ferme
        $tasks = Tache::where('ferme_id', $ferme_id)
            ->where('affichage_date', $currentDate)
            ->get();

        return view('tasks.index', compact('tasks', 'ferme', 'races'));
    }


    public function store(Request $request)
    {
        // Logique pour créer une nouvelle tâche
    }

    public function update(Request $request, Tache $tache)
    {
        // Logique pour mettre à jour une tâche
    }

    public function destroy(Tache $tache)
    {
        // Logique pour supprimer une tâche
    }

    public function markAsCompleted(Request $request,Tache $tache)
    {
        $tache->status = 1;
        $tache->save();

        CompletedTask::create([
            'tache_id' => $tache->id,
            'user_id' => auth()->id(),
            'ferme_id' => $tache->ferme_id,
            'completed_at' => now(),
        ]);

        return redirect()->back()->with('success', 'La tâche a été marquée comme terminée.');
    }
}
