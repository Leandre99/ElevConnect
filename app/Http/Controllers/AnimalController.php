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
    $animaux = $ferme->animaux();
    return view('Animals', compact('ferme', 'animaux'));
}

    public function create(Ferme $ferme)
    {
        $especes = Espece::all();
        $races = Race::all();
        return view('create-animal', compact('ferme', 'especes', 'races'));
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

        return redirect()->route('Ferme')->with('success', 'Animal ajouté avec succès.');
    }
    public function destroy(Ferme $ferme, Animal $animal)
    {
        $animal->delete();

        return back()->with('success', 'Animal supprimé avec succès.');
    }
}
