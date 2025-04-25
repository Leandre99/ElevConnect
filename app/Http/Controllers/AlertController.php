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
            $alerts = Alert::with(['ferme', 'race', 'diagnostics.maladie'])
                           ->withCount(['diagnostics','meetings'])
                           ->where('user_id', auth()->id())
                           ->where('is_active', true)
                           ->paginate(8);
        } else {
            $alerts = Alert::with(['ferme', 'race', 'diagnostics.maladie'])
                           ->withCount(['diagnostics','meetings'])
                           ->where('is_active', true)
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
        $request->validate([
            'description' => 'required',
            'priority' => 'required',
            'race_id' => 'required|exists:races,id',
            'ferme_id' => 'required|exists:fermes,id',
            'media' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi,flv',
        ]);

        $alert = new Alert();
        $alert->description = $request->description;
        $alert->priority = $request->priority;
        $alert->user_id = auth()->id();
        $alert->race_id = $request->race_id;
        $alert->ferme_id = $request->ferme_id;

        if ($request->hasFile('media')) {
            $file = $request->file('media');
            $path = $file->store('alerts', 'public');
            $alert->media = $path;
        }

        $alert->save();

        return back();
    }

    public function disable($id)
{
    $alert = Alert::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
    $alert->update(['is_active' => false]);

    return redirect()->back()->with('success', 'Alerte désactivée avec succès.');
}

public function showDiagnostics($alertId)
{
    $alert = Alert::with('diagnostics.maladie', 'diagnostics.veterinaire')->findOrFail($alertId);

    return view('alerts.diagnostics', compact('alert'));
}

}
