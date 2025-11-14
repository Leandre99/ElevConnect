<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Models\Espece;
use Illuminate\Http\Request;
use App\Http\Controllers\EspeceController;

class RaceController extends Controller
{

    public function index()
    {
        $races = Race::all();
        return view('races.index', compact('races'));
    }

    public function create()
    {
        return view('races.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'espece_id' => 'required|exists:especes,id',
            'nomrace' => 'required|string|max:255',
        ]);

        Race::create($request->all());

        return redirect()->route('races.index')->with('success', 'Race created successfully.');
    }

    public function show(Race $race)
    {
        return view('races.show', compact('race'));
    }

    public function edit(Race $race)
    {
        return view('races.edit', compact('race'));
    }

    public function update(Request $request, Race $race)
    {
        $request->validate([
            'espece_id' => 'required|exists:especes,id',
            'nomrace' => 'required|string|max:255',
        ]);

        $race->update($request->all());

        return redirect()->route('races.index')->with('success', 'Race updated successfully.');
    }

    public function destroy(Race $race)
    {
        $race->delete();

        return redirect()->route('races.index')->with('success', 'Race deleted successfully.');
    }

    public function adminIndex()
    {
        $races = Race::with('espece')->get();
        return view('admin.races.index', compact('races'));
    }

    public function adminCreate()
    {
        $especes = Espece::all();
        return view('admin.races.create', compact('especes'));
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'espece_id' => 'required|exists:especes,id',
            'nomrace' => 'required|string|max:255',
        ]);

        $race = Race::create([
            'espece_id' => $request->espece_id,
            'nomrace' => $request->nomrace,
        ]);

        log_admin_action('create_race', 'Race', $race->id, $request->all());
        return redirect()->route('admin.races.index')->with('success', 'Race ajoutée avec succès.');
    }

    public function adminEdit($id)
    {
        $race = Race::findOrFail($id);
        $especes = Espece::all();
        return view('admin.races.edit', compact('race', 'especes'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $request->validate([
            'espece_id' => 'required|exists:especes,id',
            'nomrace' => 'required|string|max:255',
        ]);

        $race = Race::findOrFail($id);
        $old = $race->getOriginal();
        $race->update([
            'espece_id' => $request->espece_id,
            'nomrace' => $request->nomrace,
        ]);

        log_admin_action('update_race', 'Race', $race->id, [
            'before' => $old,
            'after'  => $race->getChanges()
        ]);
        return redirect()->route('admin.races.index')->with('success', 'Race mise à jour avec succès.');
    }

    public function adminDestroy($id)
    {
        $race = Race::findOrFail($id);
        $old = $race->getOriginal();
        $race->delete();

        log_admin_action('delete_race', 'Race', $race->id, [
            'info' => 'suppression de la race',
            'avant' => $old
        ]);
        return redirect()->route('admin.races.index')->with('success', 'Race supprimée avec succès.');
    }
}
