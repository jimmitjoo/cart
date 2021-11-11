<?php


namespace Jimmitjoo\Cart\Tests;


use Jimmitjoo\Cart\Models\Cart;
use Jimmitjoo\Cart\Tests\Models\Product;
use Jimmitjoo\Cart\Contracts\CartContract;
use Jimmitjoo\Cart\Actions\CreateCartAction;
use Jimmitjoo\Cart\Actions\RemoveCartItemAction;
use Jimmitjoo\Cart\Actions\UpdateCartItemAction;
use Jimmitjoo\Cart\Actions\AddCartItemToCartAction;
use Jimmitjoo\Cart\DataTransferObjects\CartItemData;

class CartItemTest extends TestCase
{
    private CartContract $cart;

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
            300,
            100,
            'Personalized product',
            null,
            null,
            $this->cart->id,
        );
        $cartItem = (new AddCartItemToCartAction)->execute($cartItemData);

        $this->assertModelExists($cartItem);

        $this->assertEquals(1, $this->cart->cartItems->count());

        $this->cart
            ->addToCart($this->createProduct())
            ->addToCart($this->createProduct(), 2);

        $this->cart = Cart::find($this->cart->id);

        $this->assertEquals(3, $this->cart->cartItems->count());
    }

    /**
     * @test
     */
    public function it_can_update_a_cart_item()
    {
        $cartItem = $this->createCartItem();

        $cartItemData = new CartItemData(
            2, // Update the amount
            88,
            12,
            'Updated product name',
            null,
            null,
            null,
            $cartItem->id,
        );

        $updatedItem = (new UpdateCartItemAction)->execute($cartItemData);


        $this->assertModelExists($updatedItem);
        $this->assertEquals($updatedItem->id, $cartItem->id);
        $this->assertEquals($updatedItem->price, 88);
        $this->assertEquals($updatedItem->discount, 12);
        $this->assertEquals($updatedItem->price_before_discount, 100);
        $this->assertEquals($updatedItem->title, 'Updated product name');
        $this->assertEquals($cartItem->cart_uuid, $updatedItem->cart_uuid);

    }

    /**
     * @test
     */
    public function it_can_delete_a_cart_item()
    {
        $cartItem = $this->createCartItem();

        (new RemoveCartItemAction)->execute($cartItem);

        $this->assertSoftDeleted($cartItem);
    }

    private function createCartItem()
    {
        $cartItemData = new CartItemData(
            1,
            300,
            100,
            'Personalized product',
            null,
            null,
            $this->cart->id,
        );
        return (new AddCartItemToCartAction)->execute($cartItemData);
    }

    private function createProduct()
    {
        return Product::create([
            'name' => 'Product name',
            'price' => rand(1, 999),
        ]);
    }
}