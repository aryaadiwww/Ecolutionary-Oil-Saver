<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Hash;

class SessionController extends Controller
{
    function index()
    {
        return view("sesi/index", [
            'title' => 'Login',
            'desc' => 'EOS (Ecolutionary Oil Saver) is created with the hope of making a real contribution to reducing
            environmental pollution by decreasing carbon footprint and household waste, and raising awareness among the
            public about environmental conservation efforts, particularly in the use of used cooking oil.'
        ]);
    }
    function login(Request $request)
    {
        Session::flash('email', $request->email);
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ], [
            'email.required' => 'Email is required',
            'password.required' => 'Password is required',
        ]);

        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if (Auth::attempt($infologin)) {
            return redirect('profile')->with('success','Login success!');
        } else {
            return redirect('login')->with('error', 'Email and password entered are incorrect');
        }
    }

    function logout(){
        Auth::logout();
        return redirect('/')->with('success', 'Log out success!');
    }

    function signup(){
        return view('sesi/signup', [
            'title'=> 'Sign Up',
            'desc'=> ' EOS (Ecolutionary Oil Saver) is created with the hope of making a real contribution to reducing
            environmental pollution by decreasing carbon footprint and household waste, and raising awareness among the
            public about environmental conservation efforts, particularly in the use of used cooking oil.'
        ]);
    }

    function create(Request $request) {
        Session::flash('name', $request->name);
        Session::flash('email', $request->email);
        
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'tlp' => 'required',
            'password' => 'required',
            'foto' => 'required|image'
        ], [
            'name.required' => 'Name is required',
            'email.required' => 'Email is required',
            'email.email' => 'Email is not valid',
            'email.unique' => 'Email has already been used',
            'tlp.required' => 'Phone number is required',
            'password.required' => 'Password is required',
            'foto.required' => 'Profile photo is required',
            'foto.image' => 'Profile photo must be an image'
        ]);
    
        // Ambil daftar ID yang sudah digunakan
        $existing_ids = User::pluck('id')->toArray();
        // Ambil ID yang belum digunakan dalam rentang Range
        $available_ids = array_diff(range(1001, 1250), $existing_ids);
        
        if (empty($available_ids)) {
            // Tangani jika tidak ada ID yang tersedia
            return redirect('register')->with('error', 'Tidak ada ID yang tersedia untuk pendaftaran');
        }
    
        // Pilih ID acak dari ID yang tersedia
        $id = array_rand(array_flip($available_ids));
    
        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'tlp' => $request->tlp,
            'password' => Hash::make($request->password),
            'id' => $id,
        ];
    
        if ($request->hasFile('foto')) {
            $photo = $request->file('foto');
            $filename = date('Ymd') . '_' . $photo->getClientOriginalName();
            $photo->move(public_path('storage/user'), $filename);
            $data['foto'] = $filename;
        } else {
            $data['foto'] = 'default.png';
        }
    
        $user = User::create($data);
    
        $infologin = [
            'email' => $request->email,
            'password' => $request->password
        ];
    
        if (Auth::attempt($infologin)) {
            return redirect('profile')->with('success', Auth::user()->name .' Hello !');
        } else {
            return redirect('register')->with('error', 'There was an issue with your registration.');
        }
    }
}