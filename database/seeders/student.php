<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class student extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('students')->insert([
            [
                'user_id' => '2',
                'name' => 'Murid1',
                'password' => Hash::make('123456'),
            ],
            [
                'user_id' => '2',
                'name' => 'Murid2',
                'password' => Hash::make('123456'),
            ],
            [
                'user_id' => '3',
                'name' => 'Murid3',
                'password' => Hash::make('123456'),
            ],
            [
                'user_id' => '3',
                'name' => 'Murid4',
                'password' => Hash::make('123456'),
            ],

        ]);
    }
}