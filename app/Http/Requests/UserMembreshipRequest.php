<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserMembreshipRequest extends FormRequest
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
            'user' => ['required','unique:userMembreships'],
            'password' => ['required','min:5','confirmed'],
            'name' => ['required'],
            'last_name' => ['required'],
            'phone' => ['required'],
            'date_birth' => ['required'],
            'email' => ['required','email','unique:userMembreships'],
            'id_referrer_sponsor' => ['required'],
            'id_country' => ['required','exists:country,id'],
            'id_document_type' => ['required'],
            'id_account_type' => ['required','exists:account_type,id'],
            'nro_document' => ['required','integer'],
            'request' => ['required'],
            'expiration_date' =>  ['required'],
        ];
    }
}
