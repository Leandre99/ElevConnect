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
use App\Models\Meeting;

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

        $meeting = Meeting::create([
            'alert_id' => $alert->id,
            'meeting_date' => $meetingDate,
            'meeting_url' => $meetingUrl,
        ]);

        log_activity('schedule_meeting', 'Meeting', $meeting->id, [
            'alert_id' => $meeting->alert_id,
            'meeting_date' => $meeting->meeting_date,
            'meeting_url' => $meeting->meeting_url,
            'user_id' => $eleveur->id
        ]);

        return redirect()->back()->with('success', 'Réunion planifiée et notification envoyée!');
    }

    private function generateJitsiMeetUrl()
    {
        return 'https://meet.jit.si/' . Str::random(10);
    }
}
