<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\{Role, Permission};
use App\Models\User;

class RolePermissionSeeder extends Seeder
{
    public function run(): void
    {
        // Permissions (sesuaikan nanti)
        $perms = [
            'manage users','manage master data',
            'view pasien','create rekam medis','update rekam medis',
            'view obat','manage stok obat','kelola resep',
        ];
        foreach ($perms as $p) { Permission::firstOrCreate(['name'=>$p]); }

        // Roles
        $admin    = Role::firstOrCreate(['name'=>'admin']);
        $dokter   = Role::firstOrCreate(['name'=>'dokter']);
        $apoteker = Role::firstOrCreate(['name'=>'apoteker']);

        // Assign permissions
        $admin->givePermissionTo(Permission::all());
        $dokter->givePermissionTo(['view pasien','create rekam medis','update rekam medis']);
        $apoteker->givePermissionTo(['view obat','manage stok obat','kelola resep']);

        // Admin user awal
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@simrs.test'],
            ['name' => 'Admin SIMRS', 'password' => Hash::make('password')]
        );
        $adminUser->syncRoles(['admin']);
    }
}
