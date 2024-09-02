<?php

namespace App\Http\Controllers;

use App\Mail\Alermail;
use App\Models\User;
use App\Models\Alert;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Notifications\MeetingScheduled;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

class MeetingController extends Controller
{
    public function schedule(Request $request)
{
    $request->validate([
        'meetingDate' => 'required|date',
        'alert_id' => 'required|exists:alerts,id',
    ]);

    $alert = Alert::find($request->alert_id);

    $meetingDate = $request->meetingDate;

    $meetingUrl = $this->generateJitsiMeetUrl();


    $eleveur = User::find($alert->user_id);

    Mail::to($eleveur->email)->send(new Alermail($meetingUrl, $meetingDate));
    return redirect()->back()->with('success', 'Réunion planifiée et notification envoyée!');
}


    private function generateJitsiMeetUrl()
    {
        // Génère un URL unique pour la réunion Jitsi Meet
        return 'https://meet.jit.si/' . Str::random(10);
    }
}
