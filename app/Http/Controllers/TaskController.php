<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Race;
use App\Models\Task;
use App\Models\Ferme;
use App\Models\Espece;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index($id)
    {
        $id = (int)$id;
        $ferme = Ferme::find($id);
        $createdDate = $ferme->created_at;
        $currentDate = Carbon::now();
        $daysSinceCreation = $createdDate->diffInDays($currentDate);

        $race = Race::find($ferme->race);

        $tasks = Task::leftJoin('completed_tasks', function ($join) {
            $join->on('tasks.id', '=', 'completed_tasks.task_id')
                ->where('completed_tasks.user_id', Auth::id());
        })->select('tasks.*', 'completed_tasks.task_id')
            ->where('race_id', $race->id)
            ->where('jour', $daysSinceCreation)
            ->get();

        return view('tasks.index', compact('tasks', 'ferme', 'race'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomtache' => 'required|string',
            'race_id' => 'required|exists:races,id',
            'frequence' => 'nullable|integer',
            'quantite' => 'nullable|integer',
            'type' => 'nullable|string',
            'age_min' => 'nullable|integer',
            'age_max' => 'nullable|integer',
        ]);

        Task::create([
            'nomtache' => $request->nomtache,
            'race_id' => $request->race_id,
            'frequence' => $request->frequence,
            'quantite' => $request->quantite,
            'type' => $request->type,
            'age_min' => $request->age_min,
            'age_max' => $request->age_max,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tâche créée avec succès.');
    }

    public function edit(Task $task)
    {
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'nomtache' => 'required|string',
            'race_id' => 'required|exists:races,id',
            'frequence' => 'nullable|integer',
            'quantite' => 'nullable|integer',
            'type' => 'nullable|string',
            'age_min' => 'nullable|integer',
            'age_max' => 'nullable|integer',
        ]);

        $task->update([
            'nomtache' => $request->nomtache,
            'race_id' => $request->race_id,
            'frequence' => $request->frequence,
            'quantite' => $request->quantite,
            'type' => $request->type,
            'age_min' => $request->age_min,
            'age_max' => $request->age_max,
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tâche mise à jour avec succès.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tâche supprimée avec succès.');
    }

    public function markAsCompleted(Request $request, Task $task)
    {
        $request->validate([
            'task_id' => 'required|exists:tasks,id',
            'ferme_id' => 'required|exists:fermes,id',
        ]);

        return redirect()->back()->with('success', 'Tâche marquée comme complétée.');
    }

    public function adminIndex()
    {
        $tasks = Task::all();
        return view('admin.taches', compact('tasks'));
    }

    public function adminCreate()
    {
        $races = Race::all();
        $especes = Espece::all();
        return view('admin.create_tache', compact('races','especes'));
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'nomtache' => 'required|string',
            'race_id' => 'required|exists:races,id',
            'frequence' => 'nullable|integer',
            'quantite' => 'nullable|integer',
            'type' => 'nullable|string',
            'age_min' => 'nullable|integer',
            'age_max' => 'nullable|integer',
        ]);

        Task::create([
            'nomtache' => $request->nomtache,
            'race_id' => $request->race_id,
            'frequence' => $request->frequence,
            'quantite' => $request->quantite,
            'type' => $request->type,
            'age_min' => $request->age_min,
            'age_max' => $request->age_max,
        ]);

        return redirect()->route('admin.taches')->with('success', 'Tâche créée avec succès.');
    }

    public function adminEdit(Task $task)
    {
        $races = Race::all();
        $especes = Espece::all();
        return view('admin.edit_tache', compact('task', 'races', 'especes'));
    }

    public function adminUpdate(Request $request, Task $task)
    {
        $request->validate([
            'nomtache' => 'required|string',
            'race_id' => 'required|exists:races,id',
            'frequence' => 'nullable|integer',
            'quantite' => 'nullable|integer',
            'type' => 'nullable|string',
            'age_min' => 'nullable|integer',
            'age_max' => 'nullable|integer',
        ]);

        $task->update([
            'nomtache' => $request->nomtache,
            'race_id' => $request->race_id,
            'frequence' => $request->frequence,
            'quantite' => $request->quantite,
            'type' => $request->type,
            'age_min' => $request->age_min,
            'age_max' => $request->age_max,
        ]);

        return redirect()->route('admin.taches')->with('success', 'Tâche mise à jour avec succès.');
    }

    public function adminDestroy(Task $task)
    {
        $task->delete();

        return redirect()->route('admin.taches')->with('success', 'Tâche supprimée avec succès.');
    }
    public function getRacesBySpecies($id)
{
    $races = Race::where('espece_id', $id)->get();
    return response()->json($races);
}

}
