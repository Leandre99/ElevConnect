<?php

namespace App\Http\Controllers;

use App\Models\Ferme;
use App\Models\Animal;
use App\Models\Espece;
use App\Models\Race;
use Illuminate\Http\Request;

class AnimalController extends Controller
{
    public function index(Ferme $ferme)
    {
        $especes = Espece::all();
        $races = Race::all();
        $animaux = Animal::where('ferme_id',$ferme->id)->get();
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

        $animal = new Animal();
        $animal->espece_id = $request->input('espece_id');
        $animal->race_id = $request->input('race_id');
        $animal->age = $request->input('age');
        $animal->nombre = $request->input('nombre');
        $animal->ferme_id = $ferme->id;
        $animal->save();

        return redirect()->route('animals.index', $ferme)->with('success', 'Animal ajouté avec succès.');
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

public function update(Request $request, Animal $animal)
{
    $request->validate([
        'espece_id' => 'required|exists:especes,id',
        'race_id' => 'required|exists:races,id',
        'age' => 'required|integer',
        'nombre' => 'required|integer',
    ]);

    $animal->espece_id = $request->input('espece_id');
    $animal->race_id = $request->input('race_id');
    $animal->age = $request->input('age');
    $animal->nombre = $request->input('nombre');
    $animal->save();

    return redirect()->route('animals.index', $animal->ferme_id)->with('success', 'Animal mis à jour avec succès.');
}


}
