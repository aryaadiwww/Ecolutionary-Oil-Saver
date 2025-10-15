<?php

// app/Http/Controllers/ProfileController.php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;

class ProfileController extends Controller
{
    public function index()
    {
        $rewards = Reward::all();
        return view('profile', compact('rewards'));
    }
}