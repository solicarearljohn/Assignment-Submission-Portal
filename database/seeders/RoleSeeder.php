<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('roles')->insert([
            ['id' => 1, 'name' => 'Faculty', 'created_at' => now(), 'updated_at' => now()],
            ['id' => 2, 'name' => 'Student', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }
}
