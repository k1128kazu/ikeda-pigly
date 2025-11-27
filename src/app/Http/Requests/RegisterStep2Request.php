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
            'initial_weight' => [
                'required',
                'regex:/^\d{1,4}(\.\d{1})?$/'
            ],
            'target_weight' => [
                'required',
                'regex:/^\d{1,4}(\.\d{1})?$/'
            ],
        ];
    }

    public function messages()
    {
        return [
            // ─── 現在の体重 ─────────────────────
            'initial_weight.required' => '現在の体重を入力してください',
            'initial_weight.regex' => '4桁までの数字で入力してください|小数点は1桁で入力してください',

            // ─── 目標の体重 ─────────────────────
            'target_weight.required' => '目標の体重を入力してください',
            'target_weight.regex'    => '4桁までの数字で入力してください|小数点は1桁で入力してください',
        ];
    }
}
