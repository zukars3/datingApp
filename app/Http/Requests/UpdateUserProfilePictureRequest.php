<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserProfilePictureRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'picture' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }
}
