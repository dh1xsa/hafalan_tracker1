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
        // Admin
        User::create([
            'name' => 'Admin',
            'password' => Hash::make('123456'),
            'birth_date' => '1990-01-01',
            'gender' => 'L',
            'group_id' => null, // Admin tidak memiliki group
            'level' => 1,
        ]);

        // Buat grup terlebih dahulu
        $groupNames = ['A', 'B', 'C'];
        $groups = [];

        foreach ($groupNames as $groupName) {
            $group = Group::create([
                'groups_name' => $groupName,
            ]);

            $groups[] = $group;
        }

        // Buat guru dan masukkan ke grup yang sudah dibuat
        foreach ($groups as $index => $group) {
            User::create([
                'name' => 'Guru ' . ($index + 1),
                'password' => Hash::make('123456'),
                'birth_date' => '1985-0' . ($index + 1) . '-15',
                'gender' => $index % 2 === 0 ? 'L' : 'P',
                'group_id' => $group->id,
                'level' => 2,
            ]);
        }
    }
}
