<?php

namespace Jimmitjoo\Cart\Observers;

use Illuminate\Support\Str;
use Jimmitjoo\Cart\Events\CartItemAdded;
use Jimmitjoo\Cart\Events\CartItemDeleted;
use Jimmitjoo\Cart\Events\CartItemUpdated;
use Jimmitjoo\Cart\Contracts\CartItemContract;

class CartItemObserver
{
    /**
     * Handle the CartItem "created" event.
     *
     * @param CartItemContract $cartItem
     * @return void
     */
    public function creating(CartItemContract $cartItem)
    {
        if (empty($cart->{$cartItem->getKeyName()})) {
            $cartItem->{$cartItem->getKeyName()} = Str::uuid()->toString();
        }
    }

    /**
     * Handle the CartItem "created" event.
     *
     * @param CartItemContract $cartItem
     * @return void
     */
    public function created(CartItemContract $cartItem)
    {
        CartItemAdded::dispatch($cartItem->cart_uuid);
    }

    /**
     * Handle the CartItem "updated" event.
     *
     * @param CartItemContract $cartItem
     * @return void
     */
    public function updated(CartItemContract $cartItem)
    {
        CartItemUpdated::dispatch($cartItem->cart_uuid);
    }

    /**
     * Handle the CartItem "deleted" event.
     *
     * @param CartItemContract $cartItem
     * @return void
     */
    public function deleted(CartItemContract $cartItem)
    {
        CartItemDeleted::dispatch($cartItem->cart_uuid);
    }
}