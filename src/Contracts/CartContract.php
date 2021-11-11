<?php

namespace Jimmitjoo\Cart\Contracts;

use Jimmitjoo\Cart\Traits\Purchasable;
use Illuminate\Database\Eloquent\Relations\HasMany;

interface CartContract
{
    /**
     * Just created, nothing exciting really.
     */
    const INITIATED = 0;

    /**
     * User has saved the cart for later.
     */
    const SAVED = 1;

    /**
     * The user has cancelled the cart. No more actions to be done.
     */
    const CANCELLED = 2;

    /**
     * Thue user has abandoned this cart.
     */
    const ABANDONED = 3;

    /**
     * The user has converted this cart to an order.
     */
    const ORDERED = 4;

    public function cartItems(): HasMany;

    public function addToCart(Purchasable $purchasable, int $amount = 1, int $discount = 0): static;

    public function saveForLater(): void;

    public function cancel(): void;

    public function abandon(): void;

    public function order(): void;
}