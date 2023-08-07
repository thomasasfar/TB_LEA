@extends('template')

@section('title')
    Transaction
@endsection

@section('konten')
    @include('header')
    <main class="container">

        <h1 class="text-center mb-4">List Transaksi</h1>

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

        {{-- Button Tambah --}}
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahTransaksi">
            Tambah Transaksi
        </button>


        <!-- Modal Tambah Transaksi -->
        <div class="modal fade" id="modalTambahTransaksi" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Transaksi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('transaction.storeByAdmin') }}" id="addFormTransaksi" enctype="multipart/form-data">
                            @csrf
                            <div class="mb-3">
                                <label for="PilihUser" class="form-label">Customer</label>
                                <select class="form-select" aria-label="Default select example" name="username"
                                    id="username" required>
                                    <option selected>Pilih</option>
                                    @foreach ($user as $u)
                                        <option value="{{ $u->id }}">{{ $u->id }} | {{ $u->username }} -
                                            {{ $u->nama }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="PilihBarang" class="form-label">Product</label>
                                <select class="form-select" aria-label="Default select example" name="kode"
                                    id="kode" required>
                                    <option selected>Pilih</option>
                                    @foreach ($barang as $b)
                                        @if ($b->status == 'Tersedia')
                                            <option value="{{ $b->id }}">{{ $b->kode }} | {{ $b->nama_barang }}
                                                -
                                                Rp{{ $b->harga }}
                                            </option>
                                        @endif
                                    @endforeach
                                </select>
                                {{-- <div class="mb-3">
                                    <label for="" class="form-label"></label>
                                    <input type="hidden">
                                </div> --}}
                            </div>
                            <div class="mb-3">
                                <label for="PilihPengambilan" class="form-label">Tanggal Pengambilan</label>
                                <input type="date" id="PilihPengambilan" name="hari_ambil">
                            </div>
                            <div class="mb-3">
                                <label for="PilihPengembalian" class="form-label">Tanggal Pengembalian</label>
                                <input type="date" id="PilihPengembalian" name="hari_kembali">
                            </div>
                            <div class="mb-3">
                                <label for="UploadKTP" class="form-label">Upload KTP</label>
                                <input type="file" class="form-control" id="UploadKTP" name="ktp">
                            </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                        <button type="submit" class="btn btn-primary">Tambah</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>


        {{-- Table --}}
        <table class="table table-striped">
            <thead>
                <tr style="text-align: center">
                    <th scope="col" style="width: 3%">No</th>
                    <th scope="col" style="width: 10%">Username</th>
                    <th scope="col" style="width:8%">Kode Barang</th>
                    <th scope="col" style="width: 14%">Nama Barang</th>
                    <th scope="col" style="width: 10%">Hari Pengambilan</th>
                    <th scope="col" style="width: 10%">Hari Kembali</th>
                    <th scope="col" style="width: 9%">Lama Peminjaman</th>
                    <th scope="col" style="width: 10%">Total Harga</th>
                    <th scope="col" style="width: 8%">Pembayaran</th>
                    <th scope="col" style="width: 8%">Status</th>
                    <th scope="col" style="width: 10%">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($transactions as $t)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $t->user->username }}</td>
                        <td>{{ $t->barang->kode }}</td>
                        <td>{{ $t->barang->nama_barang }}</td>
                        <td>{{ $t->hari_ambil }}</td>
                        <td>{{ $t->hari_kembali }}</td>
                        <td>{{ $t->lama_peminjaman }} hari</td>
                        <td>Rp{{ $t->total_harga }}</td>

                        @if ($t->pembayaran == 'lunas')
                            <td style="color:green">Lunas</td>
                        @elseif ($t->pembayaran == 'dp')
                            <td style="color:orange">DP</td>
                        @endif

                        @if ($t->status == 'booking')
                            <td style="color: #00c6ee">Booking</td>
                        @elseif ($t->status == 'verified')
                            <td style="color:blue">Verified</td>
                        @elseif ($t->status == 'done')
                            <td style="color:brown">Done</td>
                        @endif

                        <td>
                            {{-- Button Aksi --}}
                            @if ($t->status === 'done')
                                <button type="button" class="btn btn-secondary" data-bs-toggle="modal"
                                    data-bs-target="#modalVerify{{ $t->id }}" disabled>
                                    <i class="bi bi-check2-circle"></i>
                                </button>
                            @else
                                <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                    data-bs-target="#modalVerify{{ $t->id }}">
                                    <i class="bi bi-check2-circle"></i>
                                </button>
                            @endif

                            <!-- Modal Aksi-->
                            <div class="modal fade" id="modalVerify{{ $t->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Verifikasi Status
                                                Transaksi</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('transactions.verify', $t->id) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                @if ($t->status === 'booking' && $t->pembayaran === 'lunas')
                                                    <div class="mb-3">
                                                        <label for="editTipeKamar">Status</label>
                                                        <select class="form-select" id="verify" name="status">
                                                            <option selected>Pilih</option>
                                                            <option value="verified"
                                                                {{ $t->status == 'verified' ? 'selected' : '' }}>Verified
                                                            </option>
                                                        </select>
                                                    </div>
                                                @elseif ($t->status === 'verified' && $t->pembayaran === 'lunas')
                                                    <div class="mb-3">
                                                        <label for="editTipeKamar">Status</label>
                                                        <select class="form-select" id="verify" name="status">
                                                            <option selected>Pilih</option>
                                                            <option value="done"
                                                                {{ $t->status == 'done' ? 'selected' : '' }}>Done
                                                            </option>
                                                        </select>
                                                    </div>
                                                @elseif ($t->status === 'booking' && $t->pembayaran === 'dp')
                                                    <div class="mb-3">
                                                        <p class="fw-semibold" style="color: #13315C">Payment is made
                                                            offline at StayScape reception, proceed to confirm customer
                                                            payment.</p>
                                                        <hr>
                                                        <p class="fw-normal">Change status transaction </p>
                                                        <label for="editTipeKamar">Status</label>
                                                        <select class="form-select" id="verify" name="status">
                                                            <option selected>Pilih</option>
                                                            <option value="verified"
                                                                {{ $t->status == 'verified' ? 'selected' : '' }}>Verified
                                                            </option>
                                                        </select>
                                                    </div>
                                                @else
                                                    <div class="mb-3">
                                                        <label for="editTipeKamar">Status</label>
                                                        <select class="form-select" id="verify" name="status">
                                                            <option selected>Pilih</option>
                                                            <option value="check out"
                                                                {{ $t->status == 'check out' ? 'selected' : '' }}>Check
                                                                Out
                                                            </option>
                                                        </select>
                                                    </div>
                                                @endif
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Batal</button>
                                                <button type="submit" class="btn btn-danger">OK</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </main>
@endsection
