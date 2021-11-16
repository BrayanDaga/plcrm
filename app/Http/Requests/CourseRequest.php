<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CourseRequest extends FormRequest
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
            'id_categories' => ['required'],
            'title' => ['required'],
            // 'area' => ['required'],
            'description' => ['required'],
            'image' => [ $this->route('course') ? 'nullable' : 'required', 'image' ],
            // 'currency' => ['required'],
            'price' => ['required','numeric'],
            // 'ranking_by_user' => ['required'],
            'status' => ['nullable'],
            'level' => ['required'],
        ];

    
    }
}
