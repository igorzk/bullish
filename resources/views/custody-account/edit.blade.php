<x-custody-account.create-edit-form route="{{ route('custody.update', $account) }}" method="PATCH" button="Modificar"
    title="Conta de Custódia" header="Modificando Conta de Custódia:" :custodians="$custodians" :account="$account">
    <div class="py-2 col-sm-4">
        <p class="form-label text-muted">Investidor</p>
        <p class="form-control text-muted">{{ $account->investor->nickname }}</p>
    </div>
    <div class="py-2 col-sm-4">
        <p class="form-label text-muted">Portfolio</p>
        <p class="form-control text-muted">{{ $account->portfolio->nickname }}</p>
    </div>
</x-custody-account.create-edit-form>
