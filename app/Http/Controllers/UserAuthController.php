<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserAuthController extends Controller
{
    public function showLoginForm() {
        if (Auth::check()) {
            return to_route('homepage');
        }

        return view('user_auth.login');
    }

    public function login(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        $credentials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credentials, $request->filled('remember'))) {
            return to_route('hotels/index');
        }

        return back()
            ->withInput()
            ->withErrors(['login' => 'Incorrect email or password.']);
    }

    public function logout() {
        if (Auth::check()) {
            Auth::logout();
        }
        
        return to_route('homepage');
    }
}
