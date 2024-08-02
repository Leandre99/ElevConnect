<?php
// app/Mail/MeetingScheduled.php

namespace App\Mail;

use App\Models\Alert;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MeetingScheduled extends Mailable
{
    use Queueable, SerializesModels;

    public $alert;
    public $linkMeet;
    public $meetingDateTime;

    public function __construct(Alert $alert, $linkMeet, $meetingDateTime)
    {
        $this->alert = $alert;
        $this->linkMeet = $linkMeet;
        $this->meetingDateTime = $meetingDateTime;
    }

    public function build()
    {
        return $this->subject('Consultation vétérinaire planifiée')
                    ->view('emails.meeting_scheduled');
    }
}
