@extends('template')

@section('title')
    Profile
@endsection

@section('konten')
@include('header')


  <div class="container mt-4">
    <div class="row">
      <!-- Bagian Foto Profil -->
      <div class="col-md-4">
        <img src="path/to/your/profile_picture.jpg" alt="Foto Profil" class="img-fluid rounded-circle mb-3">
        <h4>Nama Pengguna</h4>
        <p>Email: user@example.com</p>
      </div>

      <!-- Bagian Informasi Pengguna -->
      <div class="col-md-8">
        <h3>Informasi Pengguna</h3>
        <ul class="list-group">
          <li class="list-group-item">Nama Lengkap: John Doe</li>
          <li class="list-group-item">Tanggal Lahir: 12 Januari 1990</li>
          <li class="list-group-item">Alamat: Jalan Jenderal Sudirman No. 123, Jakarta</li>
          <li class="list-group-item">Nomor Telepon: +62 123 4567 890</li>
        </ul>
      </div>
    </div>

    <!-- Bagian Daftar Peminjaman atau Aktivitas Lainnya -->
    <div class="row mt-4">
      <div class="col-md-12">
        <h3>Daftar Peminjaman</h3>
        <table class="table">
          <thead>
            <tr>
              <th>#</th>
              <th>Nama Barang</th>
              <th>Tanggal Peminjaman</th>
              <th>Tanggal Pengembalian</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>1</td>
              <td>Tenda</td>
              <td>2023-07-25</td>
              <td>2023-07-28</td>
            </tr>
            <tr>
              <td>2</td>
              <td>Sleeping Bag</td>
              <td>2023-07-26</td>
              <td>2023-07-27</td>
            </tr>
            <!-- Tambahkan baris data sesuai kebutuhan -->
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <!-- Load Bootstrap JS (Popper.js and Bootstrap.js) -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.1/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

  @endsection