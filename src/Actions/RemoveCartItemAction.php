<?php


namespace Jimmitjoo\Cart\Actions;


use Jimmitjoo\Cart\Models\CartItem;

class RemoveCartItemAction
{
    public function execute(CartItem $cartItem)
    {
        return $cartItem->delete();
    }
}
