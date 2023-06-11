<?php

namespace App\Services\Events;

use App\Models\Accounts\CustodyAccount;
use App\Models\Events\AccountEvent;
use Illuminate\Http\RedirectResponse;

class AccountEventValidator
{
    public function validate($eventAttrs): bool | string
    {
        $portfolio = CustodyAccount::find($eventAttrs['custody_account_id'])->portfolio;

        if ($portfolio->portfolio_date > $eventAttrs['transaction_date']) {
            return 'Data da transação inferior à data da carteira';
        } elseif($eventAttrs['settlement_date'] < $eventAttrs['transaction_date']) {
            return 'Data da liquidação não pode ser inferior à data da transação';
        } else {
            return true;
        }
    }
    public function validateDestruction($id): bool | string
    {
        $Event = AccountEvent::find($id);
        if($Event->accountedFor()) {
            return 'Evento não pode ser deletado por já ter sido contabilizado';
        } else {
            return true;
        }
    }
}
