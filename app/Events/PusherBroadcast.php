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
    public $message;
    public $senderId;
    public $recipientId;
    public $file;
    public $chat_id;
    public $file_name;
    public $created_at;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($message, $senderId, $recipientId, $file = null, $chat_id, $file_name = null, $created_at)
    {
        $this->message = $message;
        $this->senderId = $senderId;
        $this->recipientId = $recipientId;
        $this->file = $file;
        $this->chat_id = $chat_id;
        $this->file_name = $file_name;
        $this->created_at = $created_at;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return ['chatroom'.$this->senderId, 'chatroom'.$this->recipientId];
    }
    public function broadcastAs()
    {
        return 'chat-message';
    }
}
