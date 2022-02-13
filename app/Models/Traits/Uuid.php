<?php

namespace App\Models\Traits;

use Ramsey\Uuid\Uuid as UuidLib;

trait Uuid
{
    protected static function boot(): void
    {
        parent::boot();
        static::creating(function ($obj) {
            $obj->id = UuidLib::uuid4();
        });
    }
}
