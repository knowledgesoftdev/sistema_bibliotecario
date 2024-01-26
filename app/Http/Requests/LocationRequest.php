<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class LocationRequest extends FormRequest
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
            'location_name'=>['required','string','max:100',Rule::unique(table:'locations',column:'location_name')->ignore(id:request('location'),idColumn:'id')],
            'slug'=>['required','string','max:100',Rule::unique(table:'locations',column:'slug')->ignore(id:request('location'),idColumn:'id')]
        ];
    }

    public function messages():array
    {
        return [
            'location_name.unique'   => __('The location already exists.'),
            'slug.unique'   => __('The slug already exists.')
        ];
    }
}
