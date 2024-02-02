<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UpdateCustomerEvent implements ShouldBroadcast
{
    use Dispatchable, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @param mixed $customer
     * @return void
     */
    public $customer;

    public function __construct($customer)
    {
        $this->customer = $customer;
    }

    public function broadcastOn()
    {
        return new Channel('update-customer-channel'); // Corrected channel name
    }
}
