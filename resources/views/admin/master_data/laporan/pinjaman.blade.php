@extends('admin.layouts.master')
@section('content')  
{{-- {{ json_encode($data) }} --}}
<div class="page-wrapper">
    <div class="container-fluid">
        
        @if (session('message'))
            <div class="row">
                <div class="col">
                    <p class="alert alert-success">{{ session('message') }}</p>
                </div>
            </div>
        @endif

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Data Table</h4>
                        <div class="table-responsive">
                            {{-- <a href="{{ route('laporan.cetakp') }}" class="btn btn-info">
                                <i data-feather="printer"></i> Cetak Laporan
                            </a> --}}
                        <form action="{{ route('laporan.generatepinjaman') }}" method="post">
                         @csrf
                            <div class="form-group">
                                 <label for="start_date">Tanggal Awal:</label>
                                 <input type="date" name="start_date" id="start_date" >
                            </div>
                            <div class="form-group">
                                 <label for="end_date">Tanggal Akhir:</label>
                                 <input type="date" name="end_date" id="end_date" >
                            </div>
                            <button type="submit"  class="btn btn-primary fa fa-print">Buat Laporan</button>
                        </form>

                            <table class="table table-striped table-bordered zero-configuration">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Pinjaman</th>
                                        <th>Tenor</th>
                                        <th>Status</th>
                                        <th>Sisa yang harus dibayar</th>
                                        <th>Status Pembayaran</th>
                                        <th>Bayaran Perbulan</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->anggota->user->name }}</td>
                                            <td>{{ $item->anggota->nik }}</td>
                                            <td>{{ $item->nama_barang }}</td>
                                            <td>Rp{{ number_format($item->jumlah_pinjaman, 0, ',', '.') }}</td>
                                            <td>{{ $item->tenor }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>
                                                @php
                                                    $total_pembayaran = $item->pembayaran->sum('jumlah_pembayaran');
                                                    $sisa_pembayaran = $item->jumlah_pinjaman - $total_pembayaran;
                                                @endphp
                                                Rp{{ number_format($sisa_pembayaran, 0, ',', '.') }}
                                            </td>
                                            <td>
                                                {{ ($sisa_pembayaran <= 0) ? 'Lunas' : 'Belum Lunas' }}
                                            </td>
                                            <td>
                                                @php
                                                    // Menghitung Bayaran per Bulan
                                                    $bayaran_per_bulan = ($item->tenor > 0) ? ($sisa_pembayaran / $item->tenor) : 0;
                                                @endphp
                                                Rp{{ number_format($bayaran_per_bulan, 2, ',', '.') }}
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
</div>
@endsection