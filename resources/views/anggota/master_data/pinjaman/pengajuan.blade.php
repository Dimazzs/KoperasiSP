@extends('anggota.layouts.master')
@section('content') 
<div class="container">
    @if (session('message'))
    <p class="alert alert-success"> {{ session('message') }}</p>
@endif
    <h1>Formulir Pengajuan Pinjaman</h1>
    <form method="POST" action="{{ route('pengajuan.store') }}">
        @csrf

        <div class="form-group">
            <label for="nama_barang">Nama Barang:</label>
            <input type="text" name="nama_barang" id="nama_barang" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="jumlah_pinjaman">Jumlah Pinjaman:</label>
            <input type="number" name="jumlah_pinjaman" id="jumlah_pinjaman" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="tenor">Tenor:</label>
            <input type="number" name="tenor" id="tenor" class="form-control" required>
        </div>
        @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection