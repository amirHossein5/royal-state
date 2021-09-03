<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class SettingUpdateRequest extends FormRequest
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
            'logo' => 'nullable|image|file',
            'site_name' => 'nullable|string',
            'long_description' => 'nullable|string',
            'short_description' => 'nullable|string',
            'email' => 'nullable|email',
            'phone' => 'nullable|digits_between:8,13',
            'address' => 'nullable|string',
            'social_medias.*.url' => 'sometimes|url',
            'social_medias.*.logo' => 'sometimes|string'
        ];
    }

    public function attributes()
    {
        return [
            'social_medias.*.url' => __('url'),
            'social_medias.*.logo' => __('logo')
        ];
    }
}
