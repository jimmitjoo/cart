<?php


namespace Jimmitjoo\Cart\Models;

use Jimmitjoo\Cart\Actions\AddCartItemToCartAction;
use Jimmitjoo\Cart\Contracts\CartContract;
use Jimmitjoo\Cart\Contracts\CartItemContract;
use Jimmitjoo\Cart\DataTransferObjects\CartItemData;
use Jimmitjoo\Cart\Traits\Purchasable;
use Jimmitjoo\Cart\Traits\UsesUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Cart extends Model implements CartContract
{
    use UsesUuids, SoftDeletes;

    protected $fillable = [
        'id',
        'user_id',
        'status',
        'note',
        'total_price',
        'total_discount',
        'total_price_before_discount',
    ];

    protected $casts = [
        'total_price' => 'integer',
        'total_discount' => 'integer',
        'total_price_before_discount' => 'integer',
    ];

    protected $with = ['cartItems'];

    public function cartItems(): HasMany
    {
        return $this->hasMany(config('cart.Models.cart-item'), 'cart_uuid');
    }

    public function addToCart(Purchasable $purchasable, int $amount = 1, int $discount = 0): static
    {
        $cartItemData = new CartItemData(
            $amount,
            $purchasable->price - $discount,
            $discount,
            null,
            $purchasable->id,
            get_class($purchasable),
            $this->id,
        );

        (new AddCartItemToCartAction)->execute($cartItemData);

        return $this;
    }

    public function saveForLater(): void
    {
        $this->status = self::SAVED;
        $this->save();
    }

    public function cancel(): void
    {
        $this->status = self::CANCELLED;
        $this->save();
    }

    public function abandon(): void
    {
        $this->status = self::ABANDONED;
        $this->save();
    }

    public function order(): void
    {
        $this->status = self::ORDERED;
        $this->save();
    }
}
