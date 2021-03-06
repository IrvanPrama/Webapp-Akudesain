<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login()
    {
        return view('auths.login');
    }

    public function postlogin(Request $request)
    {
        if (Auth::attempt($request->only('email', 'password'))) {
            if (auth()->user()->role == 'user') {
                return redirect('/dashboard');
            } elseif (auth()->user()->role == 'designer') {
                return redirect('/dashboard/designer');
            }
            return redirect('/dashboard/admin');
        }
        return redirect('/login');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/');
    }
}
