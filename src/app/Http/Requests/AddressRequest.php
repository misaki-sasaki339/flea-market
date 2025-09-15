<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddressRequest extends FormRequest
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
            'shipment_postcode.required'=>'郵便番号を入力してください',
            'shipment_postcode.regex'=>'郵便番号はXXX-XXXXの形式で入力してください',
            'shipment_address'=>'住所を入力してください'
        ];
    }
    
    public function messages()
    {
        return [
            'shipment_postcode'=>'required'|'regex:/^\d{3}-\d{4}$/',
            'shipment_address'=>'required',
        ];
    }

}
