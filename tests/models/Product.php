<?php

namespace Jimmitjoo\Cart\Tests\Models;

use Jimmitjoo\Cart\Traits\Purchasable;

class Product extends Purchasable
{
    protected $fillable = [
        'name',
        'price',
    ];
}