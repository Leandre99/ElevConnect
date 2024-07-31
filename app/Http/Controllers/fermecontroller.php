<?php

namespace App\Http\Controllers;

use App\Models\Ferme;
use Illuminate\Http\Request;

class FermeController extends Controller
{
    public function index()
    {
        $fermes = Ferme::all();
        return view('Ferme', compact('fermes'));
    }

    public function create()
    {
        return view('Ferme');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomferme' => 'required',
            'description' => 'required',
            'adresse' => 'required',
        ]);

        Ferme::create([
            'user_id' => auth()->user()->id,
            'nomferme' => $request->nomferme,
            'description' => $request->description,
            'adresse' => $request->adresse,
        ]);

        return redirect()->route('Ferme')->with('success', 'Ferme créée avec succès.');
    }

    public function edit($id)
    {
        $ferme=Ferme::find($id);
        return view('edit-ferme', compact('ferme'));
    }

    public function update(Request $request, Ferme $ferme)
    {
        $request->validate([
            'nomferme' => 'required',
            'description' => 'required',
            'adresse' => 'required',
        ]);

        $ferme->update([
            'nomferme' => $request->nomferme,
            'description' => $request->description,
            'adresse' => $request->adresse,
        ]);

        return redirect()->route('Ferme')->with('success', 'Ferme mise à jour avec succès.');
    }

    public function destroy(Ferme $ferme)
    {
        $ferme->delete();
        return redirect()->route('Ferme')->with('success', 'Ferme supprimée avec succès.');
    }
}

