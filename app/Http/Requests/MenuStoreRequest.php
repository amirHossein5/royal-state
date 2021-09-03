<?php

namespace App\Http\Requests;

use App\Rules\Null_if;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class MenuStoreRequest extends FormRequest
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
            'name' => 'required|string|unique:menus,name',
            'url' => 'required|string',
            'parent_id' => [
                new Null_if(request()->type === 'header'),
                Rule::when(request()->type === 'footer', ['integer', 'exists:menus,id'])
            ],
            'type' => Rule::in(['footer', 'header'])
        ];
    }

    public function attributes()
    {
        return [
            'type' => 'نوع',
            'header' => __('header'),
            'footer' => __('footer'),
        ];
    }
}
