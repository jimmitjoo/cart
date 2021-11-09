<?php

namespace Jimmitjoo\Cart\Observers;

use Jimmitjoo\Cart\Events\CartItemDeleted;
use Jimmitjoo\Cart\Models\CartItem;
use Jimmitjoo\Cart\Events\CartItemAdded;
use Jimmitjoo\Cart\Events\CartItemUpdated;

class CartItemObserver
{
    /**
     * Handle the CartItem "created" event.
     *
     * @param CartItem $cartItem
     * @return void
     */
    public function creating(CartItem $cartItem)
    {
        //
    }

    /**
     * Handle the CartItem "created" event.
     *
     * @param CartItem $cartItem
     * @return void
     */
    public function created(CartItem $cartItem)
    {
        CartItemAdded::dispatch($cartItem->cart_uuid);
    }

    /**
     * Handle the CartItem "updated" event.
     *
     * @param CartItem $cartItem
     * @return void
     */
    public function updated(CartItem $cartItem)
    {
        CartItemUpdated::dispatch($cartItem->cart_uuid);
    }

    /**
     * Handle the CartItem "deleted" event.
     *
     * @param CartItem $cartItem
     * @return void
     */
    public function deleted(CartItem $cartItem)
    {
        CartItemDeleted::dispatch($cartItem->cart_uuid);
    }
}