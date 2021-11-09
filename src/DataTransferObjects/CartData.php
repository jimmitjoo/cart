<?php


namespace Jimmitjoo\Cart\DataTransferObjects;

class CartData
{
    public function __construct(
        public int|null $userId = null,
        public string|null $note = null,
    )
    {
    }
}
