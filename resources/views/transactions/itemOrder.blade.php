@extends('template')

@section('title')
    Order
@endsection

@section('konten')
    @include('header')

    <style>
        .container-ko {
            margin-top: 40px;
            margin-bottom: 40px;
        }

        .mbar {
            width: 100%;
        }

        .card-title {
            justify-content: space-between;
            margin-top: 25px;
        }

        .register {
            font-size: 10px;
            position: relative;
            bottom: 5px;
        }

        .cvc {
            width: 2.5em;
            position: absolute;
        }

        input {
            border: none;
            padding-left: 4px;
            background-color: #f7f1f1;
            font-size: 15px;
        }

        .card-body {
            background-color: #f7f1f1;
        }

        .footer {
            background-color: #00BCD4;
            color: white;
        }

        .footer:hover {
            cursor: pointer;
            background-color: #0097A7;
        }

        .numbr {
            border-bottom: 1px solid #c1bcbc;
            padding-bottom: 8px;
        }

        .line2 {
            border-bottom: 1px solid #c1bcbc;
            padding-bottom: 8px;
            padding-left: 0px;
        }

        input.focus,
        input:focus {
            outline: 0;
            box-shadow: none !important;
        }

        .numbr.numbr.hover,
        .numbr:hover {
            border-bottom: 1px solid aqua;
        }

        .line2.hover,
        .line2:hover {
            border-bottom: 1px solid aqua;
        }

        .fa-lock {
            margin-right: 10px;
        }

        .order {
            margin-top: 10px;
        }
    </style>

    <div class='container-ko'>
        <form action="{{ route('order.add', $barang->id) }}" method="post">
            @csrf
            <input type="hidden" name="id_barang" value="{{ $barang->id }}">
            <div class="card mx-auto col-md-5 col-8 mt-3 p-0">
                @if ($barang->image != '')
                    <img src="{{ asset('storage/image/' . $barang->image) }}" alt="Gambar Barang" class="mx-auto pic mbar">
                @else
                    <!-- Tampilkan gambar placeholder jika tidak ada gambar yang diunggah -->
                    <img src="{{ asset('storage/uploads/Sepatu-1691163151.png') }}" alt="Gambar Placeholder" class="mbar"
                        style="max-width: 100px;">
                @endif
                <div class="card-title d-flex px-4">
                    <h4 class="item text-muted">{{ $barang->nama_barang }}</h4>
                    <p>Rp{{ $barang->harga }}/<i class="text text-primary">hari</i></p>
                </div>
                <div class="card-body">
                    <h6 class="text-muted">Detail Peminjaman</h6>
                    <div class="numbr mb-3">
                        <i class=" col-1 fas fa-credit-card text-muted p-0">Tanggal Pengambilan</i>
                        <input type="date" style="margin-left: 58px; border-radius:8px; width: 200px" name="hari_ambil"
                            required>
                    </div>
                    <div class="line2 col-lg-12 col-12 mb-4">
                        <i class=" col-1 fas fa-credit-card text-muted p-0">Tanggal Pengembalian</i>
                        <input type="date" style="margin-left: 50px; border-radius:8px; width: 200px" name="hari_kembali"
                            required>
                    </div>
                </div>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="text-center p-0">
                    <button type="submit" class="btn btn-success col-lg-12 col-12">Booking</button>
                </div>
            </div>

        </form>
    </div>
@endsection
