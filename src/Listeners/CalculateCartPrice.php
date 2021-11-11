<?php

namespace Jimmitjoo\Cart\Listeners;

use Jimmitjoo\Cart\Events\CartItemAdded;
use Jimmitjoo\Cart\Events\CartItemDeleted;
use Jimmitjoo\Cart\Events\CartItemUpdated;

class CalculateCartPrice
{
    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(CartItemAdded|CartItemUpdated|CartItemDeleted $event)
    {
        $cartClass = config('cart.Models.cart');
        $cartItemClass = config('cart.Models.cart-item');

        $cartItems = $cartItemClass::where('cart_uuid', $event->cartUuid)->get();

        $price = 0;
        $discount = 0;

        foreach ($cartItems as $item) {
            $price += $item->price;
            $discount += $item->discount;
        }

        $cart = $cartClass::find($event->cartUuid);
        $cart->total_price = $price;
        $cart->total_discount = $discount;
        $cart->total_price_before_discount = $price + $discount;
        $cart->save();
    }
}
