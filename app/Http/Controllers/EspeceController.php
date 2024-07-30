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
}
