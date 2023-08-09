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
            'harga' => '120000',
            'image' => 'Tenda.jpg'
        ]);

        DB::table('barangs')->insert([
            'kode' => 'A002',
            'nama_barang' => 'Carrier',
            'status' => 'Tersedia',
            'harga' => '100000',
            'image' => 'Carrier.jpg'
        ]);

        DB::table('barangs')->insert([
            'kode' => 'A003',
            'nama_barang' => 'Kompor',
            'status' => 'Tersedia',
            'harga' => '80000',
            'image' => 'Kompor.jpg'
        ]);

        DB::table('barangs')->insert([
            'kode' => 'A004',
            'nama_barang' => 'Lentera',
            'status' => 'Tersedia',
            'harga' => '20000',
            'image' => 'LenteraCamping.jpg'
        ]);

        DB::table('barangs')->insert([
            'kode' => 'A005',
            'nama_barang' => 'Sleeping Bag',
            'status' => 'Tersedia',
            'harga' => '90000',
            'image' => 'SleepingBag.jpg'
        ]);
    }
}
