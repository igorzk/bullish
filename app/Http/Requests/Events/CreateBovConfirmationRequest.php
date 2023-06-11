<?php

namespace App\Http\Requests\Events;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class CreateBovConfirmationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Gate::authorize('create-event')->allowed();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'transaction_date' => ['required', 'date'],
            'settlement_date' => ['required', 'date'],
            'custody_account_id' => ['required', 'numeric', 'min:1', 'exists:custody_accounts,id'],
            'net_value' => ['required', 'numeric', 'min:0'],
            'withholding_tax' => ['required', 'numeric', 'min:0'],
            'fees' => ['required', 'numeric'],
            'credit_debit' => ['required', Rule::in(['credit', 'debit'])],
            'transactions' => ['required'],
            'transactions.*.asset_id' => ['required', 'min:1'],
            'transactions.*.purchase_sale' => ['required', Rule::in(['purchase', 'sale'])],
            'transactions.*.type' => ['required', Rule::in(['normal', 'day-trade'])]
        ];
    }

    public function attributes(): array
    {
        return [
            'transaction_date' => '"data da operação"',
            'settlement_date' => '"data de liquidação"',
            'account_id' => 'conta',
            'net_value' => '"valor líquido"',
            'withholding_tax' => '"IR Retido"',
            'fees' => 'Corretagem',
            'credit_debit' => 'C/D',
            'transactions' => 'transações',
            'transactions.*.asset_id' => '"id do ativo"',
            'transactions.*.purchase_sale' => 'C/V',
            'transactions.*.type' => 'tipo',
        ];
    }
}
