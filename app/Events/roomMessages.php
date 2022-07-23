<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class roomMessages implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * @var
     */
    public $message;
    public $room_id;
    public $sender_id;
    public $date;

    /**
     * Create a new event instance.
     *
     * @param $message
     * @param $room_id
     * @param $sender_id
     * @param $date
     */
    public function __construct($message, $room_id, $sender_id, $date)
    {
        $this->message = $message;
        $this->room_id = $room_id;
        $this->sender_id = $sender_id;
        $this->date = $date;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn(): Channel
    {
        return new Channel('room.' . $this->room_id);
    }

    /**
     * @return string
     */
    public function broadcastAs(): string
    {
        return 'new_message';
    }

}
