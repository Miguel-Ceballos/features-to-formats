<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'Miguel Ceballos',
            'email' => 'miguel@example.com',
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->email(),
            'password' => bcrypt('12345678'),
        ]);

        User::create([
            'name' => fake()->name(),
            'email' => fake()->unique()->email(),
            'password' => bcrypt('12345678'),
        ]);
    }
}
