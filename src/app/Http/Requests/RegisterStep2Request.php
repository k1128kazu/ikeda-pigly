<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStep2Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'height' => ['required', 'numeric', 'min:100', 'max:250'],
            'initial_weight' => ['required', 'numeric', 'min:20', 'max:300'],
        ];
    }

    public function messages()
    {
        return [
            'height.required' => '身長は必須です。',
            'height.numeric' => '身長は数値で入力してください。',
            'height.min' => '身長は100cm以上で入力してください。',
            'height.max' => '身長は250cm以下で入力してください。',

            'initial_weight.required' => '初期体重は必須です。',
            'initial_weight.numeric' => '初期体重は数値で入力してください。',
            'initial_weight.min' => '初期体重は20kg以上で入力してください。',
            'initial_weight.max' => '初期体重は300kg以下で入力してください。',
        ];
    }
}
