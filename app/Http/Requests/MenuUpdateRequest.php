<?php

namespace App\Http\Requests;

use App\Models\Menu;
use App\Rules\Null_if;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class MenuUpdateRequest extends FormRequest
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
            'name' => "required|string|unique:menus,name,{$request->id}",
            'url' => 'required|string',
            'parent_id' => [
                new Null_if(request()->type === 'header'),
                Rule::when(request()->type === 'footer', ['nullable', 'integer', 'exists:menus,id'])
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
