<?php


namespace Jimmitjoo\Cart\Actions;

use Jimmitjoo\Cart\Models\Cart;
use Jimmitjoo\DataTransferObjects\CartData;

class CreateCartAction
{
    public function execute(?CartData $cartData = null): Cart
    {
        if (is_null($cartData)) {
            return Cart::create();
        }

        return Cart::create([
            'user_id' => $cartData->userId,
            'status' => $cartData->status,
            'note' => $cartData->note,
            'total_price' => $cartData->totalPrice,
            'total_discount' => $cartData->totalDiscount,
            'total_price_before_discount' => $cartData->totalPriceBeforeDiscount,
        ]);
    }
}
