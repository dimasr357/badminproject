<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Update or create admin account
        \App\Models\Admin::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'username' => 'admin',
                'nama_lengkap' => 'Administrator',
                'no_hp' => '082197252773',
                'password' => bcrypt('admin123'), // Password: admin123
            ]
        );
    }
}
