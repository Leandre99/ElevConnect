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
            'maladie_id' => 'required|string',
            'nouvelle_maladie' => 'nullable|string',
            'symptomes' => 'required|string',
            'traitement' => 'nullable|string',
            'alert_id' => 'required|exists:alerts,id',
            'ferme_id' => 'required|exists:fermes,id',
        ]);

        if ($validated['maladie_id'] === 'autre') {
            Diagnostic::create([
                'maladie_id' => null,
                'alert_id' => $validated['alert_id'],
                'ferme_id' => $validated['ferme_id'],
                'symptomes' => $validated['symptomes'],
                'traitement' => $validated['traitement'],
                'nom_autre_maladie' => $validated['nouvelle_maladie'],
                'symptomes_autre' => $validated['symptomes'],
            ]);
        } else {
            Diagnostic::create([
                'maladie_id' => $validated['maladie_id'],
                'alert_id' => $validated['alert_id'],
                'ferme_id' => $validated['ferme_id'],
                'symptomes' => $validated['symptomes'],
                'traitement' => $validated['traitement'],
            ]);
        }

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
