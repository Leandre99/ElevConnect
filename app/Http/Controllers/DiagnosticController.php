<?php

namespace App\Http\Controllers;
use App\Models\Animal;
use App\Models\Maladie;
use Illuminate\Http\Request;

class DiagnosticController extends Controller
{

    public function index()
    {
        //
    }
    public function create(Animal $animal)
    {
        $maladies = Maladie::where('espece_id', $animal->espece_id)->get();
        return view('diagnostics.create', compact('animal', 'maladies'));
    }

    public function store(Request $request, Animal $animal)
    {
        $validated = $request->validate([
            'maladie_id' => 'required|exists:maladies,id',
            'nombre_cas' => 'required|integer|min:1|max:' . $animal->nombre,
            'traitement' => 'nullable|string'
        ]);

        $animal->diagnostics()->create([
            'maladie_id' => $validated['maladie_id'],
            'nombre_cas' => $validated['nombre_cas'],
            'date_apparition' => now(),
            'statut' => 'suspecte',
            'traitement' => $validated['traitement']
        ]);

        return redirect()->route('animals.show', $animal)
            ->with('success', 'Diagnostic enregistré');
    }

    public function show(string $id)
    {
        //
    }

    public function edit(string $id)
    {
        //
    }

    public function update(Request $request, string $id)
    {
        //
    }

    public function destroy(string $id)
    {
        //
    }
}
