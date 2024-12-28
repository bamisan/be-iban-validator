<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class InitialUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        echo 'Seeding Ascentic users' . PHP_EOL;

        $ascenticUsers = [
            [
                'name' => 'Admin',
                'email' => 'admin@gmail.com',
                'is_admin' => true
            ],
            [
                'name' => 'Kolitha Perera',
                'email' => 'KP@gmail.com',
            ],
            [
                'name' => 'Wasana Gallage',
                'email' => 'WG@gmail.com',
            ],
            [
                'name' => 'Bamisan Sellathurai',
                'email' => 'BS@gmail.com',
            ],
        ];

        foreach ($ascenticUsers as $ascenticUser) {
            User::create([
                ...$ascenticUser,
                'password' => Hash::make('Iban@2025'),
                'email_verified_at' => now(),
            ]);

        }
    }
}
