<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\User;

class RoleSeeder extends Seeder
{
    public function run(): void
    {
        // Buat roles kalau belum ada
        $roles = ['admin', 'dokter', 'apoteker', 'kasir'];
        foreach ($roles as $role) {
            Role::firstOrCreate(['name' => $role, 'guard_name' => 'web']);
        }

        // Buat user admin
        $admin = User::firstOrCreate(
            ['email' => 'admin@example.com'],
            [
                'name' => 'Admin SIMRS',
                'password' => Hash::make('password123'),
            ]
        );
        $admin->assignRole('admin');

        // Buat user dokter
        $dokter = User::firstOrCreate(
            ['email' => 'dokter@example.com'],
            [
                'name' => 'Dokter Umum',
                'password' => Hash::make('password123'),
            ]
        );
        $dokter->assignRole('dokter');

        // Buat user apoteker
        $apoteker = User::firstOrCreate(
            ['email' => 'apoteker@example.com'],
            [
                'name' => 'Apoteker',
                'password' => Hash::make('password123'),
            ]
        );
        $apoteker->assignRole('apoteker');

        // Buat user kasir
        $kasir = User::firstOrCreate(
            ['email' => 'kasir@example.com'],
            [
                'name' => 'Kasir',
                'password' => Hash::make('password123'),
            ]
        );
        $kasir->assignRole('kasir');
    }
}
