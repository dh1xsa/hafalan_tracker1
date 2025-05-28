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

        // Ambil semua guru (level 2) yang punya group_id
        $gurus = User::where('level', 2)->whereNotNull('group_id')->get();

        foreach ($gurus as $guru) {
            foreach ($names as $name) {
                Student::create([
                    'group_id' => $guru->group_id, // foreign key ke tabel groups
                    'name' => $name,
                    'password' => Hash::make('123456'),
                    'birth_date' => '2010-01-01',
                    'gender' => in_array($name, ['Rina', 'Salsa']) ? 'P' : 'L',
                ]);
            }
        }
    }
}
