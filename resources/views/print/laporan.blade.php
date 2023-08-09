!DOCTYPE html>
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
</head>>

<body>
    <div class="container">
        <h1 class="text-center mb-4">Laporan</h1>
        <table class="table table-striped">
            @foreach ($transactions as $transactions)
            <thead>
                <tr style="text-align: left">
                    <th scope="col" style="width: 3%">No</th>
                    <th scope="col" style="width: 7%">ID Transaksi</th>
                    <th scope="col" style="width: 10%">Username</th>
                    <th scope="col" style="width: 10%">Kode Barang</th>
                    <th scope="col" style="width: 12%">Nama Barang</th>
                    <th scope="col" style="width: 10%">Hari Pengambilan</th>
                    <th scope="col" style="width: 10%">Hari Kembali</th>
                    <th scope="col" style="width: 9%">Lama Peminjaman</th>
                    <th scope="col" style="width: 11%">Total Harga</th>
                    <th scope="col" style="width: 9%">Pembayaran</th>
                    <th scope="col" style="width: 9%">Status</th>
                </tr>
            </thead>
            <tbody>
                <tr style="text-align: left">
                    <th>{{ $loop->iteration }}</th>
                    <td>{{ $transactions->id }}</td>
                    <td>{{ $transactions->user->username }}</td>
                    <td>{{ $transactions->barang->kode }}</td>
                    <td>{{ $transactions->barang->nama_barang }}</td>
                    <td>{{ $transactions->hari_ambil }}</td>
                    <td>{{ $transactions->hari_kembali }}</td>
                    <td>{{ $transactions->lama_peminjaman }}</td>
                    <td>{{ $transactions->total_harga }}</td>
                    <td>{{ $transactions->pembayaran }}</td>
                    <td>{{ $transactions->status }}</td>
                </tr>
            </tbody>
            @endforeach
        </table>
    </div>
</body>
