<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Race;
use App\Models\Task;
use App\Models\Ferme;
use App\Models\Animal;
use App\Models\Espece;
use Illuminate\Http\Request;
use App\Models\CompletedTask;
use App\Models\Tache;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TaskController extends Controller
{

    public function index($id)
    {
        $id = (int)$id;
        $ferme = Ferme::find($id);
        if (!$ferme) {
            return redirect()->route('fermes.index')->withErrors('Ferme non trouvée.');
        }

        $createdDate = $ferme->created_at;
        $currentDate = Carbon::now();
        $daysSinceCreation = $createdDate->diffInDays($currentDate);

        $races = Race::whereIn('id', Animal::where('ferme_id', $id)->pluck('race_id'))->get();
        $races = Animal::where('ferme_id', $id)->with(['race'])->get();
        // $tasks = Task::leftJoin('completed_tasks', function ($join) {
        //     $join->on('tasks.id', '=', 'completed_tasks.task_id')
        //         ->where('completed_tasks.user_id', Auth::id());
        // })->select('tasks.*', 'completed_tasks.task_id')
        //     ->whereIn('race_id', $races->pluck('id'))
        //     ->where('jour', $daysSinceCreation)
        //     ->get();

        $tasks = Tache::where('affichage_date', date('Y-m-d'))->get();

        return view('tasks.index', compact('tasks', 'ferme', 'races'));
    }

    public function create()
    {
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomtache' => 'required|string',
            'espece_id' => 'required|exists:especes,id',
            'race_id' => 'required|exists:races,id',
            'frequence' => 'nullable|integer',
            'quantite' => 'nullable|integer',
            'type' => 'nullable|string',
            'age_min' => 'nullable|integer',
            'age_max' => 'nullable|integer',
            'jour' => 'required|integer'
        ]);

        Task::create([
            'nomtache' => $request->nomtache,
            'espece_id' => $request->espece_id,
            'race_id' => $request->race_id,
            'frequence' => $request->frequence,
            'quantite' => $request->quantite,
            'type' => $request->type,
            'age_min' => $request->age_min,
            'age_max' => $request->age_max,
            'jour' => $request->jour
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
            'espece_id' => 'required|exists:especes,id',
            'race_id' => 'required|exists:races,id',
            'frequence' => 'nullable|integer',
            'quantite' => 'nullable|integer',
            'type' => 'nullable|string',
            'age_min' => 'nullable|integer',
            'age_max' => 'nullable|integer',
            'jour' => 'required|integer'
        ]);

        $task->update([
            'nomtache' => $request->nomtache,
            'espece_id' => $request->espece_id,
            'race_id' => $request->race_id,
            'frequence' => $request->frequence,
            'quantite' => $request->quantite,
            'type' => $request->type,
            'age_min' => $request->age_min,
            'age_max' => $request->age_max,
            'jour' => $request->jour
        ]);

        return redirect()->route('tasks.index')->with('success', 'Tâche mise à jour avec succès.');
    }

    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index')->with('success', 'Tâche supprimée avec succès.');
    }

    public function markAsCompleted(Request $request, Tache $task)
    {
        $completedTask = Tache::where('id', $task->id)->update(['status' => 1]);


        // $completedTask = CompletedTask::updateOrCreate([
        //     'task_id' => $task->id,
        //     'user_id' => $userId,
        // ]);
        return back();
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
        return view('admin.create_tache', compact('races', 'especes'));
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'nomtache' => 'required|string',
            'espece_id' => 'required|exists:especes,id',
            'race_id' => 'required|exists:races,id',
            'frequence' => 'nullable|integer',
            'quantite' => 'nullable|integer',
            'type' => 'nullable|string',
            'age_min' => 'nullable|integer',
            'age_max' => 'nullable|integer',
            'jour' => 'required|integer'
        ]);

        Task::create([
            'nomtache' => $request->nomtache,
            'espece_id' => $request->espece_id,
            'race_id' => $request->race_id,
            'frequence' => $request->frequence,
            'quantite' => $request->quantite,
            'type' => $request->type,
            'age_min' => $request->age_min,
            'age_max' => $request->age_max,
            'jour' => $request->jour
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
            'jour' => 'required|integer'
        ]);

        $task->update([
            'nomtache' => $request->nomtache,
            'race_id' => $request->race_id,
            'frequence' => $request->frequence,
            'quantite' => $request->quantite,
            'type' => $request->type,
            'age_min' => $request->age_min,
            'age_max' => $request->age_max,
            'jour' => $request->jour
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
