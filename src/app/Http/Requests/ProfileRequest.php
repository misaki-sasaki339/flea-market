<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProfileRequest extends FormRequest
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
            'avator'=>'required|image|mimes:jpeg,png',
            'name'=>'required',
            'postcode'=>'required|regex:/^\d{3}-\d{4}$/',
            'address'=>'required',
        ];
    }

    public function messages()
    {
        return [
            'avator_img.required'=>'プロフィール画像をアップロードしてください',
            'avator_img.mimes'=>'画像はJPEGまたはPNG形式のみアップロード可能です',
            'name.required'=>'お名前を入力してください',
            'postcode.required'=>'郵便番号を入力してください',
            'postcode.regex'=>'郵便番号はXXX-XXXXの形式で入力してください',
            'address'=>'住所を入力してください'
        ];
    }
}
