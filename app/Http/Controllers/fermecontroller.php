<?php

namespace App\Http\Controllers;

use App\Models\Ferme;
use Illuminate\Http\Request;


class FermeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $fermes = Ferme::where('user_id', $user->id)
        ->where('is_active', true)
        ->get();
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

    $ferme = Ferme::create([
        'user_id' => auth()->user()->id,
        'nomferme' => $request->nomferme,
        'description' => $request->description,
        'adresse' => $request->adresse,
    ]);

    // Log de l'action
    log_activity(
        'create_farm',
        'Ferme',
        $ferme->id,
        ['nomferme' => $ferme->nomferme, 'description' => $ferme->description, 'adresse' => $ferme->adresse]
    );

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

    $old = $ferme->toArray(); // garder l’état avant modification

    $ferme->update([
        'nomferme' => $request->nomferme,
        'description' => $request->description,
        'adresse' => $request->adresse,
    ]);

    log_activity(
        'update_farm',
        'Ferme',
        $ferme->id,
        [
            'before' => $old,
            'after'  => $ferme->getChanges()
        ]
    );

    return redirect()->route('Ferme')->with('success', 'Ferme mise à jour avec succès.');
}

    public function destroy(Ferme $ferme)
{
    $ferme->is_active = false;
    $ferme->save();

    log_activity(
        'deactivate_farm',
        'Ferme',
        $ferme->id,
        ['is_active' => $ferme->is_active]
    );

    return redirect()->route('Ferme')->with('success', 'Ferme désactivée avec succès.');
}

    public function activate(Ferme $ferme)
    {
        $ferme->is_active = true;
        $ferme->save();
        return redirect()->route('admin.farms.index')->with('success', 'Ferme activée avec succès.');
    }

    public function deactivate(Ferme $ferme)
    {
        $ferme->is_active = false;
        $ferme->save();
        return redirect()->route('admin.farms.index')->with('success', 'Ferme désactivée avec succès.');
    }
    public function toggleStatus(Ferme $farm)
    {
        $farm->is_active = !$farm->is_active;
    $farm->save();

    log_activity(
        'toggle_farm_status',
        'Ferme',
        $farm->id,
        ['is_active' => $farm->is_active]
    );
        return redirect()->route('admin.farms')->with('success', 'Statut de la ferme mis à jour avec succès.');
    }

    public function showAnimals($farmId)
    {
        $farm = Ferme::with('animals')->findOrFail($farmId);
        return view('admin.animal', compact('farm'));
    }

}

