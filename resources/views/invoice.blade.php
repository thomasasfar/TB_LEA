@extends('template')

@section('title')
    Home
@endsection

@section('konten')
@include('header')
<div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <h1>Invoice</h1>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center">
                                    
                                </div>
                            </div>
                            <div class="col-md-6">
                                <table>
                                    <tr>
                                        <td width="30%">Peminjam</td>
                                        <td>:</td>
                                     
                                    </tr>
                                
                                    <tr>
                                        <td>No Telp</td>
                                        <td>:</td>
                                    </tr>
                                    <tr>
                                        <td>Email</td>
                                        <td>:</td>
                                      
                                    </tr>
                                </table>
                            </div>
                           
                            <div class="col-md-12 mt-3">
                             
                                @csrf
                                <table class="table table-hover table-bordered">
                                    <thead>
                                        <tr>
                                            <td>#</td>
                                            <td>Barang</td>
                                            <td>Harga</td>
                                            <td>Tanggal Peminjaman</td>
                                            <td>Tanggal Pengembalian</td>
                                            <td>Lama Peminjaman</td>
                                            <th>Total Harga</th>
                                        </tr>
                                    </thead>
                                    
                                   
                                    <!-- MENAMPILKAN PRODUK YANG TELAH DITAMBAHKAN -->
                                    
                                   
                                    <!-- FORM UNTUK MEMILIH PRODUK YANG AKAN DITAMBAHKAN -->
                                </table>
                                </form>
                            </div>
                            
                            <!-- MENAMPILKAN TOTAL & TAX -->
                            <div class="col-md-4 offset-md-8">
                                <table class="table table-hover table-bordered">
                                    <tr>
                                        <td>Sub Total</td>
                                        <td>:</td>
                                       
                                    </tr>
                                    
                                    <tr>
                                        <td>Total</td>
                                        <td>:</td>
                                     
                                    </tr>
                                </table>
                            </div>
                            <!-- MENAMPILKAN TOTAL & TAX -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection