<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Role::firstOrCreate([
            'role_name' => Role::SUPER_ADMIN,
        ]);

        Role::firstOrCreate([
            'role_name' => Role::ADMIN,
        ]);

        Role::firstOrCreate([
            'role_name' => Role::SUPPORT_AGENT,
        ]);

        Role::firstOrCreate([
            'role_name' => Role::CLIENT,
        ]);
    }
}
