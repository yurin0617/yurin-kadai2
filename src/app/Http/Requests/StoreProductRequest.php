<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => 'required|max:100',
            'price' => 'required|integer|between:0,10000',
            'image' => 'required|image|mimes:jpeg,png',
            'seasons' => 'required|array',
            'description' => 'required|max:120',
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '商品名を入力してください',
            'name.max' => '100文字以内で入力してください', // 追加
            'price.required' => '値段を入力してください',
            'price.integer' => '数値で入力してください',
            'price.between' => '0～10000円以内で入力してください',
            'image.required' => '画像を登録してください',
            'image.image' => '画像ファイルを選択してください', // 追加
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',
            'seasons.required' => '季節を選択してください',
            'seasons.array' => '不正な入力です', // 追加
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',
        ];
    }
}
