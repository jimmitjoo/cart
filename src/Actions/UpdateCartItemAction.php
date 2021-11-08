<?php


namespace Jimmitjoo\Cart\Actions;


use Jimmitjoo\Cart\Models\CartItem;
use Jimmitjoo\DataTransferObjects\CartItemData;

class UpdateCartItemAction
{
    public function execute(CartItemData $cartItemData): CartItem
    {
        $cartItem = CartItem::find($cartItemData->id);
        $cartItem->amount = ($cartItemData->amount) ?: $cartItem->amount;
        $cartItem->title = ($cartItemData->title) ?: $cartItem->title;
        $cartItem->price = ($cartItemData->price) ?: $cartItem->price;
        $cartItem->discount = ($cartItemData->discount) ?: $cartItem->discount;
        $cartItem->price_before_discount = ($cartItemData->priceBeforeDiscount) ?: $cartItem->price_before_discount;
        $cartItem->save();

        return $cartItem;
    }
}
