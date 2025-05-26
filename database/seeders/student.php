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
            ['user_id' => '2', 'name' => 'Adit', 'password' => Hash::make('123456')],
            ['user_id' => '2', 'name' => 'Budi', 'password' => Hash::make('123456')],
            ['user_id' => '2', 'name' => 'Citra', 'password' => Hash::make('123456')],
            ['user_id' => '2', 'name' => 'Dewi', 'password' => Hash::make('123456')],
            ['user_id' => '2', 'name' => 'Eko', 'password' => Hash::make('123456')],
            ['user_id' => '2', 'name' => 'Fani', 'password' => Hash::make('123456')],
            ['user_id' => '2', 'name' => 'Gilang', 'password' => Hash::make('123456')],
            ['user_id' => '2', 'name' => 'Hana', 'password' => Hash::make('123456')],
            ['user_id' => '2', 'name' => 'Irfan', 'password' => Hash::make('123456')],
            ['user_id' => '2', 'name' => 'Joko', 'password' => Hash::make('123456')],
            ['user_id' => '3', 'name' => 'Kiki', 'password' => Hash::make('123456')],
            ['user_id' => '3', 'name' => 'Lia', 'password' => Hash::make('123456')],
            ['user_id' => '3', 'name' => 'Maya', 'password' => Hash::make('123456')],
            ['user_id' => '3', 'name' => 'Niko', 'password' => Hash::make('123456')],
            ['user_id' => '3', 'name' => 'Oki', 'password' => Hash::make('123456')],
            ['user_id' => '3', 'name' => 'Putri', 'password' => Hash::make('123456')],
            ['user_id' => '3', 'name' => 'Qori', 'password' => Hash::make('123456')],
            ['user_id' => '3', 'name' => 'Rina', 'password' => Hash::make('123456')],
            ['user_id' => '3', 'name' => 'Sigit', 'password' => Hash::make('123456')],
            ['user_id' => '3', 'name' => 'Tari', 'password' => Hash::make('123456')],
            ['user_id' => '3', 'name' => 'Ujang', 'password' => Hash::make('123456')],
            ['user_id' => '3', 'name' => 'Vina', 'password' => Hash::make('123456')],
            ['user_id' => '3', 'name' => 'Wawan', 'password' => Hash::make('123456')],
            ['user_id' => '3', 'name' => 'Xena', 'password' => Hash::make('123456')],
            ['user_id' => '3', 'name' => 'Yuni', 'password' => Hash::make('123456')],
            ['user_id' => '3', 'name' => 'Zaki', 'password' => Hash::make('123456')],
        ]);
    }
}
