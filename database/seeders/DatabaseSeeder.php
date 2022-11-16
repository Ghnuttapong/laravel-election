<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Nuttapong Wipa',
            'email' => 'nuttapong@gmail.com',
            'role' => 3,
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Voter Voter',
            'email' => 'voter@example.com',
            'role' => 1,
        ]);


        \App\Models\User::factory()->create([
            'name' => 'User User',
            'email' => 'user@example.com',
            'role' => 1,
        ]);

    }
}
