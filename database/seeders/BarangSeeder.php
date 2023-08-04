<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BarangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('barangs')->insert([
            'kode' => 'A001',
            'nama_barang' => 'Tenda',
            'status' => 'Tersedia',
            'harga' => '120.000',
            
        ]);
    }
}
