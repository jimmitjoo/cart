<?php

namespace Jimmitjoo\Cart\Observers;

use Illuminate\Support\Str;
use Jimmitjoo\Cart\Contracts\CartContract;

class CartObserver
{
    /**
     * Handle the CartItem "created" event.
     *
     * @param CartContract $cart
     * @return void
     */
    public function creating(CartContract $cart)
    {
        if (empty($cart->{$cart->getKeyName()})) {
            $cart->{$cart->getKeyName()} = Str::uuid()->toString();
        }

        if (is_null($cart->user_id) && auth()->check()) {
            $cart->user_id = auth()->id();
        }
    }

    /**
     * Handle the CartItem "created" event.
     *
     * @param CartContract $cart
     * @return void
     */
    public function created(CartContract $cart)
    {
        //
    }

    /**
     * Handle the CartItem "updated" event.
     *
     * @param CartContract $cart
     * @return void
     */
    public function updated(CartContract $cart)
    {
        //
    }

    /**
     * Handle the CartItem "deleted" event.
     *
     * @param CartContract $cart
     * @return void
     */
    public function deleted(CartContract $cart)
    {
        //
    }

    /**
     * Handle the CartItem "forceDeleted" event.
     *
     * @param CartContract $cart
     * @return void
     */
    public function forceDeleted(CartContract $cart)
    {
        //
    }
}