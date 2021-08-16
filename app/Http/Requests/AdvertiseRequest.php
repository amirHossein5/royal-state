<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class AdvertiseRequest extends FormRequest
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
        $image = strtolower(request()->method()) === "put" ? '' : 'required|' ;

        return [
            'title' => 'required|max:200',
            'image' => "{$image}image|file|max:1024",
            'address' => 'required',
            'floor' => 'required|string',
            'year' => 'required|numeric',
            'amount' => 'required',
            'area' => 'required',
            'room' => 'required|numeric',
            'tag' => 'nullable|string',
            'description' => 'required|string',
            'storeroom' => 'required|numeric|in:0,1',
            'balcony' => 'required|numeric|in:0,1',
            'toilet' => ["required", 'string', Rule::in(['فرنگی', 'ایرانی و فرنگی', 'ایرانی'])],
            'sell_status' => 'required|numeric|in:0,1',
            'type' => 'required|numeric|in:0,1,2,3',
            'parking' => 'required|numeric|in:0,1',
            'cat_id' => 'required|numeric|exists:categories,id'
        ];
    }
}
