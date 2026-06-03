<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class LoginController extends Controller
{
     public function login() {
        return view('admin.login');
    }

    public function authenticate(Request $request) {
        $credentials = [
            'u_email' => $request->u_email,   // đúng theo DB
            'password' => $request->u_password // ⚠️ phải là password
        ];
        if (Auth::guard('admin')->attempt($credentials)) { //['email' => $credentials['email'], 'password' => $credentials['password']]
            // Authentication passed...
            return redirect()->intended(route('admin.dashboard'));
        }

        return back()->withErrors([
            'u_email' => 'The provided credentials do not match our records.',
        ]);
    }

    public function logout() {
        Auth::guard('admin')->logout();
        return redirect()->route('login');
    }
}
