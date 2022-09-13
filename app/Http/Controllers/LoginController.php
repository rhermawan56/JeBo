<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function loginIndex()
    {
        return view('users.login', [
            'title' => "Login"
        ]);
    }

    public function loginStore(Request $request)
    {
        $request->old('email');

        $credentials = $request->validate([
            'email' => 'required|email:dns',
            'password' => 'required|min:4'
        ]);

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/');
        }

        return back()->with('error', 'Please login again!');
    }

    public function registerIndex()
    {
        return view('users.register', [
            'title' => 'Register'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
