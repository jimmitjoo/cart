<?php


namespace Jimmitjoo\Cart\Actions;

use Jimmitjoo\Cart\Models\Cart;
use Jimmitjoo\Cart\DataTransferObjects\CartData;

class CreateCartAction
{
    public function execute(?CartData $cartData = null): Cart
    {
        if (is_null($cartData)) {
            return Cart::create();
        }

        return Cart::create([
            'user_id' => $cartData->userId,
            'note' => $cartData->note,
        ]);
    }
}
