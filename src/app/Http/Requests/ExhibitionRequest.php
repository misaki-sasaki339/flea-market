<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ExhibitionRequest extends FormRequest
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
            'item_name'=>'required',
            'description'=>'required'|'max:255',
            'item_img'=>'required'|'image'|'mimes:jpeg,png',
            'category_ids'=>'required',
            'condition'=>'required',
            'price'=>'required'|'integer'|'min:0',
        ];
    }

    public function messages()
    {
        return [
            'item_name.required'=>'商品名を入力してください',
            'description.required'=>'商品説明を入力してください',
            'description.max'=>'商品説明は255文字以内で入力してください',
            'item_img.required'=>'商品画像をアップロードしてください',
            'item_img.mimes'=>'画像はJPEGまたはPNG形式のみアップロード可能です',
            'category_ids'=>'商品カテゴリを1つ以上選択してください',
            'condition.required'=>'商品の状態を選択してください',
            'price.required'=>'販売価格を入力してください',   
            'price.integer'=>'販売価格は数値で入力してください',
            'price.min'=>'販売価格は0以上の数値を入力してください', 
        ];
    }
}