<?php


namespace Jimmitjoo\Cart\Traits;


trait UsesUuids
{
    public function getIncrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'string';
    }
}
