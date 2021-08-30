<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
        $isPutMethod = strtolower(request()->method()) === 'put';

        $name = ['required', 'string'];
        $isPutMethod ?: $name[] = 'unique:roles,name';

        return [
            'display_name' => 'required|string',
            'name' => $name,
        ];
    }

    public function attributes()
    {
        return [
            'display_name' => __('validation.attributes.persian_name')
        ];
    }
}
