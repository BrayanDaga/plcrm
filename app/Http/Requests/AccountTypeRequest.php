<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AccountTypeRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'account' => 'required',
            'price' => ['required','numeric','min:0'],
            'iva' => ['nullable','numeric','min:0'],
            'comission' => ['nullable','numeric','min:0'],
            'disc_purchases' => ['nullable','numeric','min:0'],
            'pay_in_binary' => ['nullable','numeric','min:0'],
            'profit_on_purchases' => ['nullable','numeric','min:0'],
            'profit_on_purchases_2' => ['nullable','numeric','min:0'],
            'fast_cash_bonus' => ['nullable','numeric','min:0'],
        ];
    }
}
