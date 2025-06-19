<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function showLoginForm() {
        return view('user_auth.login');
    }

    // try it later with ajax query
    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            return to_route('homepage');
        }

        return back()
            ->withInput()
            ->withErrors(['login' => 'Incorrect email or password.']);
    }

    public function logout() {
        Auth::logout();

        return to_route('homepage');
    }

    public function showRegisterForm() {
        return view('user_auth.register'); 
    }

    // try it later with ajax query
    public function register(Request $request) {
        $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users|max:255',
            'password' => 'required|string|min:8|confirmed',
        ]);

        $new_user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if ($new_user != null) {
            Auth::login($new_user);
        }
    }
}
