<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class PusherBroadcast implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public string $message;
    public $veterinaireId;

    public function __construct(string $message, $veterinaireId)
    {
        $this->message = $message;
        $this->veterinaireId = $veterinaireId;
    }


    public function broadcastOn()
    {
        return new Channel('public.' . $this->veterinaireId);
    }

    public function broadcastAs(): string
    {
        return 'chat';
    }
}
