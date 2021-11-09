<?php

namespace Jimmitjoo\Cart\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Jimmitjoo\Cart\Models\Cart;

class CartItemAdded
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $cartUuid;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(string $cartUuid)
    {
        $this->cartUuid = $cartUuid;
    }
}
