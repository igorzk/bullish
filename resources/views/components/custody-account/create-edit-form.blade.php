@props(['route', 'method', 'button',
        'header', 'account', 'investors', 'custodians', 'portfolios'])

<x-create-form route="{{ $route }}" method="{{ $method }}" create="{{ $button }}"
    title="Conta de Custódia" header="{{ $header }}">
    <div class="row w-100 pe-md-5">
        @isset($account)
            <input type="hidden" name="id" value="{{ $account->id }}">
        @endisset
        <div class="col-sm">
            <label class="form-label" for="nickname">Apelido para Conta</label>
            <input class="form-control" type="text" name="nickname" id="nickname"
                @isset($account) value="{{ $account->nickname }}" @endisset
                @empty($account) value="{{ old('nickname') }}" @endempty>
            <p class="form-text">deve ser um nome único</p>
        </div>
        <div class="col-sm">
            <label class="form-label" for="account_identifier">Identificador da Conta</label>
            <input class="form-control" type="text" name="account_identifier" id="account_identifier"
                @isset($account) value="{{ $account->account_identifier }}" @endisset
                @empty($account) value="{{ old('account_identifier') }}" @endempty>
            <p class="form-text">de acordo com nota de corretagem</p>
        </div>
    </div>
    <div class="w-75 row">
        <div class="py-2 col-sm-4">
            <label class="form-label" for="custodian_id">Custodiante</label>
            <select name="custodian_id" id="custodian_id" class="form-select">
                @foreach ($custodians as $custodian)
                    <option value="{{ $custodian->id }}"
                        @isset($account) {{ $account->custodian->id == $custodian->id ? 'selected' : '' }} @endisset
                        @empty($account) {{ old('custodian_id') == $custodian->id ? 'selected' : '' }} @endempty>
                        {{ $custodian->nickname }}
                    </option>
                @endforeach
            </select>
        </div>
        {{ $slot }}
    </div>
</x-create-form>
