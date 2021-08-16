<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
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
        $image = strtolower(request()->method()) === "put" ? '' : 'required|';
        return [
            'title' => 'required|string|max:200',
            'published_at' => 'nullable|date|date_format:Y-m-d',
            'cat_id' => 'required|exists:categories,id|numeric',
            'body' => 'required',
            'image' => "{$image}image|file"
        ];
    }
}
