<?php

namespace App\Http\Controllers;

use App\Models\Race;
use Illuminate\Http\Request;

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
}
