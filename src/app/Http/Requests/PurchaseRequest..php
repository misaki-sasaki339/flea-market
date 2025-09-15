<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PurchaseRequest extends FormRequest
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
            'payment'=>'required',
            'address'=>'required'|'exists:profiles,id',
        ];
    }

    public function messages()
    {
        return [
            'payment.required'=>'支払い方法を選択してください',
            'address.required'=>'配送先が登録されていません',
            'address.exists'=>'住所が登録されていません マイページの『プロフィールを編集』をご確認ください'
        ];
    }
}
