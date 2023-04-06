<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NgoRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            "name" => "required",
            'email' => 'required|email|unique:users',
            "password" => "required|min:6|confirmed",
            "mobile_number" =>['required', 'regex:/^(?:(?:\+|0{0,2})91(\s*[\-]\s*)?|[0]?)?[789]\d{9}$/'],
            "address" => "required|min:3|string",
            "certificate_id" => "required|string"
        ];
    }
}
