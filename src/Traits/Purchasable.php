<?php


namespace Jimmitjoo\Cart\Traits;


use Jimmitjoo\Cart\Models\CartItem;
use Illuminate\Database\Eloquent\Model;
use Jimmitjoo\Cart\Contracts\PurchasableContract;
use Illuminate\Database\Eloquent\Relations\MorphMany;

abstract class Purchasable extends Model implements PurchasableContract
{
    /**
     * Get all of the purchasable's cartItems.
     */
    public function cartItems(): MorphMany
    {
        return $this->morphMany(CartItem::class, 'purchasable');
    }
}
