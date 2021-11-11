<?php

namespace Jimmitjoo\Cart\Contracts;

use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

interface CartItemContract
{
    /**
     * Get the Cart this Item belongs to.
     * @return BelongsTo
     */
    public function cart(): BelongsTo;

    /**
     * Get the purchasable model in this item.
     */
    public function purchasable(): MorphTo;
}