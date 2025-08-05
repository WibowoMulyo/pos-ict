<?php

namespace Database\Seeders;

use App\Models\Barang;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $barangs = [
            [
                'kode_barang' => 'BRG001',
                'nama_barang' => 'Indomie Goreng',
                'harga' => 3000,
            ],
            [
                'kode_barang' => 'BRG002',
                'nama_barang' => 'Teh Kotak',
                'harga' => 5000,
            ],
            [
                'kode_barang' => 'BRG003',
                'nama_barang' => 'Mie Sedaap Soto',
                'harga' => 3500,
            ],
            [
                'kode_barang' => 'BRG004',
                'nama_barang' => 'Air Mineral Aqua 600ml',
                'harga' => 2000,
            ],
            [
                'kode_barang' => 'BRG005',
                'nama_barang' => 'Biskuit Roma Kelapa',
                'harga' => 4500,
            ],
            [
                'kode_barang' => 'BRG006',
                'nama_barang' => 'Kopi Kapal Api',
                'harga' => 12000,
            ],
            [
                'kode_barang' => 'BRG007',
                'nama_barang' => 'Roti Tawar Sari Roti',
                'harga' => 8000,
            ],
            [
                'kode_barang' => 'BRG008',
                'nama_barang' => 'Susu Ultra Milk Coklat',
                'harga' => 6500,
            ],
            [
                'kode_barang' => 'BRG009',
                'nama_barang' => 'Kerupuk Udang',
                'harga' => 7500,
            ],
            [
                'kode_barang' => 'BRG010',
                'nama_barang' => 'Snack Chitato Sapi Panggang',
                'harga' => 8500,
            ],
            [
                'kode_barang' => 'BRG011',
                'nama_barang' => 'Es Krim Walls Magnum',
                'harga' => 15000,
            ],
            [
                'kode_barang' => 'BRG012',
                'nama_barang' => 'Deterjen Rinso 800g',
                'harga' => 25000,
            ],
            [
                'kode_barang' => 'BRG013',
                'nama_barang' => 'Sabun Mandi Lifebuoy',
                'harga' => 3500,
            ],
            [
                'kode_barang' => 'BRG014',
                'nama_barang' => 'Shampo Pantene 170ml',
                'harga' => 18000,
            ],
            [
                'kode_barang' => 'BRG015',
                'nama_barang' => 'Pasta Gigi Pepsodent',
                'harga' => 4500,
            ],
        ];

        foreach ($barangs as $barang) {
            Barang::create($barang);
        }
    }
}
