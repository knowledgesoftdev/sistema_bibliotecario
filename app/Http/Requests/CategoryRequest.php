<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CategoryRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'category_name'=>['required','string','max:100',Rule::unique(table:'categories',column:'category_name')->ignore(id:request('category'),idColumn:'id')],
            'slug'=>['required','string','max:100',Rule::unique(table:'categories',column:'slug')->ignore(id:request('category'),idColumn:'id')]
        ];
    }

    public function messages():array
    {
        return [
            'category_name.unique'   => __('The category already exists.'),
            'slug.unique'   => __('The slug already exists.')
        ];
    }
}
