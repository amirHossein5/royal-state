<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentStoreRequest extends FormRequest
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
        $rules = [];

        if (!auth()->user()) {
            $rules['first_name'] = 'required|string';
            $rules['last_name'] = 'required|string';
            $rules['email'] = 'required|email';
            $rules['password'] = 'required|confirmed';
        }

        $rules ['comment'] = 'required|string';

        return $rules;
    }
}
