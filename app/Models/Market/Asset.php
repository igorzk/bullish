<?php

namespace App\Models\Market;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Asset extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'name',
        'type',
        'attributes',
    ];

    protected $casts = [
        'attributes' => 'array',
    ];

    public function scopeBovStock($query)
    {
        return $query->where('type', 'bov_stock');
    }

    public function scopeOfType($query, $type)
    {
        return $query->where('type', $type);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => Str::upper($value)
        );
    }

}
