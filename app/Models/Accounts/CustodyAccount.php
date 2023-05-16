<?php

namespace App\Models\Accounts;

use App\Models\Entities\{Custodian, Investor, Portfolio};
use App\Models\Events\AccountEvent;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Str;

class CustodyAccount extends Model
{
    use HasFactory;

    public function custodian(): BelongsTo
    {
        return $this->belongsTo(Custodian::class);
    }

    public function investor(): BelongsTo
    {
        return $this->belongsTo(Investor::class);
    }

    public function portfolio(): BelongsTo
    {
        return $this->belongsTo(Portfolio::class);
    }

    public function accountEvents(): hasMany
    {
        return $this->hasMany(AccountEvent::class);
    }

    protected $fillable = [
        'nickname',
        'account_identifier',
        'custodian_id',
        'investor_id',
        'portfolio_id',
    ];

    protected function nickname(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => ucwords($value),
            set: fn ($value) => Str::lower($value)
        );
    }

}
