<?php

namespace App\Http\Controllers;

use App\Models\Race;
use App\Models\Alert;
use Illuminate\Http\Request;
use App\Mail\MeetingScheduled;
use Illuminate\Support\Facades\Mail;

class AlertController extends Controller
{
    public function index()
    {
        $alerts = Alert::all();
        return view('alerts.index', compact('alerts'));
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
            'media' => 'nullable|file|mimes:jpeg,png,jpg,gif,mp4,mov,avi,flv',
        ]);

        $alert = new Alert();
        $alert->description = $request->description;
        $alert->priority = $request->priority;
        $alert->user_id = auth()->id();

        if ($request->hasFile('media')) {
            $path = $request->file('media')->store('alerts', 'public');
            $alert->media = $path;
        }

        $alert->save();

        return back();
    }

    private function sendMeetingEmail($alert, $linkMeet, $meetingDateTime)
    {
        Mail::to($alert->user->email)->send(new MeetingScheduled($alert, $linkMeet, $meetingDateTime));
    }
}
