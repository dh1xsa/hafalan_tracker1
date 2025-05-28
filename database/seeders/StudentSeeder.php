<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
   public function run(): void
    {
        $names = ['Adit', 'Angga', 'Rina', 'Salsa', 'Budi'];

        $gurus = User::where('level', 2)->get(); // Ambil semua guru

        foreach ($gurus as $guru) {
            foreach ($names as $name) {
                Student::create([
                    'guru_id' => $guru->id,
                    'name' => $name,
                    'password' => Hash::make('123456'),
                    'tanggal_lahir' => '2010-01-01',
                    'jenis_kelamin' => in_array($name, ['Rina', 'Salsa']) ? 'P' : 'L',
                ]);
            }
        }
    }
}
