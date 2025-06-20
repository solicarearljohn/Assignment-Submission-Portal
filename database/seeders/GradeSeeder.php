<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GradeSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('grades')->insert([
            ['value' => 'A', 'description' => 'Excellent'],
            ['value' => 'B', 'description' => 'Good'],
            ['value' => 'C', 'description' => 'Average'],
            ['value' => 'D', 'description' => 'Below Average'],
            ['value' => 'F', 'description' => 'Fail'],
            ['value' => 'PASS', 'description' => 'Passed'],
            ['value' => '100', 'description' => 'Perfect Score'],
        ]);
    }
}
