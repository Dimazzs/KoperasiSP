
@extends('anggota.layouts.master')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Laporan simpanan</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <h3>Data Pinjaman Anggota {{ auth()->user()->name }}</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Nama Barang</th>
                                            <th>Jumlah Pinjaman</th>
                                            <th>Tenor</th>
                                            <th>Status</th>
                                            <th>Total Pembayaran</th>
                                            <th>Sisa Pembayaran</th>
                                            <th>SHU</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>1</td>
                                            <td>{{ $pengajuan->nama_barang }}</td>
                                            <td>Rp{{ number_format($pengajuan->jumlah_pinjaman, 0, ',', '.') }}</td>
                                            <td>{{ $pengajuan->tenor }}</td>
                                            <td>{{ $isLunas ? 'Lunas' : 'Belum Lunas' }}</td>
                                            <td>Rp{{ number_format($totalPembayaran, 0, ',', '.') }}</td>
                                            <td>Rp{{ number_format($sisaPembayaran, 0, ',', '.') }}</td>
                                            <td>Rp{{ number_format($shu, 0, ',', '.') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            
                                <h3>Riwayat Pembayaran</h3>
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Jumlah Pembayaran</th>
                                            <th>Tanggal Pembayaran</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($riwayatPembayaran as $pembayaranDetail)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $pembayaranDetail->jumlah_pembayaran }}</td>
                                            <td>{{ $pembayaranDetail->tanggal_pembayaran }}</td>
                                        </tr>
                                        @endforeach
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
