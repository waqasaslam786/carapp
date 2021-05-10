<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CarRequest extends FormRequest
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
        $method=request()->method();

        switch($method):

            case 'POST':
                $rules = [
                    'name'=>'required|string|max:100',
                    'car_modal_id'=>'required|numeric',
                    'brand_id'=>'required|numeric',
                    'color'=>'required|string',
                    'year'=>'required|string',
                    'images' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', 
                ];
                break;

            case 'PUT':
            case 'PATCH':
                $rules = [
                    'name'=>'required|string|max:100',
                    'car_modal_id'=>'required|numeric',
                    'brand_id'=>'required|numeric',
                    'color'=>'required|string',
                    'year'=>'required|string',
                ];
                break;

            default: break;
        endswitch;

        return $rules;

    }

    public function messages()
    {
        return [
            'name.required' => ' Brand Name is required!',
            'car_modal_id.required' => ' Kindly Select Car Model!',
            'brand_id.required' => ' Kindly Select Brand!',
            'color.required' => ' Car Color is required!',
            'year.required' => ' Year is required!',
            'images.required' => ' Car Image is required!',
        ];
    }
}
