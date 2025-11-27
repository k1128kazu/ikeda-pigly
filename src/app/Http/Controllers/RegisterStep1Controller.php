<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterStep1Request;

class RegisterStep1Controller extends Controller
{
    public function show()
    {
        return view('auth.register_step1');
    }

    public function store(RegisterStep1Request $request)
    {
        session([
            'register.name'     => $request->name,
            'register.email'    => $request->email,
            'register.password' => $request->password,
        ]);

        return redirect()->route('register.step2');
    }
}
