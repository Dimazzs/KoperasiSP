@extends('ketua.layouts.master')
@section('content') 
<div class="container">
    <h1>Edit Pengajuan Pinjaman</h1>
    <form method="POST" action="{{ route('update.pengajuan', $pengajuan->id) }}">
        @csrf

        <div class="form-group">
            <label for="nama_barang">Nama Barang:</label>
            <input type="text" name="nama_barang" id="nama_barang" class="form-control" value="{{ $pengajuan->nama_barang }}">
        </div>

        <div class="form-group">
            <label for="jumlah_pinjaman">Jumlah Pinjaman:</label>
            <input type="number" name="jumlah_pinjaman" id="jumlah_pinjaman" class="form-control" value="{{ $pengajuan->jumlah_pinjaman }}">
        </div>

        <div class="form-group">
            <label for="tenor">Tenor:</label>
            <input type="number" name="tenor" id="tenor" class="form-control" value="{{ $pengajuan->tenor }}">
        </div>

        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection