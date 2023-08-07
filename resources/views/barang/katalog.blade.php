@extends('template')

@section('title')
    Barang
@endsection

@section('konten')
    @include('header')

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container py-5">
        <div class="row">
            @foreach ($barang as $m)
                <div class="col-md-12 col-lg-4 mb-4 mb-lg-0">
                    <div class="card my-3 h-80">
                        @if ($m->image != '')
                            <img src="{{ asset('storage/image/' . $m->image) }}" alt="Gambar Barang" class="card-img-top"
                                style="height: 240px">
                        @else
                            <!-- Tampilkan gambar placeholder jika tidak ada gambar yang diunggah -->
                            <img src="{{ asset('storage/uploads/Sepatu-1691163151.png') }}" alt="Gambar Placeholder"
                                style="max-width: 100px;">
                        @endif
                        <div class="card-body">
                            <div class="d-flex justify-content-between mb-2">
                                <h5 class="mb-0">{{ $m->nama_barang }}</h5>
                                <h5 class="text-dark mb-0 card-text" style="text-align: right">Rp{{ $m->harga }}</h5>
                            </div>

                            <div class="d-flex justify-content-between mb-2">
                                <div class="ms-auto text-primary">
                                    <i>/hari</i>
                                </div>
                            </div>


                            @if ($m->status == 'Tidak Tersedia')
                                <div class="d-flex justify-content-between mb-2">
                                    <button
                                        class="d-grid gap-2 col-6 d-md-block btn btn-secondary mx-auto float-end disabled">Sewa</button>
                                </div>
                            @elseif ($m->status == 'Tersedia')
                                <div class="d-flex justify-content-between mb-2">
                                    <a href="{{ route('order.showItem', $m->id) }}" type="button"
                                        class="d-grid gap-2 col-6 d-md-block btn btn-primary mx-auto float-end">Sewa</a>
                                </div>
                            @endif


                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
