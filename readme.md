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

### Create a new Cart with attributes

For example you can create a Cart belonging to a specific User of your system.
```php
$cartData = new CartData((int) $userId);
$cart = (new CreateCartAction)->execute($cartData);
```

You can add some other things to a cart as well. For example a status and a note. Typehints just to clarify what type is expected by the CartData object.
```php
$cartData = new CartData((int) $userId, (int) $status, (string) $note);
$cart = (new CreateCartAction)->execute($cartData);
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