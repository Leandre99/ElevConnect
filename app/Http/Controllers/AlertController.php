<?php

namespace App\Http\Controllers;

use App\Models\Alert;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\MeetingScheduled;

class AlertController extends Controller
{
    public function index()
    {
        $alerts = Alert::all();
        return view('alerts.index', compact('alerts'));
    }
    public function create()
    {
        return view('alerts.create');
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

        return redirect()->route('alerts.index');
    }

    public function intervene(Request $request, $alertId)
    {
        $alert = Alert::findOrFail($alertId);

        // Générer le lien Google Calendar
        $googleCalendarLink = $this->getGoogleCalendarLink($alert);

        // Envoyer un email à l'éleveur
        $meetingDateTime = now()->addDays(1); // Vous pouvez ajuster cette date et heure selon vos besoins
        $this->sendMeetingEmail($alert, $googleCalendarLink, $meetingDateTime);

        return redirect($googleCalendarLink);
    }

    private function getGoogleCalendarLink($alert)
    {
        $description = urlencode("Intervention pour l'alerte: " . $alert->description);
        $start = now()->addDays(1)->format('Ymd\THis');
        $end = now()->addDays(1)->addHour()->format('Ymd\THis');
        $url = "https://calendar.google.com/calendar/r/eventedit?text=Consultation+vétérinaire&details={$description}&dates={$start}/{$end}";

        return $url;
    }

    private function sendMeetingEmail($alert, $linkMeet, $meetingDateTime)
    {
        Mail::to($alert->user->email)->send(new MeetingScheduled($alert, $linkMeet, $meetingDateTime));
    }
}
