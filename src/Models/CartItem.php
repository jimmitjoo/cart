<?php


namespace Jimmitjoo\Cart\Models;

use Jimmitjoo\Cart\Traits\UsesUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Jimmitjoo\Cart\Contracts\CartItemContract;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model implements CartItemContract
{
    use UsesUuids, SoftDeletes;

    protected $fillable = [
        'id',
        'cart_uuid',
        'amount',
        'price',
        'discount',
        'title',
        'purchasable_id',
        'purchasable_type',
    ];

    protected $casts = [
        'amount' => 'integer',
        'price' => 'integer',
        'discount' => 'integer',
    ];

    public function cart(): BelongsTo
    {
        return $this->belongsTo(config('cart.models.cart'));
    }

    /**
     * Get the parent purchasable model.
     */
    public function purchasable(): MorphTo
    {
        return $this->morphTo();
    }
}
