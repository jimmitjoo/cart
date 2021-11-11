<?php


namespace Jimmitjoo\Cart\Actions;


use Illuminate\Support\Str;
use Jimmitjoo\Cart\Contracts\CartItemContract;
use Jimmitjoo\Cart\DataTransferObjects\CartItemData;

class AddCartItemToCartAction
{
    public function execute(CartItemData $cartItemData): CartItemContract
    {
        $cartItemClass = config('cart.Models.cart-item');

        return $cartItemClass::create([
            'cart_uuid' => $cartItemData->cartUuid,
            'amount' => $cartItemData->amount,
            'title' => $cartItemData->title,
            'purchasable_id' => $cartItemData->purchasableId,
            'purchasable_type' => $cartItemData->purchasableType,
            'price' => $cartItemData->price,
            'discount' => $cartItemData->discount,
        ]);
    }
}
