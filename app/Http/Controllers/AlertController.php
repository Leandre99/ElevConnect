<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Models\Animal;
use App\Models\Alert;
use App\Models\Maladie;
use Illuminate\Http\Request;
use App\Mail\MeetingScheduled;
use Illuminate\Support\Facades\Mail;

class AlertController extends Controller
{
    public function index()
    {
        if (auth()->user()->role === 'eleveur') {
            $alerts = Alert::with(['ferme', 'race', 'diagnostics.maladie', 'meetings'])
                ->withCount(['diagnostics', 'meetings'])
                ->where('user_id', auth()->id())
                ->latest()
                ->paginate(8);
        } else {
            $alerts = Alert::with(['ferme', 'race', 'diagnostics.maladie', 'meetings'])
                ->withCount(['diagnostics', 'meetings'])
                ->latest()
                ->paginate(8);
        }

        $maladies = Maladie::all();
        return view('alerts.index', compact('alerts', 'maladies'));
    }

    public function create()
    {
        $races = Race::all();
        return view('Animals', compact('races'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'description' => 'required|string',
            'priority' => 'required|string|in:high,medium,low',
            'race_id' => 'required|exists:races,id',
            'ferme_id' => 'required|exists:fermes,id',
            'media' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi,flv|max:2048', // Limitation de la taille à 2MB
        ]);
    
        try {
            $alert = new Alert();
            $alert->description = $validated['description'];
            $alert->priority = $validated['priority'];
            $alert->user_id = auth()->id();
            $alert->race_id = $validated['race_id'];
            $alert->ferme_id = $validated['ferme_id'];
    
            if ($request->hasFile('media')) {
                $file = $request->file('media');
                $path = $file->store('alerts', 'public');
                $alert->media = $path;
            }

            $alert->status = 'Non traitée';
            $alert->save();
    
            return back()->with('success', 'Alerte ajoutée avec succès!');
        } catch (\Exception $e) {
            return back()->with('error', 'Erreur lors de l\'ajout de l\'alerte: ' . $e->getMessage());
        }
    }
    public function disable($id)
    {
        $alert = Alert::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $alert->update(['status' => 'Désactivée']);
        return redirect()->back()->with('success', 'Alerte désactivée avec succès.');
    }


    public function showDiagnostics($alertId)
    {
        $alert = Alert::with('diagnostics.maladie', 'diagnostics.veterinaire')->findOrFail($alertId);

        return view('alerts.diagnostics', compact('alert'));
    }
}
