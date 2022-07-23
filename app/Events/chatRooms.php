<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class chatRooms implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $user_id;
    public $room_id;
    public $data;

    /**
     * Create a new event instance.
     *
     * @param $user_id
     * @param $room_id
     * @param $data
     */
    public function __construct($user_id, $room_id, $data)
    {
        $this->user_id = $user_id;
        $this->room_id = $room_id;
        $this->data = $data;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel
     */
    public function broadcastOn(): Channel
    {
        return new Channel('room_user.' . $this->user_id);
    }

    public function broadcastAs(): string
    {
        return 'new_room_request';
    }
}
