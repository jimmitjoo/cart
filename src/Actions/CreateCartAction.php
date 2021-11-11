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
            return $cartClass::create([
                'id' => Str::uuid()->toString(),
            ]);
        }

        return $cartClass::create([
            'id' => Str::uuid()->toString(),
            'user_id' => $cartData->userId,
            'note' => $cartData->note,
        ]);
    }
}
