<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Group;

class GroupSeeder extends Seeder
{
    public function run(): void
    {
        foreach (range(1, 3) as $i) {
            Group::create([
                'name' => 'Group ' . $i,
            ]);
        }
    }
}
