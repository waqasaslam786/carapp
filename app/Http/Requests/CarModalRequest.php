<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarModalRequest extends FormRequest
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
            'name' => 'required|string|max:100',
            'brand_id' => 'required|numeric',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => ' Modal Name is required!',
            'brand_id.required' => 'Kindly Select Brand',

        ];
    }
}
