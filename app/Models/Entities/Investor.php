<?php

namespace App\Models\Entities;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Gate;

class Investor extends Model
{
    use HasFactory;
    use HasEntityAttributes;
    use HasCustodyAccounts;

    public function nickname(): Attribute
    {
        return Attribute::make(
            get: function ($value) {
                if (Gate::allows('view-investors')) {
                   return $value;
                } else {
                    return "inv-$this->id";
                }
            }
        );
    }
}
