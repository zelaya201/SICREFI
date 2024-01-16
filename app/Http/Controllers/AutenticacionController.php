<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AutenticacionController extends Controller
{
    public function login()
    {
        return view('content.authentications.login');
    }

    public function postLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (auth()->attempt($credentials)) {
            return redirect()->route('inicio');
        }

        return back()->withErrors([
            'email' => 'Las credenciales no coinciden con nuestros registros.',
        ]);
    }

    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }

    public function resetPassword()
    {
        return view('content.authentications.reset-password');
    }

    public function changePassword()
    {
        return view('content.authentications.change-password');
    }
}
