<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Group;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // 1. Buat admin
        User::create([
            'name' => 'Admin',
            'password' => Hash::make('123456'),
            'birth_date' => '1990-01-01',
            'gender' => 'L',
            'level' => 1,
        ]);

        // 2. Ambil semua group
        $groups = Group::all();

        // 3. Buat beberapa guru dan attach ke group secara acak
        foreach (range(1, 5) as $index) {
            $guru = User::create([
                'name' => 'Guru ' . $index,
                'password' => Hash::make('123456'),
                'birth_date' => '1985-0' . $index . '-15',
                'gender' => $index % 2 === 0 ? 'L' : 'P',
                'level' => 2,
            ]);
        }
    }
}
