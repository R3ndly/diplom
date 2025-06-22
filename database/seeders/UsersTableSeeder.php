<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    public function run(): void
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.ru',
            'password' => Hash::make('Q1qqqqqq'),
            'role' => 'admin',
        ]);
    }
}
