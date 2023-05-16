<?php

namespace App\Models\Events;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MarketEvent extends Model
{
    use HasEventAttributes;
    use SoftDeletes;

    protected $fillable = [
        "disclosure_date",
    ];
}
