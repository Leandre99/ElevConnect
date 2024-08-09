<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class MeetingScheduled extends Notification
{
    use Queueable;

    protected $meetingUrl;
    protected $date;

    public function __construct($meetingUrl, $date)
    {
        $this->meetingUrl = $meetingUrl;
        $this->date = $date;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Réunion Planifiée')
            ->greeting('Bonjour!')
            ->line("Une réunion a été planifiée pour le {$this->date}.")
            ->action('Rejoindre la Réunion', $this->meetingUrl)
            ->line('Merci d\'utiliser notre application!');
    }

    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
