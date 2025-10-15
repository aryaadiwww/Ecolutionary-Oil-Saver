<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserRandomIdSeeder extends Seeder
{
    public function run()
    {
        // Buat daftar ID yang unik
        $ids = range(1001, 1250);
        shuffle($ids);

        // Ambil semua pengguna dan update `random_id` secara acak
        $users = User::all();
        foreach ($users as $key => $user) {
            if (isset($ids[$key])) {
                $user->random_id = $ids[$key];
                $user->save();
            }
        }
    }
}