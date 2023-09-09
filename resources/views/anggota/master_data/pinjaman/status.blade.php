<!-- resources/views/pengajuan/detail.blade.php -->

@extends('anggota.layouts.master')

@section('content')
<div class="container">
    <h1>Status Pengajuan Pinjaman</h1>
    @foreach ($pengajuan as $item)
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $item->nama_barang }}</h5>
                <p class="card-text">Jumlah Pinjaman: Rp{{ number_format($item->jumlah_pinjaman, 0, ',', '.') }}</p>
                <p class="card-text">Tenor: {{ $item->tenor }}</p>
                <p class="card-text">Status: 
                    @if ($item->status === 'proses')
                        Proses
                    @elseif ($item->status === 'terima')
                        Diterima
                    @elseif ($item->status === 'ditolak')
                        Ditolak
                    @endif
                    <p class="card-text">Komentar: {{ $item->comment }}</p>
                </p>
                <!-- Tambahkan informasi lain yang ingin ditampilkan, sesuai kebutuhan Anda -->
            </div>
        </div>
    @endforeach
</div>
@endsection
