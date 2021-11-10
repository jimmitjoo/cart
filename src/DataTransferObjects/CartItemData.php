<?php


namespace Jimmitjoo\Cart\DataTransferObjects;

class CartItemData
{
    public function __construct(
        public ?int $amount,
        public ?int $price = null,
        public ?int $discount = null,
        public ?string $title = null,
        public ?string $purchasableId = null,
        public ?string $purchasableType = null,
        public ?string $cartUuid,
        public ?string $id = null,
    )
    {
    }
}
