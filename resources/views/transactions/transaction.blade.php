@extends('template')

@section('title')
    Barang
@endsection

@section('konten')
    @include('header')
    <main class="container">

        <h1 class="text-center mb-4">List Barang</h1>

        {{-- Button Tambah --}}
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahBarang">
            Tambah Transaksi
        </button>


        <!-- Modal -->
        <div class="modal fade" id="modalTambahBarang" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Transaksi</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="{{ route('transaction.storeByAdmin') }}">
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
                                <input type="hidden">
                            </div>
                            <div class="mb-3">
                                <label for="PilihBarang" class="form-label">Product</label>
                                <select class="form-select" aria-label="Default select example" name="id"
                                    id="id" required>
                                    <option selected>Pilih</option>
                                    @foreach ($barang as $b)
                                        <option value="{{ $b->id }}">{{ $b->id }} | {{ $b->nama_barang }} -
                                            Rp{{ $b->harga }}
                                        </option>
                                    @endforeach
                                </select>
                                <input type="hidden">
                            </div>
                            <div class="mb-3">
                                <label for="PilihPengambilan" class="form-label">Tanggal Pengambilan</label>
                                <input type="datetime-local" class="datetime" id="PilihPengambilan" name="hari_ambil">
                            </div>
                            <div class="mb-3">
                                <label for="PilihPengembalian" class="form-label">Tanggal Pengembalian</label>
                                <input type="datetime-local" class="datetime" id="PilihPengembalian" name="hari_kembali">
                            </div>
                            <div class="mb-3">
                                <label for="InputStatus">Status</label>
                                <input type="file" class="form-control" id="InputGambar" name="ktp">
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

                        @if ($t->pembayaran == 'Lunas')
                            <td style="color:green">Lunas</td>
                        @elseif ($t->pembayaran == 'DP')
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
                            <div class="modal fade" id="modalHapusBarang{{ $t->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Verifikasi Status
                                                Transaksi</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('transactions.verify', $tr->id_transaksi) }}"
                                            method="POST">
                                            @csrf
                                            @method('PUT')
                                            <div class="modal-body">
                                                @if ($tr->status === 'booking' && $tr->pembayaran === 'paid')
                                                    <div class="mb-3">
                                                        <label for="editTipeKamar">Status</label>
                                                        <select class="form-select" id="verify" name="status">
                                                            <option selected>Pilih</option>
                                                            <option value="verified"
                                                                {{ $tr->status == 'verified' ? 'selected' : '' }}>Verified
                                                            </option>
                                                        </select>
                                                    </div>
                                                @elseif ($tr->status === 'verified' && $tr->pembayaran === 'paid')
                                                    <div class="mb-3">
                                                        <label for="editTipeKamar">Status</label>
                                                        <select class="form-select" id="verify" name="status">
                                                            <option selected>Pilih</option>
                                                            <option value="check in"
                                                                {{ $tr->status == 'check in' ? 'selected' : '' }}>Check In
                                                            </option>
                                                        </select>
                                                    </div>
                                                @elseif ($tr->status === 'booking' && $tr->pembayaran === 'unpaid')
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
                                                                {{ $tr->status == 'verified' ? 'selected' : '' }}>Verified
                                                            </option>
                                                        </select>
                                                    </div>
                                                @else
                                                    <div class="mb-3">
                                                        <label for="editTipeKamar">Status</label>
                                                        <select class="form-select" id="verify" name="status">
                                                            <option selected>Pilih</option>
                                                            <option value="check out"
                                                                {{ $tr->status == 'check out' ? 'selected' : '' }}>Check
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

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-warning" data-bs-toggle="modal"
                                data-bs-target="#modalEditBarang{{ $m->id }}">
                                <i>Edit</i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modalEditBarang{{ $m->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Edit Barang</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form method="post" action="/barang/{{ $m->id }}/update"
                                                enctype="multipart/form-data">
                                                @csrf
                                                @method('put')
                                                <div class="mb-3">
                                                    <label for="InputKode" class="form-label">Kode</label>
                                                    <input value="{{ $m->kode }}" type="text"
                                                        class="form-control" id="InputKode" aria-describedby="emailHelp"
                                                        name="kode">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="InputGambar" class="form-label">Gambar</label>
                                                    <input value="{{ $m->image }}" type="file"
                                                        class="form-control" id="InputGambar"
                                                        aria-describedby="emailHelp" name="image">
                                                    <img src="{{ asset('storage/image/' . $m->image) }}"
                                                        alt="{{ $m->nama_barang }}" style="max-width: 200px;">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="InputNama" class="form-label">Nama</label>
                                                    <input value="{{ $m->nama_barang }}" type="text"
                                                        class="form-control" id="InputNama" name="nama_barang">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="InputNama" class="form-label">Harga</label>
                                                    <input value="{{ $m->harga }}" type="text"
                                                        class="form-control" id="InputHarga" name="harga">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="InputStatus">Status</label>
                                                    <select value="{{ $m->status }}" class="form-select"
                                                        id="status" aria-label="Default select example"
                                                        name="status">
                                                        <option selected>Pilih</option>
                                                        <option value="Tersedia"
                                                            {{ $m->status == 'Tersedia' ? 'selected' : '' }}>Tersedia
                                                        </option>
                                                        <option value="Tidak Tersedia"
                                                            {{ $m->status == 'Tidak Tersedia' ? 'selected' : '' }}>
                                                            Tidak Tersedia</option>
                                                    </select>
                                                </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Tutup</button>
                                            <button type="submit" class="btn btn-primary">Edit</button>
                                        </div>
                                        </form>
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
