<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

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
            // $role = (Auth::user()->role);
            $request->session()->regenerate();

            // if (strtolower($role) == "admin") {
                return redirect()->intended('/dashboard/transaction');
            // }
        }

        return back()->with('error', 'Please login again!');
    }

    public function loginAs(Request $request)
    {
        $user = User::firstWhere('role', $request->role);
        $email = $user->email;
        return response()->json([
            'email' => $email
        ]);
    }

    public function registerIndex()
    {
        return view('users.register', [
            'title' => 'Register'
        ]);
    }

    public function registerStore(Request $request)
    {

        $rule = [
            'name' => 'required',
            'email' => 'required|email:dns',
            'password' => 'required|min:4',
            'repassword' => 'required'
        ];

        if ($request->password != $request->repassword) {
            $request['repassword'] = null;
        }

        $validated = $request->validate($rule);

        $validated['password'] = Hash::make($validated['password']);

        User::create($validated);
        return redirect('/login')->with('success', 'Register have been completed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/login');
    }
}
