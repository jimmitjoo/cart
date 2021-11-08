<?php


namespace Jimmitjoo\Cart\Models;

use Jimmitjoo\Cart\Traits\UsesUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model
{
    use UsesUuids, SoftDeletes;

    /**
     * Just created, nothing exciting really.
     */
    const INITIATED = 0;

    /**
     * User has saved the cart for later.
     */
    const SAVED = 1;

    /**
     * The user has cancelled the cart. No more actions to be done.
     */
    const CANCELLED = 2;

    /**
     * Thue user has abandoned this cart.
     */
    const ABANDONED = 3;

    /**
     * The user has converted this cart to an order.
     */
    const ORDERED = 4;

    protected $fillable = [
        'user_id',
        'status',
        'note',
        'total_price',
        'total_discount',
        'total_price_before_discount',
    ];

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class);
    }
}
