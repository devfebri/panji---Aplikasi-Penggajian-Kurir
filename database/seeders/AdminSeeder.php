<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'nama' => 'admin',
            'email' => 'admin@admin.com',
            'nohp' => '1234',
            'password' => bcrypt('adminadmin'),
            'is_admin' => true,
            'nik' => '123',
            'jenis_kelamin' => 'laki-laki',
            'status' => 1
        ]);
    }
}
