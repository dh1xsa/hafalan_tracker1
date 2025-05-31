<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Adit', 'Angga', 'Rina', 'Salsa', 'Budi'];

        // Ambil semua groups
        $groups = Group::all();

        // Ambil semua guru
        $gurus = User::where('level', 2)->get();

        if ($gurus->isEmpty()) {
            $this->command->warn('Tidak ada guru (user dengan level 2) ditemukan.');
            return;
        }

        foreach ($groups as $group) {
            foreach ($names as $name) {
                // Pilih guru secara acak
                $guru = $gurus->random();

                Student::create([
                    'user_id' => $guru->id,           // foreign key ke users
                    'group_id' => $group->id,         // foreign key ke groups
                    'name' => $name,
                    'password' => Hash::make('123456'),
                    'birth_date' => '2010-01-01',
                    'gender' => in_array($name, ['Rina', 'Salsa']) ? 'P' : 'L',
                ]);
            }
        }
    }
}
