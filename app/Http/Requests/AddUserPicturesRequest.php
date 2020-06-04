<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddUserPicturesRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "picture" => "required|array|min:1",
            "picture.*" => "image|mimes:jpeg,png,jpg,gif,svg|max:2048"
        ];
    }
}
