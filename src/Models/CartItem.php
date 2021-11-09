<?php


namespace Jimmitjoo\Cart\Models;

use Jimmitjoo\Cart\Events\CartItemAdded;
use Jimmitjoo\Cart\Traits\UsesUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartItem extends Model
{
    use UsesUuids, SoftDeletes;

    public static function boot()
    {
        parent::boot();

        static::created(function($model) {
            if (is_null($model->cart_uuid)) {
                return;
            }

            CartItemAdded::dispatch($model->cart_uuid);
        });
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    /**
     * Get the parent purchasable model.
     */
    public function purchasable(): MorphTo
    {
        return $this->morphTo();
    }
}
