<?php

namespace Jimmitjoo\Cart\Tests;

use Jimmitjoo\Cart\Actions\CreateCartAction;

class CartTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_initialize_a_cart()
    {
        $cart = (new CreateCartAction)->execute();
        dd($cart);
        //\Jimmitjoo\Cart\Models\Cart::create();
    }
}
