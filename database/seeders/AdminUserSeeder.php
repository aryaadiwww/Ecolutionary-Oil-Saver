<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'id' => 1,
            'name' => 'Admin',
            'email' => 'admineos123@gmail.com',
            'email_verified_at' => now(),
            'tlp' => '1234567890',
            'password' => Hash::make('AdminEOS24'), // Ganti dengan password yang aman
            'foto' => 'default.png',
            'is_admin' => 1,
            'points' => 0,
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}