<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Support\Str;

trait HasEntityAttributes
{
    public function initializeHasEntityAttributes()
    {
        $this->fillable = [
            ...$this->fillable,
            'nickname',
        ];
    }

    protected function nickname(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => Str::lower($value)
        );
    }
}
