<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'name'     => ['required', 'max:255'],
            'email'    => ['required', 'email', 'max:255'],
            'password' => ['required', 'min:8'],
        ];
    }

    public function messages()
    {
        return [
            'name.required'     => '名前を入力してください',
            'name.max'          => '名前は255文字以内で入力してください',

            'email.required'    => 'メールアドレスを入力してください',
            'email.email'       => 'メールアドレスは「ユーザー名@ドメイン」形式で入力してください',
            'email.max'         => 'メールアドレスは255文字以内で入力してください',

            'password.required' => 'パスワードを入力してください',
            'password.min'      => 'パスワードは8文字以上で入力してください',
        ];
    }
}
