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
            'price' => 'required',
            'iva' => 'nullable',
            'disc_purchases' => 'nullable',
            'pay_in_binary' => 'nullable',
            'profit_on_purchases' => 'nullable',
            'profit_on_purchases_2' => 'nullable',
        ];
    }
}
