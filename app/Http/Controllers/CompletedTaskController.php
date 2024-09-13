<?php

namespace App\Http\Controllers;

use App\Models\Tache;
use Illuminate\Http\Request;
use App\Models\CompletedTask;
use Illuminate\Support\Facades\Auth;

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
            'task_id' => 'required|exists:taches,id',
        ]);

        $task = Tache::find($request->task_id);
        $nomtache = $task ? $task->nomtache : 'Nom inconnu';

        CompletedTask::create([
            'tache_id' => $request->task_id,
            'user_id' => Auth::id(),
            'completed_at' => now(),
            'nomtache' => $nomtache,
        ]);

        return redirect()->back()->with('success', 'Tâche marquée comme complétée.');
    }

    public function destroy($id)
    {
        $completedTask = CompletedTask::findOrFail($id);
        $completedTask->delete();

        return redirect()->back()->with('success', 'Tâche complétée supprimée.');
    }
}
