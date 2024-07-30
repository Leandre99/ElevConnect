<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Models\Animal;
use App\Models\Espece;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Ferme; // Assurez-vous d'avoir le modèle Ferme créé

class fermeController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'nomferme' => 'required|string|max:255',
            'especes' => 'required',
            'race' => 'required',
            'agemoyen' => 'required|numeric',
            'nombre_animaux' => 'required|integer|min:1',
            'user_id' => 'required|integer|exists:users,id',
        ]);

        $ferme = new Ferme();
        $ferme->nomferme = $request->input('nomferme');
        $ferme->especes = $request->input('especes');
        $ferme->race = $request->input('race');
        $ferme->agemoyen = $request->input('agemoyen');
        $ferme->nombre_animaux = $request->input('nombre_animaux');
        $ferme->user_id = $request->user_id;
        $ferme->save();

        // Redirigez vers une page de confirmation
        return back();
    }

    public function index()
{
    $fermes = Ferme::where('user_id',Auth::user()->id)->with('races')->get();


    $especes = Espece::all();
    $races = Race::all();
   // dd($fermes);

    return view('Ferme', compact('fermes', 'especes', 'races'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'nomferme' => 'required|string|max:255',
        'especes' => 'required|in:bovins,ovins,caprins,porcs,volailles',
        'race' => 'required|string|max:255',
        'agemoyen' => 'required|numeric',
        'nombre_animaux' => 'required|integer|min:1',
        'user_id' => 'required|exists:users,id',
    ]);

    $ferme = Ferme::find($id);

    if (!$ferme) {
        // Handle farm not found error
        return abort(404);
    }

    $ferme->nomferme = $request->input('nomferme');
    $ferme->especes = $request->input('especes');
    $ferme->race = $request->input('race');
    $ferme->agemoyen = $request->input('agemoyen');
    $ferme->nombre_animaux = $request->input('nombre_animaux');
    $ferme->user_id = Auth::id();
    $ferme->save();

    // Redirigez vers une page de confirmation
    return redirect()->route('Ferme')->with('success', 'Ferme créée avec succès.'); // Redirect to farm list page
}

public function edit($id)
{
    $ferme = Ferme::findOrFail($id);
    return view('ferme_edit', compact('ferme',));
}

public function destroy(Ferme $ferme)
    {
        $ferme->delete();

        return redirect()->route('Ferme')->with('success', 'Ferme supprimée avec succès.');
    }
}
