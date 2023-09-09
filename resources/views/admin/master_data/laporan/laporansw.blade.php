@extends('admin.layouts.master')

@section('content')
<div class="page-wrapper">
    <div class="container-fluid">
        <div class="page-header">
            <div class="row">
                <div class="col">
                    <h3 class="page-title">Hasil Laporan Simpanan Wajib</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Laporan</a></li>
                        <li class="breadcrumb-item active">Simpanan Wajib</li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped custom-table datatable">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Anggota</th>
                                        <th>Jumlah Simpanan</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($simpananWajib as $index => $simpanan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $simpanan->anggota->user->name }}</td>
                                            <td>Rp{{ number_format($simpanan->jumlah, 0, ',', '.') }}</td>
                                            <td>{{ $simpanan->tanggal }}</td>
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
