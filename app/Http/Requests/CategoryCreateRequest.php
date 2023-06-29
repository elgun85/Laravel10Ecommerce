<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryCreateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'=>'required|string|min:3|max:250',
            //'slug'=>'required|nullable|string|min:3|max:250',
            'description'=>'required|string|max:250',
            'meta_title'=>'required|string|max:250',
            'meta_keyword'=>'required|string|max:250',
            'meta_description'=>'required|string|max:250',
            'image'=>'image|max:3072|mimes:jpg,jpeg,png',

        ];
    }
}
