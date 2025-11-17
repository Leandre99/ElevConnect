<?php

namespace App\Http\Controllers;

use App\Models\Tache;
use Illuminate\Http\Request;
use App\Models\CompletedTask;
use Illuminate\Support\Facades\Auth;
use App\Models\Ferme;
use App\Models\Race;

class CompletedTaskController extends Controller
{

    public function index()
    {
        $completedTasks = CompletedTask::with('tache', 'user')->get();
        return view('completed_tasks.index', compact('completedTasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomtache' => 'required|string',
            'race_id' => 'required|exists:races,id',
            'ferme_id' => 'required|exists:fermes,id',
            'completed_at' => 'required|date',
            'quantite' => 'nullable|string',
        ]);

        CompletedTask::create([
            'tache_id' => null, // c'est un soin manuel, pas lié à une tache préexistante
            'user_id' => Auth::id(),
            'ferme_id' => $request->ferme_id,
            'nomtache' => $request->nomtache,
            'completed_at' => $request->completed_at,
            'quantite' => $request->quantite,
            'race_id' => $request->race_id, // ajouter si tu modifies le model pour le stocker
        ]);

        return redirect()->back()->with('success', 'Soin ajouté avec succès !');
    }


    public function destroy($id)
    {
        $completedTask = CompletedTask::findOrFail($id);
        $completedTask->delete();

        return redirect()->back()->with('success', 'Tâche complétée supprimée.');
    }

    public function soinsParFerme($farmId)
    {
        $farm = Ferme::with('animals.race')->findOrFail($farmId);
        $completedSoins = CompletedTask::with('tache', 'user')
            ->where('ferme_id', $farm->id)
            ->where(function ($query) {
                $query->whereHas('tache', function ($q) {
                    $q->where('type', 'Soins');
                })
                    ->orWhereNull('tache_id');
            })
            ->orderBy('completed_at', 'desc')
            ->get();

        return view('completed_tasks.soins', compact('farm', 'completedSoins'));
    }
}
