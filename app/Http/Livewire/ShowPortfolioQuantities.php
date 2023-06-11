<?php

namespace App\Http\Livewire;

use Livewire\Component;

class ShowPortfolioQuantities extends Component
{
    public $portfolios;
    public $selectedPortfolio = 'empty';
    public $stocks;
    public $stockQuantities = [];
    public $portfolioName = "";

    public function updatedSelectedPortfolio()
    {
        $searching = null;
        foreach ($this->portfolios as $portfolio) {
            if ($portfolio["id"] == $this->selectedPortfolio) {
                $searching = $portfolio;
                $this->portfolioName = $searching["nickname"];
                break;
            }
        }
        if (!is_null($searching)) {
            $transactions = $this->getTransactions($searching);
            $this->stockQuantities = $this->getQuantities($transactions);
        }
    }

    private function getTransactions($portfolio)
    {
        $transactions = [];
        $accounts = $portfolio['custody_accounts'];
        foreach ($accounts as $account) {
            $events = $account['account_events'];
            foreach ($events as $event) {
                $transactions = [...$transactions,
                    ...$event["body"]["transactions"]];
            }
        }
        $transactions = array_map(fn ($x) =>
            array_merge($x, ['asset_name' => $this->getStockName($x["asset_id"])]),
            $transactions);
        return $transactions;
    }

    private function getStockName($id)
    {
        foreach ($this->stocks as $stock) {
            if ($stock["id"] == $id) {
                return $stock["name"];
            }
        }
    }

    private function getQuantities($transactions)
    {
        $arr = array_reduce($transactions,
            function ($carry, $t) {
                if (array_key_exists($t["asset_name"], $carry)) {
                    $carry[$t["asset_name"]] += $t["quantity"];
                } else {
                    $carry[$t["asset_name"]] = $t["quantity"];
                }
                return $carry;
            },
            []
        );
        foreach ($arr as $name => $qtd) {
            if ($qtd == 0) {
                unset($arr[$name]);
            }
        }

        return $arr;
    }
    public function render()
    {
        return view('livewire.show-portfolio-quantities');
    }
}
