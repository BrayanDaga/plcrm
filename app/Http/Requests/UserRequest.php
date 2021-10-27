<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            'username' => ['required','unique:users'],
            'password' => ['required','min:5','confirmed'],
            'name' => ['required','min:2'],
            'last_name' => ['required','min:2'],
            'phone' => ['required'],
            'date_birth' => ['required','date '],
            'email' => ['required','email','unique:users'],
            'id_referrer_sponsor' => ['required','exists:account_type,id'],
            'id_country' => ['required','exists:country,id'],
            'id_document_type' => ['required','exists:document_type,id'],
            'id_account_type' => ['required','numeric','min:1','not_in:1','exists:account_type,id'],
            'nro_document' => ['required','integer'],
        ];
    }
}
