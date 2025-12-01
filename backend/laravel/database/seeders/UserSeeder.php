<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserSeeder extends Seeder
{
    // Run the database seeds.
    public function run(): void
    {
        // trial manual
        User::create([
            'username' => 'trial',
            'email' => 'trial@example.com',
            'password' => Hash::make('password123'),
            'dob' => '2000-12-06',
        ]);

        // Dummy user from factory
        User::factory(10)->create();


    }
}
