<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->insert([
            [
                'role_name' => Role::SUPER_ADMIN,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_name' => Role::ADMIN,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_name' => Role::SUPPORT_AGENT,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'role_name' => Role::CLIENT,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}
