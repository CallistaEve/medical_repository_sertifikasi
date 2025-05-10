<?php

namespace Database\Seeders;

use App\Models\Item;
use Illuminate\Database\Seeder;

class ItemSeeder extends Seeder
{
    public function run()
    {
        // Menghapus data lama
        Item::truncate(); // Menghapus semua data dari tabel items

        // Seeder data baru
        Item::create([
            'nama' => 'Paracetamol',
            'harga' => 5000,
            'jumlah' => 100,
            'kategori' => 'obat',
            'dosis' => '500mg',
            'tanggal_kadaluarsa' => '2025-12-31',
            'butuh_resep' => 'Tidak'
        ]);

        Item::create([
            'nama' => 'Aspirin',
            'harga' => 7000,
            'jumlah' => 80,
            'kategori' => 'obat',
            'dosis' => '100mg',
            'tanggal_kadaluarsa' => '2026-05-01',
            'butuh_resep' => 'Iya'
        ]);

        Item::create([
            'nama' => 'Stethoscope',
            'harga' => 150000,
            'jumlah' => 50,
            'kategori' => 'peralatan',
            'departemen' => 'Cardiology',
            'status_operasional' => 'Operational',
            'jadwal_pemeliharaan' => '2025-08-15'
        ]);

        Item::create([
            'nama' => 'Syringe',
            'harga' => 10000,
            'jumlah' => 150,
            'kategori' => 'barang_habis_pakai',
            'jenis_penggunaan' => 'Single-use',
            'status_sterilisasi' => 'Sterile',
            'tanggal_kadaluarsa' => '2026-12-31'
        ]);

        Item::create([
            'nama' => 'Gauze',
            'harga' => 3000,
            'jumlah' => 200,
            'kategori' => 'barang_habis_pakai',
            'jenis_penggunaan' => 'Single-use',
            'status_sterilisasi' => 'Non-sterile',
            'tanggal_kadaluarsa' => '2026-06-15'
        ]);
    }
}
