<?php

namespace App\Models\Events;

use App\Models\Accounts\CustodyAccount;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class AccountEvent extends Model
{
    use HasEventAttributes;
    use SoftDeletes;

    protected $fillable = [
        'custody_account_id',
    ];

    /**
     * @param  Builder  $query
     * @return Builder
     */
    public function scopeBovConfirmation($query)
    {
        return $query->where('type', 'bov');
    }

    public function custodyAccount(): belongsTo
    {
        return $this->belongsTo(CustodyAccount::class);
    }

    public function accountedFor(): bool
    {
        return false;
    }
}
