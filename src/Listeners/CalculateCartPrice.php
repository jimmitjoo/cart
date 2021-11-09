<?php

namespace Jimmitjoo\Cart\Listeners;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Jimmitjoo\Cart\Events\CartItemAdded;
use Jimmitjoo\Cart\Models\Cart;
use Jimmitjoo\Cart\Models\CartItem;

class CalculateCartPrice
{
    /**
     * Handle the event.
     *
     * @param object $event
     * @return void
     */
    public function handle(CartItemAdded $event)
    {
        $cartItems = CartItem::where('cart_uuid', $event->cartUuid)->get();

        $price = 0;
        $discount = 0;

        foreach ($cartItems as $item) {
            $price += $item->price;
            $discount += $item->discount;
        }

        $cart = Cart::find($event->cartUuid);
        $cart->total_price = $price;
        $cart->total_discount = $discount;
        $cart->total_price_before_discount = $price + $discount;
        $cart->save();
    }
}
