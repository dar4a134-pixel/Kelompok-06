<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. Buat Role Resmi
        $adminRole = Role::firstOrCreate(['name' => 'Admin']);
        $instrukturRole = Role::firstOrCreate(['name' => 'Instruktur']);
        $mahasiswaRole = Role::firstOrCreate(['name' => 'Mahasiswa']);

        // 2. Buat User Admin Utama (Hak Akses Penuh)
        $adminUser = User::firstOrCreate(
            ['email' => 'admin@kursus.com'],
            [
                'name' => 'Admin Kursus',
                'password' => Hash::make('password'),
            ]
        );
        $adminUser->assignRole($adminRole);

        // 3. Buat User Instruktur (Akses Read-Only)
        $instrukturUser = User::firstOrCreate(
            ['email' => 'ahmad@kursus.com'],
            [
                'name' => 'Instruktur Ahmad',
                'password' => Hash::make('password'),
            ]
        );
        $instrukturUser->assignRole($instrukturRole);

        // 4. Buat User Mahasiswa (Akses Read-Only)
        $mahasiswaUser = User::firstOrCreate(
            ['email' => 'mahasiswa@kursus.com'],
            [
                'name' => 'Ibnu Mahasiswa',
                'password' => Hash::make('password'),
            ]
        );
        $mahasiswaUser->assignRole($mahasiswaRole);
    }
}