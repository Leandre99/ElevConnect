<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class Alermail extends Mailable
{
    use Queueable, SerializesModels;

    public $meetingUrl;
    public $meetingDate;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($meetingUrl, $meetingDate)
    {
        $this->meetingUrl = $meetingUrl;
        $this->meetingDate = $meetingDate;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.meeting_scheduled')->with([
            'meetingUrl' => $this->meetingUrl,
            'meetingDate' => $this->meetingDate,
        ]);
    }
}
