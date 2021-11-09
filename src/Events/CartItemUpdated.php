<?php

namespace Jimmitjoo\Cart\Events;

use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;

class CartItemUpdated
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
