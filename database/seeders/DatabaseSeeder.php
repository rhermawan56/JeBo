<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'name'=>'Admin',
            'email'=>'admin@gmail.com',
            'role' => 'Admin',
            'password'=>bcrypt('password')
        ]);

        User::create([
            'name'=>'Super Admin',
            'email'=>'superadmin@gmail.com',
            'role' => 'Super Admin',
            'password'=>bcrypt('password')
        ]);

        User::create([
            'name'=>'Supervisor',
            'email'=>'spv@gmail.com',
            'role' => 'Supervisor',
            'password'=>bcrypt('password')
        ]);
    }
}
