<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminAuthController extends Controller
{
    public function showLoginForm()
    {
        return view('admin.auth.admin_login', [
            'title' => 'Admin | Login',
        ]);
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication lolos...
            if (Auth::user()->is_admin == 1) {
                return redirect()->intended('/admin/dashboard')->with('success', 'Login Success');
            } else {
                Auth::logout();
                return redirect('/admin/login')->with('error', 'You do not have admin access');
            }
        }
        return redirect('/admin/login')->with('error', 'Invalid Email and Password');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/admin/login')->with('success', 'Logout Success');
    }
}