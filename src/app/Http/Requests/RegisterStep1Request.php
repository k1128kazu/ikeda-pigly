<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterStep1Request extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'email.required' => 'メールアドレスを入力してください',
            'email.email'    => '正しいメールアドレス形式で入力してください',
            'email.unique'   => 'このメールアドレスは既に登録されています',

            'password.required' => 'パスワードを入力してください',
            'password.min'      => 'パスワードは8文字以上で入力してください',
        ];
    }
}
