@extends('template')

@section('title')
    Change Password
@endsection

@section('konten')
    @include('header')

    <form action="/password/update" method="POST">
    @csrf
    @method('PUT')
    <label for="new_password">Password Baru</label>
    <input type="password" name="new_password" required>
    <button type="submit">Ubah Password</button>
</form>




@endsection