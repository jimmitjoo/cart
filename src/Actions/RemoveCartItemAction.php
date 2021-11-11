<?php


namespace Jimmitjoo\Cart\Actions;


use Jimmitjoo\Cart\Contracts\CartItemContract;

class RemoveCartItemAction
{
    public function execute(CartItemContract $cartItem)
    {
        return $cartItem->delete();
    }
}
