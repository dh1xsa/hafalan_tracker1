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
        $gurus = User::where('level', 2)->get(); // Ambil semua guru

        foreach ($gurus as $guru) {
            for ($i = 1; $i <= 5; $i++) {
                Student::create([
                    'guru_id' => $guru->id,
                    'name' => "Murid {$guru->kelas}-$i",
                    'password' => Hash::make('password'),
                    'tanggal_lahir' => '2010-01-0' . $i,
                    'jenis_kelamin' => $i % 2 == 0 ? 'L' : 'P',
                ]);
            }
        }
    }
}
