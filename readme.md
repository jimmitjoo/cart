# Laravel Cart

#### Install the package.

`composer require jimmitjoo/cart`

#### Publish the config and migrations.

`php artisan vendor:publish --tag=cart`


## Create a new Cart

For example, you can create a new Cart for a user that for some reason doesn't already got a cart.

```php
$cart = (new CreateCartAction)->execute();
```

## Add item to Cart

```php
$cartItemData = new CartItemData(
    1, // Amount of products.
    $cart->id, // ID of cart to add this item to.
    $title, // It is possible to add a title for a row, but is nullable
    $purchasableId, // A purchasable product ID
    $purchasableType, // A purchasable product type
    $price, // Current price of the product.
    $discount, // Item discount,
);
$cartItem = (new AddCartItemToCartAction)->execute($cartItemData);
```