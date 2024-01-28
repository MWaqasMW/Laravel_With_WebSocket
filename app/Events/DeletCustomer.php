<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DeletCustomer implements ShouldBroadcast
{
    public $customerId;

    public function __construct($customerId)
    {
        $this->customerId = $customerId;
    }

    public function broadcastOn()
    {
        return new Channel('delete-customer-channel');
    }
}
