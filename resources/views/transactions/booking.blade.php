@extends('template')

@section('title')
    My Book
@endsection

@section('konten')
    @include('header')

    <style>
        .active-tab::after {
            content: '';
            display: block;
            width: 100%;
            height: 2px;
            background-color: #000;
            /* Ganti dengan warna yang sesuai */
            margin-top: 5px;
            /* Sesuaikan jarak dari teks */
        }

        .nav-link {
            color: #000;
        }
    </style>


    <main class="container">

        <ul class="nav justify-content-center">
            <li class="nav-item">
                <a class="nav-link " href="{{ route('order') }}">Semua</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-3 active-tab" aria-current="page" href="{{ route('order.book') }}">Booking</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{ route('order.verified') }}">Verified</a>
            </li>
            <li class="nav-item">
                <a class="nav-link mx-3" href="{{ route('order.done') }}">Done</a>
            </li>
        </ul>

        {{-- menampilkan alert msg --}}
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        @foreach ($transactions as $tr)
            <div class="container card mb-3" style="width: 800px; height:200px">
                <div class="row g-0 justify-content-between">
                    <div class="col-md-4 ">
                        <img src="{{ asset('storage/image/' . $tr->barang->image) }}" alt="Gambar Barang"
                            style="width: 200px; height:200px" alt="...">
                    </div>
                    <div class="col-md-8">
                        <div class="card-body d-flex flex-column">
                            <div class="row g-0 ">
                                <div class="col-sm-6 col-md-8">
                                    <h5 class="card-title">ID Transaksi: {{ $tr->id }}</h5>
                                    <h6 class="card-text">{{ $tr->barang->kode }} | {{ $tr->barang->nama_barang }}</h6>
                                    <p>{{ $tr->status }}</p>
                                    <p class="card-text text-primary">{{ $tr->hari_ambil }} s/d {{ $tr->hari_kembali }}
                                    </p>
                                    <p class="card-text"><small class="text-muted">{{ $tr->lama_peminjaman }} hari x
                                            Rp{{ $tr->barang->harga }}</small></p>
                                </div>
                                <div class="col-6 col-md-4">
                                    <div class="align-self-end">
                                        <br>
                                        <h6 class="card-text">Total Harga</h6>
                                        <h5 class="card-text">Rp{{ $tr->total_harga }}</h5>
                                        <br>
                                        <div class="align-self-end">
                                            @if ($tr->status === 'booking')
                                                <button class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#modalVerifyStatus{{ $tr->id }}">Verifikasi</button>
                                            @else
                                                <button class="btn btn-primary" data-bs-toggle="modal"
                                                    data-bs-target="#modalVerifyStatus{{ $tr->id }}"
                                                    disabled>Verifikasi</button>
                                            @endif
                                        </div>

                                        <!-- Modal Verify Status-->
                                        <div class="modal fade" id="modalVerifyStatus{{ $tr->id }}" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel"> Verifikasi
                                                            Booking
                                                        </h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <form action="{{ route('booking.verify', $tr->id) }}"
                                                            method="POST" class="d-inline" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <label class="fw-semibold" for="pembayaran">Upload KTP</label>
                                                            <input type="file" class="form-control" id="UploadKTP"
                                                                name="ktp">
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>

                                                        <button type="submit" class="btn btn-success">Verify</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>
                        </div>
        @endforeach
    </main>

@endsection
