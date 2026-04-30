<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
   public function run(): void
{
    // Jalankan RoleSeeder dulu biar tabel roles terisi
    $this->call(RoleSeeder::class);

    // Buat User Admin di sini
    $admin = \App\Models\User::create([
        'name' => 'Admin SIAgenda',
        'email' => 'admin@siagenda.com',
        'password' => bcrypt('password123'),
    ]);

    // Berikan role administrator (Spatie yang urus tabel penghubungnya)
    $admin->assignRole('administrator');

        // 2. Buat Kategori
        Category::create(['name' => 'Akademik', 'slug' => 'akademik']);
        Category::create(['name' => 'Ekstrakurikuler', 'slug' => 'ekskul']);
        Category::create(['name' => 'Rapat', 'slug' => 'rapat']);
        
        // 3. Buat satu user dummy untuk testing (Opsional)
       
    }
}