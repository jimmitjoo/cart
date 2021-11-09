<?php


namespace Jimmitjoo\Cart\DataTransferObjects;

class CartData
{
    public function __construct(
        public int|null $userId = null,
        public int $status = 0,
        public string|null $note = null,
    )
    {
    }
}
