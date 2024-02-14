<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        \App\Models\User::factory()->create([
            'id' => Str::uuid(),
            'name' => 'Wan Putera',
            'email' => 'putera@example.com',
            'password' => bcrypt('password'),
        ]);
    }
}
