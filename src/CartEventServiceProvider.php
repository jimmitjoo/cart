<?php


namespace Jimmitjoo\Cart;


use Jimmitjoo\Cart\Events\CartItemAdded;
use Jimmitjoo\Cart\Events\CartItemDeleted;
use Jimmitjoo\Cart\Events\CartItemUpdated;
use Jimmitjoo\Cart\Listeners\CalculateCartPrice;
use Illuminate\Foundation\Support\Providers\EventServiceProvider;

class CartEventServiceProvider extends EventServiceProvider
{
    protected $listen = [
        CartItemAdded::class => [
            CalculateCartPrice::class,
        ],
        CartItemUpdated::class => [
            CalculateCartPrice::class,
        ],
        CartItemDeleted::class => [
            CalculateCartPrice::class,
        ],
    ];
}