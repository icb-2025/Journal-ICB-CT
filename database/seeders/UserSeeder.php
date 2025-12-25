<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder // run this command php artisan db:seed --class=UserSeeder

{
    public function run(): void
    {
        User::create([
            'name' => 'Super User',
            'email' => 'superuser@example.com',
            'password' => '12345678',
            'role' => 'superuser',
        ]);

        User::create([
            'name' => 'Guru User',
            'email' => 'guru@example.com',
            'password' => Hash::make('password'),
            'role' => 'guru',
        ]);

        User::create([
            'name' => 'Siswa User',
            'email' => 'siswa@example.com',
            'password' => Hash::make('password'),
            'role' => 'siswa',
        ]);
    }
}

