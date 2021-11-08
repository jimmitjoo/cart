<?php


namespace Jimmitjoo\Cart\Traits;


use Illuminate\Support\Str;

trait UsesUuids
{
    protected static function boot() {
        parent::boot();

        static::creating(function($model) {
            if (empty($model->{$model->getKeyName()})) {
                $model->{$model->getKeyName()} = Str::uuid()->toString();
            }
        });
    }

    public function getIncrementing(): bool
    {
        return false;
    }

    public function getKeyType(): string
    {
        return 'string';
    }
}
