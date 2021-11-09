<?php


namespace Jimmitjoo\Cart\Models;

use Jimmitjoo\Cart\Actions\AddCartItemToCartAction;
use Jimmitjoo\Cart\DataTransferObjects\CartItemData;
use Jimmitjoo\Cart\Traits\Purchasable;
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

    protected $casts = [
        'total_price' => 'integer',
        'total_discount' => 'integer',
        'total_price_before_discount' => 'integer',
    ];

    public function cartItems(): HasMany
    {
        return $this->hasMany(CartItem::class, 'cart_uuid');
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

    public function saveForLater() {
        $this->status = self::SAVED;
        $this->save();
    }

    public function cancel() {
        $this->status = self::CANCELLED;
        $this->save();
    }

    public function abandon() {
        $this->status = self::ABANDONED;
        $this->save();
    }

    public function order() {
        $this->status = self::ORDERED;
        $this->save();
    }
}
