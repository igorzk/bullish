<div>
    @if($account_id == "")
    <div class="row">
        <div class="col-4 col-sm-3 pe-sm-2">
            <label class="form-label" for="custodian_id">Corretora</label>
                <select wire:change="entityChanged('custodian', false)" wire:model="custodian_id" name="custodian_id" id="custodian_id" class="form-select me-1" required
                    @if($custodian_id != "") disabled @endif
                >
                    @if(count($custodiansPool) > 1)
                        <option value="" selected disabled hidden>Selecione...</option>
                    @endif
                    @foreach ($custodiansPool as $custodian)
                        <option value="{{ $custodian["id"] }}">
                            {{ $custodian["nickname"] }}
                        </option>
                    @endforeach
                </select>
        </div>
        @if($custodian_id != "")
            <div class="pt-4 mt-3 col-1">
                <input wire:click="entityReset('custodian')" type="button" class="btn btn-close">
            </div>
        @else
            <div class="pt-4 mt-3 col-1">
            </div>
        @endif
        <div class="col-4 col-sm-3 pe-sm-2">
            <label class="form-label" for="investor_id">Investidor(a)</label>
            <select wire:change="entityChanged('investor', false)" wire:model="investor_id" name="investor_id" id="investor_id" class="form-select" required
                    @if($investor_id != "") disabled @endif
            >
                @if(count($investorsPool) > 1)
                    <option value="" selected disabled hidden>Selecione...</option>
                @endif
                @foreach ($investorsPool as $investor)
                    <option value="{{ $investor["id"] }}">
                        {{ $investor["nickname"] }}
                    </option>
                @endforeach
            </select>
        </div>
        @if($investor_id != "")
            <div class="pt-4 mt-3 col-1">
                <input wire:click="entityReset('investor')" type="button" class="btn btn-close">
            </div>
        @else
            <div class="pt-4 mt-3 col-1">
            </div>
        @endif
        <div class="col-4 col-sm-3 pe-sm-2">
            <label class="form-label" for="portfolio_id">Carteira</label>
            <select wire:change="entityChanged('portfolio', false)" wire:model="portfolio_id" name="portfolio_id" id="portfolio_id" class="form-select" required
                    @if($portfolio_id != "") disabled @endif
            >
                @if(count($portfoliosPool) > 1)
                    <option value="" selected disabled hidden>Selecione...</option>
                @endif
                @foreach ($portfoliosPool as $portfolio)
                    <option value="{{ $portfolio["id"] }}">
                        {{ $portfolio["nickname"] }}
                    </option>
                @endforeach
            </select>
        </div>
        @if($portfolio_id != "")
            <div class="pt-4 mt-3 col-1">
                <input wire:click="entityReset('portfolio')" type="button" class="btn btn-close">
            </div>
        @else
            <div class="pt-4 mt-3 col-1">
            </div>
        @endif
    </div>
    @else
        <fieldset class="row" disabled>
            <div class="col-4 col-sm-3 pe-sm-2">
                <label for="selectedcustodian" class="form-label">Corretora </label>
                <input id="selectedcustodian" class="form-control" value="{{ $custodiansPool[array_key_first($custodiansPool)]["nickname"] }}">
            </div>
            <div class="pt-4 mt-3 col-1">
            </div>
            <div class="col-4 col-sm-3 pe-sm-2">
                <label for="selectedinvestor" class="form-label">Investidor(a) </label>
                <input id="selectedinvestor" class="form-control" value="{{ $investorsPool[array_key_first($investorsPool)]["nickname"] }}">
            </div>
            <div class="pt-4 mt-3 col-1">
            </div>
            <div class="col-4 col-sm-3 pe-sm-2">
                <label for="selectedinvestor" class="form-label">Carteira </label>
                <input id="selectedinvestor" class="form-control" value="{{ $portfoliosPool[array_key_first($portfoliosPool)]["nickname"] }}">
            </div>
            <div class="pt-4 mt-3 col-1">
            </div>
        </fieldset>
    @endif
    <div class="row py-2 mb-2">
        <div class="w-50 col-sm-6 col-10 mb-3">
            @if(count($accountsPool) == 0)
                <span class="text-muted">Não existem contas cadastradas com esses dados...</span>
            @else
                <label class="form-label" for="account_id">Conta</label>
                @if($account_id == "")
                <select wire:change="accountChanged" wire:model="account_id" name="account_id" id="account_id" class="form-select" required>
                    @if(count($accountsPool) > 1 and $oldAccountId == null)
                    <option value="" selected disabled hidden>Selecione uma conta...</option>
                    @endif
                @foreach ($accountsPool as $account)
                    <option value="{{ $account["id"] }}"
                            @isset($oldAccountId)
                                @if($account["id"] == $oldAccountId)
                                    selected
                                @endif
                            @endisset
                    >
                        {{ $account["account_identifier"] . " - " . $account["nickname"] }}
                    </option>
                @endforeach
                </select>
                @else
                    <input type="text" id="account_id" class="form-control" value="{{ $accountsPool[array_key_first($accountsPool)]["nickname"] }}" disabled >
                    <input type="hidden" name="custody_account_id" value="{{ $accountsPool[array_key_first($accountsPool)]["id"] }}">
                @endif
            @endif
        </div>
        @if($account_id != "")
            <div class="pt-4 mt-2 col-1">
                <input wire:click="accountsReset" type="button" class="btn btn-close">
            </div>
        @endif
    </div>
</div>

