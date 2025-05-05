<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class user extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            [
                'name' => 'admin',
                'password' => Hash::make('123456'),
                'level' => '1'
            ],
            [
                'name' => 'Guru1',
                'password' => Hash::make('123456'),
                'level' => '2'
            ],
            [
                'name' => 'Guru2',
                'password' => Hash::make('123456'),
                'level' => '2'
            ],

        ]);
    }
}
