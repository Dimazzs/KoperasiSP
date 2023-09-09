@extends('admin.layouts.master')

@section('content')
<div class="page-content-wrapper">
    <div class="container-fluid">
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Pembayaran Pinjaman</h4>
                        <form action="{{ route('pembayaran.process') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="pengajuan_pinjaman_id">Pilih Pengajuan Pinjaman:</label>
                                <select name="pengajuan_pinjaman_id" class="form-control">
                                    @foreach ($pengajuan as $item)
                                        @php
                                            $total_pembayaran = $item->pembayaran->sum('jumlah_pembayaran');
                                            $sisa_pembayaran = $item->jumlah_pinjaman - $total_pembayaran;
                                        @endphp
                                        @if ($item->status == 'terima' && $sisa_pembayaran > 0)
                                            <option value="{{ $item->id }}">{{ $item->nama_barang }} - {{ $item->anggota->user->name }}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="jumlah_pembayaran">Jumlah Pembayaran:</label>
                                <input type="number" name="jumlah_pembayaran" class="form-control" min="1" step="0.01" required>
                            </div>
                            <div class="form-group">
                                <label for="tanggal_pembayaran">Tanggal Pembayaran:</label>
                                <input type="date" name="tanggal_pembayaran" class="form-control" required>
                            </div>
                            <button type="submit" class="btn btn-primary">Bayar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
