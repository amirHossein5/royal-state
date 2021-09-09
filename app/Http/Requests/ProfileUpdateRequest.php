<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ProfileUpdateRequest extends FormRequest
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
    public function rules(Request $request)
    {
        return [
            'email' => "required|email|unique:users,email,{$request->id}",
            'first_name' => 'required|string',
            'last_name' => 'required|string',
            'phone' => 'nullable|digits_between:8,13',
            'show_email' => 'required|boolean',
            'show_phone_number' => 'required|boolean',
        ];
    }
}
