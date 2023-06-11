<?php

namespace App\Http\Livewire;

use App\Models\Accounts\CustodyAccount;
use App\Models\Entities\Custodian;
use App\Models\Entities\Investor;
use App\Models\Entities\Portfolio;
use App\Models\Events\AccountEvent;
use Livewire\Component;

class SelectAccount extends Component
{
    public $investors;
    public $custodians;
    public $portfolios;
    public $accounts;
    public $investorsPool;
    public $custodiansPool;
    public $portfoliosPool;
    public $accountsPool;
    public $investor_id = "";
    public $custodian_id = "";
    public $portfolio_id = "";
    public $account_id = "";
    public $oldAccountId = null;

    public function mount()
    {
        $this->investorsPool = $this->investors;
        $this->custodiansPool = $this->custodians;
        $this->portfoliosPool = $this->portfolios;
        $this->accountsPool = $this->accounts;

        if (old('account_id') and is_numeric(old('account_id'))) {
            $this->oldAccountId = old('account_id');
            $this->account_id = $this->oldAccountId;
            $this->accountChanged();
        }
    }

    public function render()
    {
        return view('livewire.select-account');
    }

    public function entityChanged($entityName, $deletion = false)
    {
        if ($deletion and ($this->custodian_id == "" and $this->investor_id == "" and $this->portfolio_id == "")) {
            $this->accountsReset();
        } else {
            $this->filterAccounts();
            if (count($this->accountsPool) > 1) {
                $entities = ["investor", "portfolio", "custodian"];
                foreach ($entities as $entity) {
                    $idName = $entity . '_id';
                    $poolName = $entity . 'sPool';
                    if ($this->$idName == "") {
                        $this->$poolName = $this->getAccountPoolRelation($entity);
                        if ($deletion and count($this->$poolName) == 1) {
                            $this->$poolName = [["id" => "", "nickname" => "Selecione..."], ...$this->$poolName];
                        }
                        if ((count($this->$poolName) == 1) and ($entityName != $entity)) {
                            $this->$idName = $this->$poolName[array_key_first($this->$poolName)]["id"];
                        }
                    }
                }
            } elseif (count($this->accountsPool) == 1) {
                $this->account_id = $this->accountsPool[array_key_first($this->accountsPool)]["id"];
                $this->accountChanged();
            }
        }
    }

    public function accountChanged()
    {
        $account = $this->getById($this->accounts, $this->account_id);
        $investor = $account["investor"];
        $custodian = $account["custodian"];
        $portfolio = $account["portfolio"];

        $this->investorsPool = [$investor];
        $this->custodiansPool = [$custodian];
        $this->portfoliosPool = [$portfolio];
        $this->accountsPool = [$account];

        $this->account_id = $account["id"];
        $this->custodian_id = $custodian["id"];
        $this->portfolio_id = $portfolio["id"];
    }

    public function accountsReset()
    {
        $this->investorsPool = $this->investors;
        $this->custodiansPool = $this->custodians;
        $this->portfoliosPool = $this->portfolios;
        $this->accountsPool = $this->accounts;
        $this->account_id = $this->investor_id = $this->custodian_id = $this->portfolio_id = "";
        $this->oldAccountId = null;
    }

    public function entityReset($entity)
    {
        $idName = $entity . '_id';
        $this->$idName = "";

        $poolName = $entity . 'sPool';
        $this->$poolName = ["", ...$this->$poolName];

        $this->entityChanged($entity, true);
    }

    private function filterAccounts()
    {
        $this->accountsPool = $this->accounts;

        if ($this->investor_id != "") {
            $this->accountsPool = array_filter($this->accountsPool,
                fn($acc) => $this->entityHasAccount($acc, $this->investor_id, 'investor'));
        }

        if ((count($this->accountsPool) > 0) and ($this->custodian_id != "")) {
            $this->accountsPool = array_filter($this->accountsPool,
                fn($acc) => $this->entityHasAccount($acc, $this->custodian_id, 'custodian'));
        }

        if ((count($this->accountsPool) > 0) and ($this->portfolio_id != "")) {
            $this->accountsPool = array_filter($this->accountsPool,
                fn($acc) => $this->entityHasAccount($acc, $this->portfolio_id, 'portfolio'));
        }
    }

    private function getById($array, $id)
    {
        $filtered = array_filter($array, fn($el) => $el["id"] == $id);
        return $filtered[array_key_first($filtered)];
    }

    private function entityHasAccount($account, $entity_id, $relation)
    {
        $entities = $account[$relation];
        return in_array($entity_id, $entities);
    }

    private function getAccountPoolRelation($relation)
    {
        $entities = [];
        foreach ($this->accountsPool as $account) {
            if (! in_array($account[$relation]["id"], $entities)) {
                $entities[$account[$relation]["id"]] = $account[$relation];
            }
        }
        return $entities;
    }


}
