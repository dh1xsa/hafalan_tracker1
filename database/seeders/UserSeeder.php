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

        // Guru + buat grup untuk setiap guru
        $groupNames = ['A', 'B', 'C'];

        foreach ($groupNames as $index => $groupName) {
            $guru = User::create([
                'name' => 'Guru ' . ($index + 1),
                'password' => Hash::make('123456'),
                'birth_date' => '1985-0' . ($index + 1) . '-15',
                'gender' => $index % 2 === 0 ? 'L' : 'P',
                'level' => 2,
            ]);

            // Buat grup untuk guru ini
            $group = Group::create([
                'groups_name' => $groupName,
                'user_id' => $guru->id,
            ]);

            // Update user dengan group_id
            $guru->update([
                'group_id' => $group->id,
            ]);
        }
    }
}
