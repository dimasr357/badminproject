<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Lapangan;

class LapanganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $lapangans = [
            [
                'nama_lapangan' => 'Lapangan Premium Tertutup 1',
                'deskripsi' => 'Lapangan indoor dengan AC dan pencahayaan LED, lantai berkualitas tinggi untuk pengalaman bermain yang optimal',
                'harga_per_jam' => 60000,
                'tipe' => 'premium',
                'status' => 'tersedia',
                'image' => 'images/lapangan1.jpg',
            ],
            [
                'nama_lapangan' => 'Lapangan Premium Tertutup 2',
                'deskripsi' => 'Lapangan indoor dengan AC dan pencahayaan LED, dilengkapi dengan sistem pendingin udara',
                'harga_per_jam' => 60000,
                'tipe' => 'premium',
                'status' => 'tersedia',
                'image' => 'images/lapangan1.jpg',
            ],
            [
                'nama_lapangan' => 'Lapangan Standard 1',
                'deskripsi' => 'Lapangan indoor dengan pencahayaan standar, nyaman untuk latihan dan pertandingan',
                'harga_per_jam' => 50000,
                'tipe' => 'standard',
                'status' => 'tersedia',
                'image' => 'images/lapangan1.jpg',
            ],
            [
                'nama_lapangan' => 'Lapangan Standard 2',
                'deskripsi' => 'Lapangan indoor dengan pencahayaan standar, cocok untuk pemain semua level',
                'harga_per_jam' => 50000,
                'tipe' => 'standard',
                'status' => 'tersedia',
                'image' => 'images/lapangan1.jpg',
            ],
        ];

        foreach ($lapangans as $lapangan) {
            Lapangan::create($lapangan);
        }
    }
}
