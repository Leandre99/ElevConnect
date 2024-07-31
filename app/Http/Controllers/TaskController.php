<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Models\Task;
use App\Models\Ferme;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class TaskController extends Controller
{
    public function index($id)
    {

        $id = (int)$id;
        // Récupérer la ferme
        $ferme = Ferme::find($id);

        $createdDate = $ferme->created_at;
        $currentDate = Carbon::now();
        $daysSinceCreation = $createdDate->diffInDays($currentDate);


        // Récupérer la race associée à la ferme
        $race = Race::find($ferme->race);

        // Récupérer toutes les tâches pour cette race
        $tasks = Task::leftJoin('completed_tasks', function($join) {
            $join->on('tasks.id', '=', 'completed_tasks.task_id')
            ->where('completed_tasks.user_id', Auth::id());

        })->select('tasks.*', 'completed_tasks.task_id')
        ->where('race_id', $race->id)
        ->where('jour',$daysSinceCreation)
        // ->where('tasks.created_at', '>', now())
        ->get();


        // Passer les tâches, la ferme et la race à la vue
        return view('tasks.index', compact('tasks', 'ferme', 'race'));
    }

    public function create()
    {
        // Afficher le formulaire de création des tâches
        return view('tasks.create');
    }

    public function store(Request $request)
    {
        // Valider les données du formulaire
        $request->validate([
            'nomtache' => 'required|string',
            'race_id' => 'required|exists:races,id',
            'age_min' => 'required|integer',
            'age_max' => 'required|integer',
            'jour' => 'required|string',
        ]);

        // Créer une nouvelle tâche dans la base de données
        Task::create([
            'nomtache' => $request->nomtache,
            'race_id' => $request->race_id,
            'age_min' => $request->age_min,
            'age_max' => $request->age_max,
            'jour' => $request->jour,
        ]);

        // Rediriger avec un message de succès
        return redirect()->route('tasks.index')->with('success', 'Tâche créée avec succès.');
    }

    public function edit(Task $task)
    {
        // Afficher le formulaire d'édition d'une tâche spécifique
        return view('tasks.edit', compact('task'));
    }

    public function update(Request $request, Task $task)
    {
        $request->validate([
            'nomtache' => 'required|string',
            'race_id' => 'required|exists:races,id',
            'age_min' => 'required|integer',
            'age_max' => 'required|integer',
            'jour' => 'required|string',
        ]);

        $task->update([
            'nomtache' => $request->nomtache,
            'race_id' => $request->race_id,
            'age_min' => $request->age_min,
            'age_max' => $request->age_max,
            'jour' => $request->jour,
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

        // $completedTask = CompletedTask::create([
        //     'user_id' => Auth::id(),
        //     'task_id' => $request->task_id,
        //     'ferme_id' => $request->ferme_id,
        // ]);

        return redirect()->back()->with('success', 'Task marked as completed.');
    }

    public function adminIndex()
    {
        $tasks = Task::all();
        return view('admin.taches', compact('tasks'));
    }

    public function adminCreate()
    {
        $races = Race::all();
        return view('admin.create_tache', compact('races'));
    }

    public function adminStore(Request $request)
    {
        // Validate form data
        $request->validate([
            'nomtache' => 'required|string',
            'race_id' => 'required|exists:races,id',
            'age_min' => 'required|integer',
            'age_max' => 'required|integer',
            'jour' => 'required|string',
        ]);

        // Create new task in the database
        Task::create([
            'nomtache' => $request->nomtache,
            'race_id' => $request->race_id,
            'age_min' => $request->age_min,
            'age_max' => $request->age_max,
            'jour' => $request->jour,
        ]);

        // Redirect with success message
        return redirect()->route('admin.taches')->with('success', 'Tâche créée avec succès.');
    }

    public function adminEdit(Task $task)
    {
        $races = Race::all();
        return view('admin.edit_tache', compact('task', 'races'));
    }

    public function adminUpdate(Request $request, Task $task)
    {
        $request->validate([
            'nomtache' => 'required|string',
            'race_id' => 'required|exists:races,id',
            'age_min' => 'required|integer',
            'age_max' => 'required|integer',
            'jour' => 'required|string',
        ]);

        $task->update([
            'nomtache' => $request->nomtache,
            'race_id' => $request->race_id,
            'age_min' => $request->age_min,
            'age_max' => $request->age_max,
            'jour' => $request->jour,
        ]);

        return redirect()->route('admin.taches')->with('success', 'Tâche mise à jour avec succès.');
    }

    public function adminDestroy(Task $task)
    {
        $task->delete();

        return redirect()->route('admin.taches')->with('success', 'Tâche supprimée avec succès.');
    }
}
