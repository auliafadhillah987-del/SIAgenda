<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Bersihkan cache role dan permission agar tidak ada bentrok
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        

        // 2. Buat Daftar Hak Akses (Permissions)
        // Admin bisa melakukan semuanya
        Permission::firstOrCreate(['name' => 'kelola semua agenda']); 
        
        // Guru hanya bisa mengelola miliknya sendiri
        Permission::firstOrCreate(['name' => 'tambah agenda']);
        Permission::firstOrCreate(['name' => 'edit agenda sendiri']);
        Permission::firstOrCreate(['name' => 'hapus agenda sendiri']);
        
        // Siswa/Umum hanya bisa melihat
        Permission::firstOrCreate(['name' => 'lihat agenda']);

        // 3. Buat Daftar Peran (Roles) dan hubungkan dengan Permission
        
        // Role Administrator
        $admin = Role::firstOrCreate(['name' => 'administrator']);
        $admin->givePermissionTo(Permission::all());

        // Role Guru/Staff
        $guru = Role::firstOrCreate(['name' => 'guru/staff']);
        $guru->givePermissionTo([
            'tambah agenda',
            'edit agenda sendiri',
            'hapus agenda sendiri',
            'lihat agenda'
        ]);

        // Role Siswa/Orang Tua Siswa
        $siswa = Role::firstOrCreate(['name' => 'siswa/orang tua siswa']);
        $siswa->givePermissionTo('lihat agenda');

        // --- BUAT USER CONTOH ---

        // 1. Admin User
        $adminUser = \App\Models\User::firstOrCreate(
            ['email' => 'admin@siagenda.com'],
            [
                'name' => 'Admin SIAgenda',
                'password' => bcrypt('password123'),
            ]
        );
        $adminUser->assignRole('administrator');

        // 2. Guru User
        $guruUser = \App\Models\User::firstOrCreate(
            ['email' => 'guru@siagenda.com'],
            [
                'name' => 'Bapak Guru',
                'password' => bcrypt('password123'),
            ]
        );
        $guruUser->assignRole('guru/staff');

        // 3. Siswa User
        $siswaUser = \App\Models\User::firstOrCreate(
            ['email' => 'siswa@siagenda.com'],
            [
                'name' => 'Siswa Teladan',
                'password' => bcrypt('password123'),
            ]
        );
        $siswaUser->assignRole('siswa/orang tua siswa');
    }
}