<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserSettingsRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'search_age_range' => ['required'],
            'search_male' => ['required_unless:search_female,1'],
            'search_female' => ['required_unless:search_male,1']
        ];
    }
}
