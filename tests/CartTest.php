<?php

namespace Jimmitjoo\Cart\Tests;

use Jimmitjoo\Cart\Actions\CreateCartAction;
use Jimmitjoo\Cart\DataTransferObjects\CartData;

class CartTest extends TestCase
{
    /**
     * @test
     */
    public function it_can_initialize_a_cart()
    {
        $cart = (new CreateCartAction)->execute();

        $this->assertNotEquals(0, $cart->id);
        $this->assertNotEquals(null, $cart->id);
        $this->assertModelExists($cart);
    }

    /**
     * @test
     */
    public function it_can_initialize_a_cart_with_a_user()
    {
        $cartData = new CartData(
            1,
        );

        $cart = (new CreateCartAction)->execute($cartData);

        $this->assertModelExists($cart)
            ->assertDatabaseHas('carts', [
                'user_id' => 1,
            ]);
    }

    /**
     * @test
     */
    public function it_can_initialize_a_cart_with_a_note()
    {
        $cartData = new CartData(
            null,
            'Created by test',
        );

        $cart = (new CreateCartAction)->execute($cartData);

        $this->assertModelExists($cart)
            ->assertDatabaseHas('carts', [
                'note' => 'Created by test',
            ]);
    }

    /**
     * @test
     */
    public function it_can_initialize_a_cart_with_both_a_user_and_a_note()
    {
        $cartData = new CartData(
            1,
            'Created by test',
        );

        $cart = (new CreateCartAction)->execute($cartData);

        $this->assertModelExists($cart)
            ->assertDatabaseHas('carts', [
                'user_id' => $cartData->userId,
                'note' => $cartData->note,
            ]);
    }
}
