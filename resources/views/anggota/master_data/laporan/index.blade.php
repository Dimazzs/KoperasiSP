@extends('anggota.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Pinjaman</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Anggota</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Pinjaman</th>
                                    <th>Tenor</th>
                                    <th>Sisa Pembayaran</th>
                                    <th>Status</th>
                                    <th>Angsuran</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $index => $pinjaman)
                                <tr>
                                    <td>{{ $index + 1 }}</td>
                                    <td>{{ $pinjaman->anggota->user->name }}</td>
                                    <td>{{ $pinjaman->nama_barang }}</td>
                                    <td>Rp {{ number_format($pinjaman->jumlah_pinjaman, 0, ',', '.') }}</td>
                                    <td>{{ $pinjaman->tenor }} Bulan</td>
                                    <td>
                                        @php
                                            $total_pembayaran = $pinjaman->pembayaran->sum('jumlah_pembayaran');
                                            $sisa_pembayaran = $pinjaman->jumlah_pinjaman - $total_pembayaran;
                                        @endphp
                                        Rp{{ number_format($sisa_pembayaran, 0, ',', '.') }}
                                    </td>
                                    <td>
                                        {{ ($sisa_pembayaran <= 0) ? 'Lunas' : 'Belum Lunas' }}
                                    </td>
                                    <td>
                                        @php
                                            // Menghitung Bayaran per Bulan
                                            $bayaran_per_bulan = ($pinjaman->tenor > 0) ? ($sisa_pembayaran / $pinjaman->tenor) : 0;
                                        @endphp
                                        Rp{{ number_format($bayaran_per_bulan, 2, ',', '.') }}
                                    </td>
                                    <td>
                                        @if($pinjaman->pembayaran->isEmpty())
                                        
                                            <a class="btn btn-warning btn-sm" href="{{ route('pembayaran.no_pembayaran', $pinjaman->id) }}">Detail</a>
                                       
                                    @else
                                       
                                            <a class="btn btn-warning btn-sm" href="{{ route('pembayaran.detailA', $pinjaman->id) }}">Detail</a>
                                        
                                    @endif
                                        
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
