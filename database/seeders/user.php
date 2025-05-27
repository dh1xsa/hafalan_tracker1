<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        User::create([
            'name' => 'Admin 1',
            'password' => Hash::make('123456'),
            'tanggal_lahir' => '1990-01-01',
            'jenis_kelamin' => 'L',
            'kelas' => 'A', // Boleh diisi atau dikosongkan
            'level' => 1,
        ]);

        User::create([
            'name' => 'Admin 2',
            'password' => Hash::make('123456'),
            'tanggal_lahir' => '1992-01-01',
            'jenis_kelamin' => 'P',
            'kelas' => 'B',
            'level' => 1,
        ]);

        // Guru
        $kelasList = ['A', 'B', 'C'];

        foreach ($kelasList as $index => $kelas) {
            User::create([
                'name' => 'Guru ' . ($index + 1),
                'password' => Hash::make('password'),
                'tanggal_lahir' => '1985-0' . ($index + 1) . '-15',
                'jenis_kelamin' => $index % 2 == 0 ? 'L' : 'P',
                'kelas' => $kelas,
                'level' => 2,
            ]);
        }
    }
}
