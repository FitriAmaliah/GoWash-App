<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create an Admin user
        User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => Hash::make('adminpassword'),
            'role' => 'admin',  // Admin role
        ]);

        // Create a Regular User
        User::create([
            'name' => 'User',
            'email' => 'user@gmail.com',
            'password' => Hash::make('userpassword'),
            'role' => 'user',  // Regular user role
        ]);

        // Create a Karyawan (employee) user
        User::create([
            'name' => 'Karyawan',
            'email' => 'karyawan@gmail.com',
            'password' => Hash::make('karyawanpassword'),
            'role' => 'karyawan',  // Karyawan role
        ]);
    }
}
