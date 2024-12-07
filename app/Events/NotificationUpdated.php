<?php

namespace App\Events;

use App\Models\Notification;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NotificationUpdated implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $unreadCount;

    // You can pass data you want to broadcast, e.g., unread notification count
    public function __construct($unreadCount)
    {
        $this->unreadCount = $unreadCount;
    }

    // The channel on which the event will be broadcast
    public function broadcastOn()
    {
        return new Channel('notifications.' . auth()->id()); // Channel name
    }

    // This method will define the broadcast data
    public function broadcastWith()
    {
        return [
            'unreadCount' => $this->unreadCount
        ];
    }
}
