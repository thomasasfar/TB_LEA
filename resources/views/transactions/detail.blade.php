@extends('template')

@section('title')
    My Book
@endsection

@section('konten')
    @include('header')

    <div class="container-xl px-4 mt-4">
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">KTP/SIM</div>
                    <div class="card-body text-center">
                        @if ($transactions->ktp != '')
                        <img src="{{ asset('storage/ktp/' . $transactions->ktp) }}" alt="Gambar Barang"
                        style="max-width: 300px;">
                            @else
                                <!-- Tampilkan gambar placeholder jika tidak ada gambar yang diunggah -->
                                <img src="{{ asset('placeholder.jpg') }}"
                                    alt="Gambar Placeholder" style="width: 300px;">
                            @endif

                        <!-- Profile picture upload button-->
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Detail Transaksi</div>
                    <div class="card-body personal-info">
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputName">Username</label>
                                    <input class="form-control" id="inputName" type="text" placeholder="Enter your name"
                                        value="{{ $transactions->user->username }}" disabled>
                                </div>
                                <div class="col-md-6">
                                    <label class="small mb-1" for="inputName">Name</label>
                                    <input class="form-control" id="inputName" type="text" placeholder="Enter your name"
                                        value="{{ $transactions->user->nama }}" disabled>
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-4">
                                    <label class="small mb-1" for="inputName">Kode Barang</label>
                                    <input class="form-control" id="inputName" type="text"
                                        value="{{ $transactions->barang->kode }}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="inputName">Nama Barang</label>
                                    <input class="form-control" id="inputName" type="text"
                                        value="{{ $transactions->barang->nama_barang }}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="inputName">Harga per Hari</label>
                                    <input class="form-control" id="inputName" type="text"
                                        value="Rp{{ $transactions->barang->harga }}" disabled>
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-4">
                                    <label class="small mb-1" for="inputName">Tanggal Peminjaman</label>
                                    <input class="form-control" id="inputName" type="date"
                                        value="{{ $transactions->hari_ambil }}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="inputName">Tanggal Pengembalian</label>
                                    <input class="form-control" id="inputName" type="date"
                                        value="{{ $transactions->hari_kembali }}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="inputName">Lama Peminjaman</label>
                                    <input class="form-control" id="inputName" type="text"
                                        value="{{ $transactions->lama_peminjaman }} hari" disabled>
                                </div>
                            </div>
                            <div class="row gx-3 mb-3">
                                <!-- Form Group (first name)-->
                                <div class="col-md-4">
                                    <label class="small mb-1" for="inputName">Tanggal Peminjaman</label>
                                    <input class="form-control" id="inputName" type="date"
                                        value="{{ $transactions->hari_ambil }}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="inputName">Tanggal Pengembalian</label>
                                    <input class="form-control" id="inputName" type="date"
                                        value="{{ $transactions->hari_kembali }}" disabled>
                                </div>
                                <div class="col-md-4">
                                    <label class="small mb-1" for="inputName">Lama Peminjaman</label>
                                    <input class="form-control" id="inputName" type="text"
                                        value="{{ $transactions->lama_peminjaman }} hari" disabled>
                                </div>
                            </div>
                                {{-- <div class="mb-1">
                                    <label class="small mb-1" for="inputUsername">Username</label>
                                    <input class="form-control" id="inputUsername" type="text"
                                        placeholder="Enter your username" value="{{ $user->username }}" name="username">
                                </div>
                                <!-- Form Group (email address)-->
                                <div class="mb-1">
                                    <label class="small mb-1" for="inputEmailAddress">Email address</label>
                                    <input class="form-control" id="inputEmailAddress" type="email"
                                        placeholder="Enter your email address" value="{{ $user->email }}" name="email">
                                </div>
                                <!-- Form Row-->
                                <div class="mb-3">
                                    <label class="small mb-1" for="inputPhone">Phone number</label>
                                    <input class="form-control" id="inputPhone" type="tel"
                                        placeholder="Enter your phone number" value="{{ $user->no_hp }}" name="no_hp">
                                </div>
                                <!-- Save changes button-->
                                <button class="btn btn-primary" type="submit">Save changes</button>
                                <br></br>
                                <!-- Change Password-->
                                <div class="col-md-6">
                                    <p><a href="/password">Change Password?</a></p>
                                </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </div>
