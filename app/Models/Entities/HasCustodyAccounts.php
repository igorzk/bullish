<?php

namespace App\Models\Entities;

use App\Models\Accounts\CustodyAccount;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasCustodyAccounts
{
    public function custodyAccounts(): hasMany
    {
        return $this->hasMany(CustodyAccount::class);
    }
}
