<?php

namespace App\Http\Requests\Auth;

use Illuminate\Foundation\Http\FormRequest;

class UserRegisterRequest extends FormRequest
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
            'reserved1' => 'required|max:255', //username
            'reserved2' => 'required|max:255', //password
            'shippingEmail' => 'required|max:255', //email
            'shippingFirstName' => 'required|max:255', //name
            'shippingLastName' => 'required|max:255', //last name
            'reserved5' => 'required', //Date Birth
            'reserved4' => 'required|max:255', //Phones
            'reserved8' => 'required', //Country
            'reserved6' => 'required', //Document Type
            'reserved7' => 'required', //nro_document
            'reserved10' => 'required', //Account Type
            'reserved9' => 'required' //id_referrer_sponsor
        ];
    }
}
