@extends('template')

@section('title')
    Barang
@endsection

@section('konten')
    @include('header')
    <main class="container">


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

        <h1 class="text-center mb-4">List Barang</h1>

        @if (Auth::user()->role == 'admin')
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
                            <form method="post" action="/barang/tambah" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="InputKode" class="form-label">Kode</label>
                                    <input type="text" class="form-control" id="InputKode" aria-describedby="emailHelp"
                                        name="kode">
                                </div>
                                <div class="mb-3">
                                    <label for="InputGambar" class="form-label">Gambar</label>
                                    <input type="file" class="form-control" id="InputGambar" name="image">
                                </div>
                                <div class="mb-3">
                                    <label for="InputNama" class="form-label">Nama</label>
                                    <input type="text" class="form-control" id="InputNama" name="nama_barang">
                                </div>
                                <div class="mb-3">
                                    <label for="InputNama" class="form-label">Harga</label>
                                    <input type="text" class="form-control" id="InputHarga" name="harga">
                                </div>
                                <div class="mb-3">
                                    <label for="InputStatus">Status</label>
                                    <select class="form-select" id="status" aria-label="Default select example"
                                        name="status">
                                        <option selected>Pilih</option>
                                        <option value="Tersedia">Tersedia</option>
                                        <option value="Tidak Tersedia">Tidak Tersedia</option>
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


        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Kode</th>
                    <th scope="col">Gambar</th>
                    <th scope="col">Nama</th>
                    <th scope="col">Harga</th>
                    <th scope="col">Status</th>
                    <th scope="col">Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($barang as $m)
                    <tr>
                        <th scope="row">{{ $loop->iteration }}</th>
                        <td>{{ $m->kode }}</td>
                        <td>
                            @if ($m->image != '')
                                <img src="{{ asset('storage/image/' . $m->image) }}" alt="Gambar Barang"
                                    style="max-width: 200px;">
                            @else
                                <!-- Tampilkan gambar placeholder jika tidak ada gambar yang diunggah -->
                                <img src="{{ asset('storage/uploads/Sepatu-1691163151.png') }}"
                                    alt="Gambar Placeholder" style="max-width: 100px;">
                            @endif
                        </td>
                        <td>{{ $m->nama_barang }}</td>
                        <td>Rp{{ $m->harga }}</td>
                        <td>{{ $m->status }}</td>
                        @if (Auth::user()->role == 'admin')
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
                                                <form method="post" action="/barang/{{ $m->id }}/update"
                                                    enctype="multipart/form-data">
                                                    @csrf
                                                    @method('put')
                                                    <div class="mb-3">
                                                        <label for="InputKode" class="form-label">Kode</label>
                                                        <input value="{{ $m->kode }}" type="text"
                                                            class="form-control" id="InputKode"
                                                            aria-describedby="emailHelp" name="kode">
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
                                                            <option value="Tersedia" {{ $m->status == 'Tersedia' ? 'selected' : '' }}>Tersedia</option>
                                                            <option value="Tidak Tersedia" {{ $m->status == 'Tidak Tersedia' ? 'selected' : '' }}>Tidak Tersedia</option>
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
    </main>
@endsection
