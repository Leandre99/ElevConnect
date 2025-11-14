<?php

namespace App\Http\Controllers;

use App\Models\Espece;
use Illuminate\Http\Request;

class EspeceController extends Controller
{
    public function index()
    {
        $especes = Espece::all();
        return view('especes.index', compact('especes'));
    }

    public function create()
    {
        return view('especes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nomespece' => 'required|string|max:255',
        ]);

        Espece::create($request->all());

        return redirect()->route('especes.index')
            ->with('success', 'Espece created successfully.');
    }

    public function show(Espece $espece)
    {
        return view('especes.show', compact('espece'));
    }

    public function edit(Espece $espece)
    {
        return view('especes.edit', compact('espece'));
    }

    public function update(Request $request, Espece $espece)
    {
        $request->validate([
            'nomespece' => 'required|string|max:255',
        ]);

        $espece->update($request->all());

        return redirect()->route('especes.index')
            ->with('success', 'Espece updated successfully.');
    }

    public function destroy(Espece $espece)
    {
        $espece->delete();

        return redirect()->route('especes.index')
            ->with('success', 'Espece deleted successfully.');
    }

    public function getRaces(Espece $espece)
    {
        return response()->json($espece->races);
    }

    public function adminIndex()
    {
        $especes = Espece::all();
        return view('admin.especes.index', compact('especes'));
    }

    public function adminCreate()
    {
        return view('admin.especes.create');
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'nomespece' => 'required|string|max:255',
        ]);
        $espece = Espece::create([
            'nomespece' => $request->nomespece,
        ]);

        log_admin_action('create_espece', 'Espece', $espece->id, [
        'nomespece' => $request->nomespece
    ]);
        return redirect()->route('admin.especes.index')->with('success', 'Espèce ajoutée avec succès.');
    }

    public function adminEdit($id)
    {
        $espece = Espece::findOrFail($id);
        return view('admin.especes.edit', compact('espece'));
    }

    public function adminUpdate(Request $request, $id)
    {
        $request->validate([
            'nomespece' => 'required|string|max:255',
        ]);
        $espece = Espece::findOrFail($id);
        $old = $espece->getOriginal();

        $espece->update([
            'nomespece' => $request->nomespece,
        ]);
        log_admin_action('update_espece', 'Espece', $espece->id, [
            'before' => $old,
            'after' => $espece->getChanges()
        ]);
        return redirect()->route('admin.especes.index')->with('success', 'Espèce mise à jour avec succès.');
    }

    public function adminDestroy($id)
    {
        $espece = Espece::findOrFail($id);
        $espece->delete();
        log_admin_action('delete_espece', 'Espece', $espece->id, ['info' => 'Espece supprimee']);

        return redirect()->route('admin.especes.index')->with('success', 'Espèce supprimée avec succès.');
    }
}
