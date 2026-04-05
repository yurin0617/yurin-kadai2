<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
    public function rules(): array
    {
        return [
            // 商品名：必須
            'name' => 'required',

            // 値段：必須、数値型、0〜10000の範囲
            'price' => 'required|integer|between:0,10000',

            // 商品画像：更新時は「任意(nullable)」にしつつ、
            // アップロードされた場合は「画像であること」「拡張子がpngまたはjpeg」をチェック
            'image' => 'nullable|image|mimes:png,jpeg',

            // 季節：必須、配列形式
            'seasons' => 'required|array',

            // 商品説明：必須、最大120文字
            'description' => 'required|max:120',
        ];
    }
    public function messages(): array
    {
        return [
            // 商品名
            'name.required' => '商品名を入力してください',

            // 値段
            'price.required' => '値段を入力してください',
            'price.integer' => '数値で入力してください',
            'price.between' => '0～10000円以内で入力してください',

            // 画像
            'image.required' => '画像を登録してください',
            'image.mimes' => '「.png」または「.jpeg」形式でアップロードしてください',

            // 季節
            'seasons.required' => '季節を選択してください',

            // 商品説明
            'description.required' => '商品説明を入力してください',
            'description.max' => '120文字以内で入力してください',
        ];
    }
}
