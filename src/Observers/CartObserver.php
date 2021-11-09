<?php

namespace Jimmitjoo\Cart\Observers;

use Illuminate\Support\Str;
use Jimmitjoo\Cart\Models\Cart;
use Jimmitjoo\Cart\Events\CartItemAdded;

class CartObserver
{
    /**
     * Handle the CartItem "created" event.
     *
     * @param Cart $cart
     * @return void
     */
    public function creating(Cart $cart)
    {
        if (empty($cart->{$cart->getKeyName()})) {
            $cart->{$cart->getKeyName()} = Str::uuid()->toString();
        }
    }

    /**
     * Handle the CartItem "created" event.
     *
     * @param Cart $cart
     * @return void
     */
    public function created(Cart $cart)
    {
        //
    }

    /**
     * Handle the CartItem "updated" event.
     *
     * @param Cart $cart
     * @return void
     */
    public function updated(Cart $cart)
    {
        //
    }

    /**
     * Handle the CartItem "deleted" event.
     *
     * @param Cart $cart
     * @return void
     */
    public function deleted(Cart $cart)
    {
        //
    }

    /**
     * Handle the CartItem "forceDeleted" event.
     *
     * @param Cart $cart
     * @return void
     */
    public function forceDeleted(Cart $cart)
    {
        //
    }
}