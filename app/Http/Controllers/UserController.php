<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function edit()
    {
        return view('edit');
    }

    public function update(Request $request)
    {
        // Define validation rules
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'tlp' => 'required|string|max:20',
            'email' => 'required|string|email|max:255',
            'password' => ['nullable', 'string', 'min:6', 'regex:/^(?=.*[A-Za-z])(?=.*\d)[A-Za-z\d]+$/'],
        ]);

        // Check if validation fails
        if ($validator->fails()) {
            // Flash error message
            Session::flash('error', 'Password yang dimasukkan tidak sesuai!');
            return redirect('/settings')
                        ->withErrors($validator)
                        ->withInput();
        }

        // Update user profile
        $user = auth()->user();
        if ($user) {
            $user->name = $request->input('name');
            $user->tlp = $request->input('tlp');
            $user->email = $request->input('email');
            
            if ($request->filled('password')) {
                $user->password = bcrypt($request->input('password'));
            }

            $user->save();

            // Flash success message
            return redirect('profile')->with('success', 'Profil berhasil diperbarui!');
        } else {
            // Flash error message if user is not authenticated
            return redirect('/settings')->with('error', 'User not authenticated.');
        }
    }
}