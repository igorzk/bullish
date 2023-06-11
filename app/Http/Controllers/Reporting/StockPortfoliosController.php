<?php

namespace App\Http\Controllers\Reporting;

use App\Http\Controllers\Controller;
use App\Models\Entities\Portfolio;
use App\Models\Events\AccountEvent;
use App\Models\Market\Asset;
use Illuminate\Http\Request;

class StockPortfoliosController extends Controller
{
    public function index(Request $request)
    {
        $stocks = Asset::bovStock()->get(["id", "name"])->toArray();
        $portfolios = Portfolio::with('custodyAccounts.accountEvents')
            ->has('custodyAccounts.accountEvents')
            ->get(["id", "nickname"])->toArray();
        return view("reports.stockportfolios", compact('portfolios', 'stocks'));
    }
}
