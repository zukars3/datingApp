<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
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
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'search_age_range' => 'required',
            'search_male' => 'required_unless:search_female,1',
            'search_female' => 'required_unless:search_male,1',
        ];
    }
}
