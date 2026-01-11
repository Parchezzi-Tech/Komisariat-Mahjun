<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Reset permissions & roles
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        // 2. Create roles
        $adminRole = Role::firstOrCreate(['name' => 'admin']);
        $kaderRole = Role::firstOrCreate(['name' => 'kader']);
        $pmiiRole = Role::firstOrCreate(['name' => 'pmii']);

        // 3. Create Admin User
        $admin = User::firstOrCreate(
            ['email' => 'admin@pmii.org'],
            [
                'name' => 'Admin PMII',
                'password' => bcrypt('password'), // Ganti untuk production
                'email_verified_at' => now(),
            ]
        );
        $admin->assignRole($adminRole);

        // 4. Create Kader User (contoh)
        $kader = User::firstOrCreate(
            ['email' => 'kader@pmii.org'],
            [
                'name' => 'Kader PMII',
                'password' => bcrypt('password'),
                'email_verified_at' => now(),
            ]
        );
        $kader->assignRole($kaderRole);

        // 5. Test User
        $testUser = User::firstOrCreate([
            'email' => 'test@example.com',
        ], [
            'name' => 'Test User',
            'password' => bcrypt('password'),
        ]);
        $testUser->assignRole($kaderRole);
        
        // 6. Seed Anggota data
        $this->call(AnggotaSeeder::class);
        
        // 7. Seed Surat data
        $this->call(SuratSeeder::class);
    }
}
