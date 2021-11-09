<?php


namespace Jimmitjoo\Cart\Tests;


use Jimmitjoo\Cart\Models\Cart;
use Jimmitjoo\Cart\Actions\CreateCartAction;
use Jimmitjoo\Cart\Actions\AddCartItemToCartAction;
use Jimmitjoo\Cart\DataTransferObjects\CartItemData;

class CartItemTest extends TestCase
{
    private Cart $cart;

    public function setUp(): void
    {
        parent::setUp();

        $this->cart = (new CreateCartAction)->execute();
    }

    /**
     * @test
     */
    public function it_can_create_a_cart_item()
    {
        $cartItemData = new CartItemData(
            1,
            $this->cart->id,
            300,
            100,
            'Personalized product',
        );
        $cartItem = (new AddCartItemToCartAction)->execute($cartItemData);

        $this->assertModelExists($cartItem);
    }
}