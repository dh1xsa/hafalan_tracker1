<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Group;
use Illuminate\Support\Facades\Hash;

class StudentSeeder extends Seeder
{
    public function run(): void
    {
        $names = ['Adit', 'Angga', 'Rina', 'Salsa', 'Budi'];

        // Ambil semua groups
        $groups = Group::all();

        foreach ($groups as $group) {
            foreach ($names as $name) {
                Student::create([
                    'group_id' => $group->id, // foreign key ke tabel groups
                    'name' => $name,
                    'password' => Hash::make('123456'),
                    'birth_date' => '2010-01-01',
                    'gender' => in_array($name, ['Rina', 'Salsa']) ? 'P' : 'L',
                ]);
            }
        }
    }
}
