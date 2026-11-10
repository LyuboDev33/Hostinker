<?php

namespace Database\Seeders;

use App\Models\User;
use Database\Seeders\RolesSeeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Lyubomir Stoyanov',
            'email' => 'admin@hosthinker.com',
                'password' => Hash::make('Slyubomir12!'),

        ]);

        $this->call([
            RolesSeeder::class,
            AssignRoleSeeder::class
        ]);
    }
}
