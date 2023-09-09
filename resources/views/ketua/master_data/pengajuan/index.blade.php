@extends('ketua.layouts.master')
@section('content')       
    <div class="container">
        <h1 class="page-title">Daftar Pengajuan Pinjaman</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        <div class="table-responsive">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama</th>
                        <th>Nama Barang</th>
                        <th>Jumlah Pinjaman</th>
                        <th>Tenor</th>
                        <th>Keterangan</th>
                        <th>Status</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($pengajuan as $key => $item)
                        <tr>
                            <td>{{ $key + 1 }}</td>
                            <td>{{ $item->anggota->user->name }}</td>
                            <td>{{ $item->nama_barang }}</td>
                            <td>Rp{{ number_format($item->jumlah_pinjaman, 0, ',', '.') }}</td>
                            <td>{{ $item->tenor }}</td>
                            <td>{{ $item->comment }}</td>
                            <td>
                                @if ($item->status === 'proses')
                                    <span class="badge badge-secondary">Pengajuan</span>
                                @elseif ($item->status === 'terima')
                                    <span class="badge badge-success">Diterima</span>
                                @elseif ($item->status === 'ditolak')
                                    <span class="badge badge-warning">Ditolak</span>
                                @endif
                            </td>
                            <td>
                                <div class="btn-group">
                                    <a class="btn btn-primary btn-sm" href="{{ route('pengajuan.editComment', $item->id) }}"><i class="fa fa-comment"></i></a>
                                    @if ($item->status === 'proses')
                                    <a class="btn btn-secondary btn-sm" href="{{ route('edit.pengajuan', $item->id) }}"><i class="fa fa-edit"></i></a>
                                        <form action="{{ route('pengajuan.verify', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="terima">
                                            <button type="submit" class="btn btn-success btn-sm"><i class="fa fa-check"></i></button>
                                        </form>
                                        <form action="{{ route('pengajuan.verify', $item->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <input type="hidden" name="status" value="ditolak">
                                            <button type="submit" class="btn btn-warning btn-sm" onclick="return confirm('Apakah Anda yakin ingin menolak pengajuan ini?')"><i class="fa fa-times"></i></button>
                                        </form>
                                        <form action="{{ route('pengajuan.destroy', $item->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Apakah Anda yakin ingin menghapus pengajuan ini?')"><i class="fa fa-trash"></i></button>
                                        </form>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
