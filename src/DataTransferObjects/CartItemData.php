<?php


namespace Jimmitjoo\Cart\DataTransferObjects;

class CartItemData
{
    public function __construct(
        public ?int $amount,
        public ?string $cartUuid,
        public ?int $price = null,
        public ?int $discount = null,
        public ?string $title = null,
        public ?int $purchasableId = null,
        public ?string $purchasableType = null,
    )
    {
    }
}
