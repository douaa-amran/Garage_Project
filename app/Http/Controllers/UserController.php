<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{

    // Show Login Form
    public function login()
    {
        return view('auth.login');
    }

    // Authenticate Login Form
    public function authenticate(Request $request)
    {
        $data = $request->validate([
            'email' => ['required', 'email:rfc,dns'],
            'password' => 'required'
        ]);

        if (auth()->attempt($data, $request->remember)) {
            $request->session()->regenerate();

            return redirect('/')->with('success', 'Welcome ' . auth()->user()->username . '!');
        }

        return back()->withErrors(['email' => 'Invalid Credentials'])->onlyInput('email');
    }

    // Logout User
    public function logout(Request $request)
    {
        auth()->logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}