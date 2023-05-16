<?php

namespace App\Http\Requests\CustodyAccount;

use Illuminate\Foundation\Http\FormRequest;

class CustodyAccountUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nickname' => ['required', 'string'],
            'account_identifier' => ['required', 'string'],
            'custodian_id' => ['required', 'numeric', 'min:1'],
        ];
    }
}
