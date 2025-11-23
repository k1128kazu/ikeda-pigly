<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class WeightLogStoreRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'date' => ['required', 'date'],
            'weight' => ['required', 'numeric', 'min:20', 'max:300'],
        ];
    }

    public function messages()
    {
        return [
            'date.required' => '日付を入力してください。',
            'date.date' => '日付の形式が正しくありません。',
            'weight.required' => '体重を入力してください。',
            'weight.numeric' => '体重は数値で入力してください。',
            'weight.min' => '体重は20kg以上で入力してください。',
            'weight.max' => '体重は300kg以下で入力してください。',
        ];
    }
}
