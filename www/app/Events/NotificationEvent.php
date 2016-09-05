<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NotificationEvent implements ShouldBroadcast
{
    use InteractsWithSockets, SerializesModels;

    public $notification_data;
    public $channel_id_code;
    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($notification_data, $channel_id_code)
    {
        $this->notification_data = $notification_data;
        $this->channel_id_code = $channel_id_code;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return Channel|array
     */
    public function broadcastOn()
    {
        return new Channel('notification_channel' . $this->channel_id_code);
    }
}
