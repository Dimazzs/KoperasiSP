<!-- resources/views/admin/master_data/simpanan/index.blade.php -->

@extends('admin.layouts.master')

@section('content')
    <div class="page-wrapper">
        <div class="container-fluid">
            <div class="page-header">
                <div class="row">
                    <div class="col">
                        <ul class="breadcrumb">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Daftar Anggota</li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title mb-0">Laporan Simpanan Sukarela</h4>
                            <a href="{{ route('cetak.laporan') }}">Cetak Laporan</a>
                        </div>
                        
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">NIK</th>
                                            <th scope="col">Nama</th>
                                            <th scope="col">Saldo Simpanan</th>
                                            <!-- Tambahkan kolom lain sesuai dengan kebutuhan -->
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $anggota)
                                            <tr>
                                                <td>{{ $anggota->nik }}</td>
                                                <td>{{ $anggota->user->name }}</td>
                                                <td>Rp {{ number_format($saldoSimpananPerAnggota[$anggota->id], 0, ',', '.') }}</td>
                                                <!-- Tambahkan kolom lain sesuai dengan kebutuhan -->
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer">
                            <div class="d-flex justify-content-center">
                                {{ $data->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
