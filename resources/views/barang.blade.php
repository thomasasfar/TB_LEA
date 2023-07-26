@extends('template')

@section('title')
    Barang
@endsection

@section('konten')
@include('header')
    <main class="container">

        <h1 class="text-center mb-4">List Barang</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $m)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $m->kode }}</td>
                        <td>{{ $m->nama_barang }}</td>
                        <td>{{ $m->status }}</td>
                        @if(Auth::user()->role == 'admin')
                        <td>
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-danger" data-bs-toggle="modal"
                                data-bs-target="#modalHapusBarang{{ $m->id }}">
                                <i class="bi bi-trash">Hapus</i>
                            </button>

                            <!-- Modal -->
                            <div class="modal fade" id="modalHapusBarang{{ $m->id }}" tabindex="-1"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h1 class="modal-title fs-5" id="exampleModalLabel">Apakah anda yakin ingin
                                                menghapus data {{ $m->kode }}?</h1>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary"
                                                data-bs-dismiss="modal">Batal</button>
                                            <form action="barang/{{ $m->id }}/hapus" method="post">
                                                @method('delete')
                                                @csrf
                                                <button type="submit" class="btn btn-danger">Hapus</button>
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
                                            <form method="post" action="/barang/{{ $m->id }}/update">
                                                @csrf
                                                @method('put')
                                                <div class="mb-3">
                                                    <label for="InputKode" class="form-label">Kode</label>
                                                    <input value="{{ $m->kode }}" type="text" class="form-control" id="InputKode"
                                                        aria-describedby="emailHelp" name="kode">
                                                </div>
                                                <div class="mb-3">
                                                    <label value="{{ $m->nama_barang }}" for="InputNama" class="form-label">Nama</label>
                                                    <input type="text" class="form-control" id="InputNama"
                                                        name="nama_barang">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="InputStatus">Status</label>
                                                    <select value="{{ $m->status }}" class="form-select" id="status"
                                                        aria-label="Default select example" name="status">
                                                        <option selected>Pilih</option>
                                                        <option value="Tersedia">Tersedia</option>
                                                        <option value="Tidak Ters">Tidak Tersedia</option>
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
                        @endif
                    </tr>
                @endforeach
            </tbody>
        </table>

        @if(Auth::user()->role == 'admin')
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalTambahBarang">
            Tambah Barang
        </button>


        <!-- Modal -->
        <div class="modal fade" id="modalTambahBarang" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Tambah Barang</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form method="post" action="/barang/tambah">
                            @csrf
                            <div class="mb-3">
                                <label for="InputKode" class="form-label">Kode</label>
                                <input type="text" class="form-control" id="InputKode" aria-describedby="emailHelp"
                                    name="kode">
                            </div>
                            <div class="mb-3">
                                <label for="InputNama" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="InputNama" name="nama_barang">
                            </div>
                            <div class="mb-3">
                                <label for="InputNama" class="form-label">Harga</label>
                                <input type="text" class="form-control" id="InputNama" name="harga">
                            </div>
                            <div class="mb-3">
                                <label for="InputStatus">Status</label>
                                <select class="form-select" id="status" aria-label="Default select example"
                                    name="status">
                                    <option selected>Pilih</option>
                                    <option value="Tersedia">Tersedia</option>
                                    <option value="Tidak tersedia">Tidak Tersedia</option>
                                </select>
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
        @endif

    </main>
@endsection
