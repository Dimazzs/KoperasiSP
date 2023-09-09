@extends('admin.layouts.master')

@section('content') 
<div class="container">
    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
@endif
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h4>Tambah Simpanan Wajib</h4>
                </div>
                <div class="card-body">
                    <form action="{{ route('simpananwajib.store') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="anggota_id">Anggota</label>
                            <input type="number" class="form-control" id="anggota_id" name="anggota_id" placeholder="Masukkan Nomer Anggota">
                        </div>
                        <div class="form-group">
                            <label for="tanggal">Tanggal</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal">
                        </div>
                        <div class="form-group">
                            <label for="jumlah">Jumlah</label>
                            <input type="number" class="form-control" id="jumlah" name="jumlah">
                        </div>
                        <button type="submit" class="btn btn-primary">Tambah Simpanan Wajib</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
