<?php


namespace Jimmitjoo\Cart\Actions;


use Jimmitjoo\Cart\Contracts\CartItemContract;
use Jimmitjoo\Cart\DataTransferObjects\CartItemData;

class UpdateCartItemAction
{
    public function execute(CartItemData $cartItemData): CartItemContract
    {
        $cartItemClass = config('cart.models.cart-item');

        $cartItem = $cartItemClass::find($cartItemData->id);
        $cartItem->amount = ($cartItemData->amount) ?: $cartItem->amount;
        $cartItem->title = ($cartItemData->title) ?: $cartItem->title;
        $cartItem->price = ($cartItemData->price) ?: $cartItem->price;
        $cartItem->discount = ($cartItemData->discount) ?: $cartItem->discount;
        $cartItem->price_before_discount = $cartItem->price + $cartItem->discount;
        $cartItem->save();

        return $cartItem;
    }
}
