<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Akun Admin
        User::create([
            'name'     => 'Admin MyMuhasabah',
            'email'    => 'admin@gmail.com',
            'password' => Hash::make('admin123'),
            'role'     => 'admin',
            'bio'      => 'Administrator sistem MyMuhasabah.',
        ]);

        // Akun User Demo
        User::create([
            'name'     => 'Fulan 1',
            'email'    => 'fulan@gmail.com',
            'password' => Hash::make('fulan123'),
            'role'     => 'user',
            'bio'      => 'Seorang hamba yang sedang belajar muhasabah.',
        ]);
    }
}