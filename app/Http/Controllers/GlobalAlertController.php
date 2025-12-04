<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Alert;
use App\Models\Diagnostic;
use App\Models\Espece;
use App\Models\Race;

class GlobalAlertController extends Controller
{
    public function index(Request $request)
    {
        // Récupération des filtres
        $espece_id = $request->input('espece_id');
        $race_id = $request->input('race_id');

        // Query des alertes avec diagnostics
        $alerts = Alert::with(['diagnostics', 'ferme', 'race', 'diagnostics.veterinaire'])
            ->when($espece_id, fn($q) => $q->where('espece_id', $espece_id))
            ->when($race_id, fn($q) => $q->where('race_id', $race_id))
            ->latest()
            ->paginate(15);

        $especes = Espece::all();
        $races = Race::all();

        return view('global_alerts.index', compact('alerts', 'especes', 'races', 'espece_id', 'race_id'));
    }
}
