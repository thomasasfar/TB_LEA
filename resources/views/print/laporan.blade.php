@extends('template')

@section('title')
    Laporan
@endsection

@section('konten')
    @include('header')
    <main class="container">

        <h1 class="text-center mb-4">Laporan</h1>
    <table class="table table-striped">
            <thead>
                <tr style="text-align: left">
                    <th scope="col" style="width: 3%">No</th>
                    <th scope="col" style="width: 10%">Username</th>
                    <th scope="col" style="width:8%">Kode Barang</th>
                    <th scope="col" style="width: 10%">ID Transaksi</th>
                    <th scope="col" style="width: 12%">Nama Barang</th>
                    <th scope="col" style="width: 10%">Hari Pengambilan</th>
                    <th scope="col" style="width: 10%">Hari Kembali</th>
                    <th scope="col" style="width: 9%">Lama Peminjaman</th>
                    <th scope="col" style="width: 9%">Total Harga</th>
                    <th scope="col" style="width: 8%">Pembayaran</th>
                    <th scope="col" style="width: 8%">Status</th>

                </tr>
            </thead>
            </table>
</main>
@endsection