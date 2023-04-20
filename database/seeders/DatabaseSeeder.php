<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'akses' => 'admin',
            'nik' => '1234567890',
            'name' => 'Test Admin',
            'gender' => 'Laki-laki',
            'tanggal_masuk' => date("Y-m-d"),
            'username' => 'admin',
            'password' => Hash::make('123'),
        ]);

        \App\Models\User::factory()->create([
            'akses' => 'pegawai',
            'nik' => '1234567890',
            'name' => 'Test Pegawai',
            'gender' => 'Laki-laki',
            'tanggal_masuk' => date("Y-m-d"),
            'username' => 'pegawai',
            'password' => Hash::make('123'),
        ]);

        // \App\Models\Training::factory()->create([
        //     'nama' => 'Test Training',
        //     'deskripsi' => 'Lorem ipsum dolor, sit amet consectetur adipisicing elit. Nesciunt, ducimus.',
        //     'periode' => date('Y/m/d')
        // ]);

        \App\Models\Training::factory(10)->create();

        \App\Models\Kelompok::factory(12)->create();
    }
}
