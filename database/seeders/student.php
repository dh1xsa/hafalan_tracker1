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
        $students = [
            ['guru_id' => 2, 'name' => 'Adit', 'jenis_kelamin' => 'L'],
            ['guru_id' => 2, 'name' => 'Budi', 'jenis_kelamin' => 'L'],
            ['guru_id' => 2, 'name' => 'Citra', 'jenis_kelamin' => 'P'],
            ['guru_id' => 2, 'name' => 'Dewi', 'jenis_kelamin' => 'P'],
            ['guru_id' => 2, 'name' => 'Eko', 'jenis_kelamin' => 'L'],
            ['guru_id' => 2, 'name' => 'Fani', 'jenis_kelamin' => 'P'],
            ['guru_id' => 2, 'name' => 'Gilang', 'jenis_kelamin' => 'L'],
            ['guru_id' => 2, 'name' => 'Hana', 'jenis_kelamin' => 'P'],
            ['guru_id' => 2, 'name' => 'Irfan', 'jenis_kelamin' => 'L'],
            ['guru_id' => 2, 'name' => 'Joko', 'jenis_kelamin' => 'L'],

            ['guru_id' => 3, 'name' => 'Kiki', 'jenis_kelamin' => 'P'],
            ['guru_id' => 3, 'name' => 'Lia', 'jenis_kelamin' => 'P'],
            ['guru_id' => 3, 'name' => 'Maya', 'jenis_kelamin' => 'P'],
            ['guru_id' => 3, 'name' => 'Niko', 'jenis_kelamin' => 'L'],
            ['guru_id' => 3, 'name' => 'Oki', 'jenis_kelamin' => 'L'],
            ['guru_id' => 3, 'name' => 'Putri', 'jenis_kelamin' => 'P'],
            ['guru_id' => 3, 'name' => 'Qori', 'jenis_kelamin' => 'P'],
            ['guru_id' => 3, 'name' => 'Rina', 'jenis_kelamin' => 'P'],

            ['guru_id' => 4, 'name' => 'Sigit', 'jenis_kelamin' => 'L'],
            ['guru_id' => 4, 'name' => 'Tari', 'jenis_kelamin' => 'P'],
            ['guru_id' => 4, 'name' => 'Ujang', 'jenis_kelamin' => 'L'],
            ['guru_id' => 4, 'name' => 'Vina', 'jenis_kelamin' => 'P'],
            ['guru_id' => 4, 'name' => 'Wawan', 'jenis_kelamin' => 'L'],
            ['guru_id' => 4, 'name' => 'Xena', 'jenis_kelamin' => 'P'],
            ['guru_id' => 4, 'name' => 'Yuni', 'jenis_kelamin' => 'P'],
            ['guru_id' => 4, 'name' => 'Zaki', 'jenis_kelamin' => 'L'],
        ];

        foreach ($students as $student) {
            DB::table('students')->insert([
                'user_id' => null, // Atur jika siswa punya akun, kalau tidak bisa null
                'guru_id' => $student['guru_id'],
                'name' => $student['name'],
                'password' => Hash::make('123456'),
                'tanggal_lahir' => now()->subYears(rand(6, 10))->subDays(rand(0, 365)), // umur kira-kira 6–10 tahun
                'jenis_kelamin' => $student['jenis_kelamin'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
