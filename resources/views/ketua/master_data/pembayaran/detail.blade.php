@extends('ketua.layouts.master')
@section('content')

<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Detail Pembayaran Pinjaman</h4>
                </div>
                <div class="card-body">
                    @if ($pembayaran)
                        {{-- Tampilkan detail pembayaran --}}
                        <p><strong>Nama Anggota:</strong> {{ $pengajuan->anggota->user->name }}</p>
                        <p><strong>NIK:</strong> {{ $pengajuan->anggota->nik }}</p>
                        <p><strong>Nama Barang:</strong> {{ $pengajuan->nama_barang }}</p>
                        <p><strong>Jumlah Pinjaman:</strong> {{ $pengajuan->jumlah_pinjaman }}</p>
                        <p><strong>Tenor:</strong> {{ $pengajuan->tenor }}</p>
                        <p><strong>Status:</strong> {{ $pengajuan->status }}</p>
                        <p><strong>Jumlah Pembayaran:</strong> {{ $pembayaran->jumlah_pembayaran }}</p>
                        <p><strong>Tanggal Pembayaran:</strong> {{ $pembayaran->tanggal_pembayaran }}</p>

                        @if ($isLunas)
                            <p class="text-success"><strong>Status Lunas</strong></p>
                        @else
                            <p class="text-danger"><strong>Belum Lunas</strong></p>
                            <p><strong>Sisa Pembayaran:</strong> {{ $sisaPembayaran }}</p>
                        @endif

                        {{-- Tampilkan SHU hanya jika pembayaran sudah lunas --}}
                        @if ($isLunas)
                            <p><strong>SHU:</strong> Rp{{ number_format($shu, 0, ',', '.') }}</p>
                        @endif

                        <h4 class="card-title mt-4">Riwayat Pembayaran</h4>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>#</th>
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
                                </tbody>
                            </table>
                        </div>
                    @else
                        {{-- Tampilkan pesan jika belum ada pembayaran --}}
                        <p class="text-danger"><strong>Belum ada pembayaran.</strong></p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
