<?php

namespace App\Http\Controllers;

use App\Models\Maladie;
use App\Models\Diagnostic;
use App\Models\Alert;
use Illuminate\Http\Request;

class DiagnosticController extends Controller
{
    public function index()
    {
        //
    }

    public function create($alert_id)
    {
        $alert = Alert::findOrFail($alert_id);
        $maladies = Maladie::where('espece_id', $alert->espece_id)->get();

        return view('diagnostics.create', compact('alert', 'maladies'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'maladie_id' => 'required|exists:maladies,id',
            'symptomes' => 'required|string',
            'traitement' => 'nullable|string',
            'alert_id' => 'required|exists:alerts,id',
        ]);

        Diagnostic::create([
            'veterinaire_id' => auth()->id(),
            'maladie_id' => $validated['maladie_id'],
            'symptomes' => $validated['symptomes'],
            'date' => now(),
            'traitement' => $validated['traitement'],
            'alert_id' => $validated['alert_id'],
        ]);

        $alert = Alert::findOrFail($validated['alert_id']);
        $alert->update(['status' => 'Traitée']);

        return redirect()->route('alerts.index')
            ->with('success', 'Diagnostic enregistré et alerte traitée avec succès.');
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
