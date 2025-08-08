namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Buat roles
        $admin = Role::create(['name' => 'admin']);
        $dokter = Role::create(['name' => 'dokter']);
        $apoteker = Role::create(['name' => 'apoteker']);
        $kasir = Role::create(['name' => 'kasir']);

        // Buat user contoh
        $userAdmin = User::create([
            'name' => 'Admin SIMRS',
            'email' => 'admin@example.com',
            'password' => Hash::make('password')
        ]);
        $userAdmin->assignRole($admin);

        $userDokter = User::create([
            'name' => 'Dokter',
            'email' => 'dokter@example.com',
            'password' => Hash::make('password')
        ]);
        $userDokter->assignRole($dokter);

        $userApoteker = User::create([
            'name' => 'Apoteker',
            'email' => 'apoteker@example.com',
            'password' => Hash::make('password')
        ]);
        $userApoteker->assignRole($apoteker);

        $userKasir = User::create([
            'name' => 'Kasir',
            'email' => 'kasir@example.com',
            'password' => Hash::make('password')
        ]);
        $userKasir->assignRole($kasir);
    }
}

