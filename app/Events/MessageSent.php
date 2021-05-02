<?php

namespace App\Events;

// use App\Models\User;
// use App\Models\Message;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class MessageSent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $message_id;
    public $foobar;

    // public function __construct($message_id, $foobar)
    // {
    //     $this->message_id = $message_id;
    //     $this->foobar = $foobar;
    // }

    public function __construct()
    {
        
    }

    public function broadcastOn()
    {
        return new PrivateChannel('chat');
    }
}
