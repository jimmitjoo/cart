<?php


namespace Jimmitjoo\Cart\Contracts;


use Illuminate\Database\Eloquent\Relations\MorphMany;

interface PurchasableContract
{
    /**
     * Get all of the purchasable's cartItems.
     */
    public function cartItems(): MorphMany;
}