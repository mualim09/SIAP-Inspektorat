<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'address'=>'nullable|string|max:255',
            'country'=>'nullable|string|max:50',
            'city' =>'nullable|string|max:50',
            'zipcode' =>'nullable|string|min:5',
            'about' => 'nullable|string|max:255',
            'pic' => 'nullable|mimes:jpeg,png,jpg',
        ];
    }
}
