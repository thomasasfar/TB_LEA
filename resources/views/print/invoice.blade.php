<!DOCTYPE html>
<html>

<head>
    <title>Invoice</title>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 5px;
            border: 1px solid #000;
        }
    </style>
</head>

<body>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h1>Invoice</h1>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">

                                </div>
                            </div>
                            <div class="col-md-6">
                                <table class="table">
                                    <tr>
                                        <td width="30%">Peminjam</td>
                                        <td>:{{ $transactions->user->nama }}</td>
                                    </tr>

                                    <tr>
                                        <td>No Telp</td>
                                        <td>:{{ $transactions->user->no_hp }}</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:{{ $transactions->user->email }}</td>
                                    </tr>
                                </table>
                            </div>

                            <br>
                            <br>

                            <div class="col-md-12 mt-3">

                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <td>Barang</td>
                                            <td>Harga per Hari</td>
                                            <td>Tanggal Peminjaman</td>
                                            <td>Tanggal Pengembalian</td>
                                            <td>Lama Peminjaman</td>
                                            <th>Total Harga</th>
                                        </tr>
                                    </thead>


                                    <!-- MENAMPILKAN PRODUK YANG TELAH DITAMBAHKAN -->
                                    <tbody>
                                        <tr>
                                            <td>{{ $transactions->barang->kode }} - {{ $transactions->barang->nama_barang }}</td>
                                            <td>{{ $transactions->barang->harga }}</td>
                                            <td>{{ $transactions->hari_ambil }}</td>
                                            <td>{{ $transactions->hari_kembali }}</td>
                                            <td>{{ $transactions->lama_peminjaman }}</td>
                                            <td>{{ $transactions->total_harga }}</td>
                                        </tr>
                                    </tbody>

                                    <!-- FORM UNTUK MEMILIH PRODUK YANG AKAN DITAMBAHKAN -->
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
