<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = [
            [
                'name' => 'admin',
                'email' => 'admin@gmail.com',
                'role' => 'admin',
                'password' => Hash::make('1234567890'),
            ],
        ];
        foreach ($user as $value) {
            User::create([
                'name' => $value['name'],
                'email' => $value['email'],
                'role' => $value['role'],
                'password' => $value['password'],
            ]);
        }
    }
}
