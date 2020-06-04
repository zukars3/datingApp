<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfileRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'min:3', 'max:255'],
            'surname' => ['required', 'string', 'min:3', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['required', 'string', 'min:8', 'max:8'],
            'age' => ['required', 'int', 'min:18', 'max:100'],
            'description' => ['required', 'min:10', 'max:500'],
            'relationship' => ['required'],
            'country' => ['required'],
            'languages' => ['required', 'min:2', 'max:255']
        ];
    }
}
