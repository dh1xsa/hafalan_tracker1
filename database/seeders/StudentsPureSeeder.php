<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class StudentsPureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create('id_ID');

        for ($i = 1; $i <= 50; $i++) {
            DB::table('students_pure')->insert([
                'name' => 'Siswa ' . $i,
                'birth_date' => $faker->dateTimeBetween('-15 years', '-10 years')->format('Y-m-d'),
                'gender' => $faker->randomElement(['L', 'P']),
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
