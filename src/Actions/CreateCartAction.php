<?php


namespace Jimmitjoo\Cart\Actions;

use Illuminate\Support\Str;
use Jimmitjoo\Cart\Contracts\CartContract;
use Jimmitjoo\Cart\DataTransferObjects\CartData;

class CreateCartAction
{
    public function execute(?CartData $cartData = null): CartContract
    {
        $cartClass = config('cart.models.cart');

        if (is_null($cartData)) {
            return $cartClass::create();
        }

        return $cartClass::create([
            'note' => $cartData->note,
            'user_id' => $cartData->userId,
        ]);
    }
}
