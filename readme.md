# Laravel Cart

#### Install the package.

`composer require jimmitjoo/cart`

#### Publish the config and migrations.

`php artisan vendor:publish --tag=laravel-cart`

## Create a new Cart

For example, you can create a new Cart for a user that for some reason doesn't already got a cart.

To use a new cart you should store the ID, which is a uuid string, of the cart somewhere. `$cart->id`

```php
$cart = (new CreateCartAction)->execute();
```

### Create a new Cart with attributes

For example you can create a Cart belonging to a specific User of your system.

```php
$cartData = new CartData((int) $userId);

$cart = (new CreateCartAction)->execute($cartData);
```

You can add some other things to a cart as well. For example a status and a note. Typehints just to clarify what type is
expected by the CartData object.

```php
$cartData = new CartData((int) $userId, (int) $status, (string) $note);

$cart = (new CreateCartAction)->execute($cartData);
```

## Add a product to your Cart

So there are a number of ways to do this.

`Purchasable` is a trait you can add to any model you want your users to be able to purchase.
```php 
$cart->addToCart(Purchasable $purchasable, int $amount = 1, int $discount = 0);
```

You can chain multiple product additions.
```php 
$cart
->addToCart(Purchasable $purchasable)
->addToCart(Purchasable $purchasable);
```

Or you can specifically create a CartItem by yourself by attaching the cart ID.
```php
$cartItemData = new CartItemData(
    1, // Amount of products.
    300, // Current price (minus discount) of the product.
    100, // The discount,
    'Personalized product', // Custom product name
    null, // You could add a purchasable id here
    null, // And the purchasable type here
    $this->cart->id, // Add this item to a cart
);

$cartItem = (new AddCartItemToCartAction)->execute($cartItemData);
```

## Update a cart item

```php
$cartItem = CartItem::find($existingItemId);

$cartItemData = new CartItemData(
    1, // Amount of products.
    88, // Current price (minus discount) of the product.
    12, // The discount,
    'Updated product name', // Custom product name
    null, // You could add a purchasable id here
    null, // And the purchasable type here
    null, // We don't need to specify the cart on update...
    $cartItem->id, // ID of the item to update
);

$cartItem = (new UpdateCartItemAction)->execute($cartItemData);
```

## Remove a cart item
```php
$cartItemToRemove = CartItem::find($existingItemId);

(new RemoveCartItemAction)->execute($cartItemToRemove);
```