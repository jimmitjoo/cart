<?php


namespace Jimmitjoo\Cart\Actions;


use Jimmitjoo\Cart\Models\CartItem;
use Jimmitjoo\DataTransferObjects\CartItemData;

class AddCartItemToCartAction
{
    public function execute(CartItemData $cartItemData): CartItem
    {
        return CartItem::create([
            'cart_uuid' => $cartItemData->cartUuid,
            'amount' => $cartItemData->amount,
            'title' => $cartItemData->title,
            'purchasable_id' => $cartItemData->purchasableId,
            'purchasable_type' => $cartItemData->purchasableType,
            'price' => $cartItemData->price,
            'discount' => $cartItemData->discount,
            'price_before_discount' => $cartItemData->priceBeforeDiscount,
        ]);
    }
}
