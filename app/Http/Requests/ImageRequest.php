<?php
namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;
class ImageRequest extends FormRequest
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
            'image.*' => 'required|max:2048|mimes:jpeg,png,jpg,bmp'
        ];
    }
    public function messages()
    {
        return [
            'image.*.required' => 'You haven\'t choose a photo.',
            'image.*.max' => 'Your photo is too large, must be less than :max kb.',
            'image.*.mimes' => 'We only accept :values.',
        ];
    }
}