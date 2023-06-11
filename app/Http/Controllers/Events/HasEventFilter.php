<?php

namespace App\Http\Controllers\Events;

use App\Models\Accounts\CustodyAccount;
use App\Models\Entities\Custodian;
use App\Models\Entities\Investor;
use App\Models\Entities\Portfolio;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

trait HasEventFilter
{
    protected function getEntitiesForFilter(): array
    {
        return [
            'investors' => Investor::with('custodyAccounts')
                ->has('custodyAccounts')->get(["id", "nickname"])->toArray(),
            'custodians' => Custodian::with('custodyAccounts')
                ->has('custodyAccounts')->get(["id", "nickname"])->toArray(),
            'portfolios' => Portfolio::with('custodyAccounts')
                ->has('custodyAccounts')->get(["id", "nickname"])->toArray(),
            'accounts' => CustodyAccount::with(['investor', 'custodian', 'portfolio'])
                ->get(["id", "nickname", "account_identifier", "custodian_id", "portfolio_id", "investor_id"])
                ->toArray(),
        ];
    }

    protected function getPortfoliosWithEvents(): array
    {
        return Portfolio::with('custodyAccounts')
            ->has('custodyAccounts.accountEvents')
            ->get(["id", "nickname"])->toArray();
    }

    protected function filterEventsByDateAndPortfolio(Request $request, Builder $buildFilter): Builder
    {
        $buildFilter = $this->filterEventsByDate($request, $buildFilter);
        if ($request->exists('portfolio_id') and is_numeric($request->get('portfolio_id'))) {
            $portfolioId = $request->get('portfolio_id');
            $buildFilter->where('custody_accounts.portfolio_id', $portfolioId)
                ->join('custody_accounts', 'account_events.custody_account_id', 'custody_accounts.id');
        }

        return $buildFilter;
    }

    protected function filterEventsByDate(Request $request, Builder $buildFilter): Builder
    {
        if ($request->exists('dtBegin') and strtotime($request->get('dtBegin')) ) {
            $dtBegin = $request->get('dtBegin');
            $buildFilter->where('transaction_date', '>=', $dtBegin);
        }
        if ($request->exists('dtEnd') and strtotime($request->get('dtEnd')) ) {
            $dtEnd = $request->get('dtEnd');
            $buildFilter->where('transaction_date', '<=', $dtEnd);
        }

        return $buildFilter;
    }
}
