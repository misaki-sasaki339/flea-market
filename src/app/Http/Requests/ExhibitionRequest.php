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
            'name'=>'required',
            'description'=>'required|max:255',
            'temp_img'=>'required|string',
            'img'=>'image|mimes:jpeg,png',
            'category_ids'=>'required|array|min:1',
            'condition_id'=>'required',
            'price'=>'required|integer|min:0',
        ];
    }

    public function messages()
    {
        return [
            'name.required'=>'商品名を入力してください',
            'description.required'=>'商品説明を入力してください',
            'description.max'=>'商品説明は255文字以内で入力してください',
            'temp_img.required'=>'商品画像をアップロードしてください',
            'img.mimes'=>'画像はJPEGまたはPNG形式のみアップロード可能です',
            'category_ids.required'=>'商品カテゴリを1つ以上選択してください',
            'category_ids.min'=>'商品カテゴリを1つ以上選択してください',
            'condition_id.required'=>'商品の状態を選択してください',
            'price.required'=>'販売価格を入力してください',
            'price.integer'=>'販売価格は数値で入力してください',
            'price.min'=>'販売価格は0以上の数値を入力してください',
        ];
    }
}
