<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Karyawan;
use App\Models\Gaji;
use App\Models\Jabatan;
use App\Models\User;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@gmail.com',
            'password' => '12345678'
        ]);

        // Gaji::create([
        //     'gaji' => '$500',
        // ]);

        // Jabatan::create([
        //     'jabatan' => 'Manager',
        // ]);

        // Karyawan::factory(5)->create();
    }
}
