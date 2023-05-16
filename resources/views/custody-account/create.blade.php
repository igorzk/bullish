<x-custody-account.create-edit-form route="{{ route('custody.store') }}" method="POST" button="Criar"
    title="Conta de Custódia" header="Criando Conta de Custódia:" :investors="$investors" :custodians="$custodians" :portfolios="$portfolios">
    <div class="py-2 col-sm-4">
        <label class="form-label" for="investor_id">Investidor</label>
        <select name="investor_id" id="InvestorId" class="form-select">
            @foreach ($investors as $investor)
                <option value="{{ $investor->id }}" {{ old('investor_id') == $investor->id ? 'selected' : '' }}>
                    {{ $investor->nickname }}
                </option>
            @endforeach
        </select>
    </div>
    <div class="py-2 col-sm-4">
        <label class="form-label" for="portfolio_id">Portfolio</label>
        <select name="portfolio_id" id="portfolio_id" class="form-select">
            @foreach ($portfolios as $portfolio)
                <option value="{{ $portfolio->id }}" {{ old('investor_id') == $investor->id ? 'selected' : '' }}>
                    {{ $portfolio->nickname }}
                </option>
            @endforeach
        </select>
    </div>
</x-custody-account.create-edit-form>
