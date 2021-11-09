<?php


namespace Jimmitjoo\Cart\Actions;


use Illuminate\Support\Str;
use Jimmitjoo\Cart\Events\CartItemAdded;
use Jimmitjoo\Cart\Models\CartItem;
use Jimmitjoo\Cart\DataTransferObjects\CartItemData;

class AddCartItemToCartAction
{
    public function execute(CartItemData $cartItemData): CartItem
    {
        return CartItem::create([
            'id' => Str::uuid()->toString(),
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
