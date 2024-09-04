<?php

namespace App\Http\Controllers;

use App\Models\Ferme;
use App\Models\Animal;
use App\Models\Espece;
use App\Models\Race;
use App\Models\Tache;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class AnimalController extends Controller
{
    public function index(Ferme $ferme)
    {
        $especes = Espece::all();
        $races = Race::all();
        $animaux = Animal::where('ferme_id', $ferme->id)->get();
        return view('Animals', compact('ferme', 'animaux', 'especes', 'races'));
    }

    public function create(Ferme $ferme)
    {
        $especes = Espece::all();
        $races = Race::all();
        return view('Animals', compact('ferme', 'especes', 'races'));
    }

    public function store(Request $request, Ferme $ferme)
    {

        $request->validate([
            'espece_id' => 'required|exists:especes,id',
            'race_id' => 'required|exists:races,id',
            'age' => 'required|integer',
            'nombre' => 'required|integer',
        ]);

        $animal = Animal::where('ferme_id', $ferme->id)
            ->where('espece_id', $request->input('espece_id'))
            ->where('race_id', $request->input('race_id'))
            ->where('age', $request->input('age'))
            ->first();

        if ($animal) {

            $animal->nombre = $request->input('nombre');
            $animal->save();
        } else {

            $animal = new Animal();
            $animal->espece_id = $request->input('espece_id');
            $animal->race_id = $request->input('race_id');
            $animal->age = $request->input('age');
            $animal->nombre = $request->input('nombre');
            $animal->ferme_id = $ferme->id;
            $animal->save();
        }

        return redirect()->route('animals.index', $ferme)->with('success', 'Animal ajouté/mis à jour avec succès.');
    }

    public function destroy(Ferme $ferme, Animal $animal)
    {
        $animal->delete();

        return back()->with('success', 'Animal supprimé avec succès.');
    }

    public function getRaces($espece_id)
    {
        $races = Race::where('espece_id', $espece_id)->get();
        return response()->json($races);
    }

    public function edit(Animal $animal)
    {
        $especes = Espece::all();
        $races = Race::where('espece_id', $animal->espece_id)->get(); // Assurez-vous que les races sont filtrées par espèce
        return view('edit-animal', compact('animal', 'especes', 'races'));
    }

    public function update(Request $request, Ferme $ferme, $id)
    {

        $request->validate([
            'espece_id' => 'required|exists:especes,id',
            'race_id' => 'required|exists:races,id',
            'age' => 'required|integer',
            'nombre' => 'required|integer',
        ]);


        $animal = Animal::findOrFail($id);


        $existingAnimal = Animal::where('ferme_id', $ferme->id)
            ->where('espece_id', $request->input('espece_id'))
            ->where('race_id', $request->input('race_id'))
            ->where('age', $request->input('age'))
            ->where('id', '!=', $animal->id)
            ->first();

        if ($existingAnimal) {

            $existingAnimal->nombre = $request->input('nombre');
            $existingAnimal->save();
            $animal->delete();
        } else {
            $animal->update([
                'espece_id' => $request->input('espece_id'),
                'race_id' => $request->input('race_id'),
                'age' => $request->input('age'),
                'nombre' => $request->input('nombre'),
            ]);
        }

        return redirect()->route('animals.index', $ferme)->with('success', 'Animal mis à jour avec succès.');
    }

    public function createTaskForAnimal($ferme_id, $animal_id)
    {
        $ferme = Ferme::find($ferme_id);
        $animal = Animal::find($animal_id);
        $race = Race::find($animal->race_id);

        $variable = Task::where('race_id', $race->id)
            ->where('age_min', '<=', $animal->age)
            ->where('age_max', '>=', $animal->age)->get();
        foreach ($variable as $value) {
            if ($value->frequence == 1) {
                for ($i = $value->frequence; $i <= 7; $i++) {
                    $tache = new Tache();
                    $tache->race_id = $race->id;
                    $tache->ferme_id = $ferme->id;
                    $tache->task_id = $value->id;
                    $tache->nomtache = $value->nomtache;
                    $tache->quantite = $value->quantite;
                    $tache->user_id = Auth::id();
                    $tache->status = 0;
                    $tache->type = $value->type;
                    $tache->affichage_date = date('Y-m-d', strtotime($ferme->expired_date . '+' . $i . ' days'));
                    $tache->save();
                }
            } else {
                $frequency = $value->frequence;
                for ($i = 0; $i <= 7; $i += $frequency) {
                    $tache = new Tache();
                    $tache->race_id = $race->id;
                    $tache->ferme_id = $ferme->id;
                    $tache->task_id = $value->id;
                    $tache->nomtache = $value->nomtache;
                    $tache->quantite = $value->quantite;
                    $tache->user_id = Auth::id();
                    $tache->status = 0;
                    $tache->type = $value->type;
                    $tache->affichage_date = date('Y-m-d', strtotime($ferme->expired_date . ' + ' . $i . ' days'));
                    $tache->save();
                }
            }
        }
        $ferme->expired_date =  date('Y-m-d', strtotime($ferme->expired_date . '+7 days'));
        $ferme->save();

        return redirect()->route('tasks.index', $ferme_id);
    }
}
