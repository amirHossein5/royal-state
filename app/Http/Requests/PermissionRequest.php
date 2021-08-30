<?php

namespace App\Http\Requests;

use App\Models\Permission;
use Illuminate\Foundation\Http\FormRequest;

class PermissionRequest extends FormRequest
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
            'permissions.*' => 'exists:permissions,name'
        ];
    }

    public function attributes()
    {
        $permissions = Permission::pluck('name');

        $attributes =[];

        foreach ($permissions as $permission) {
            $attributes["permissions.{$permission}"] = $permission;
        }

        return $attributes;
    }
}
