@extends('ketua.layouts.master')
@section('content')  
{{-- {{ json_encode($data) }} --}}
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (session('message'))
                            <p class="alert alert-success"> {{ session('message') }}</p>
                        @endif
                    <h4 class="card-title">Data Simpanan</h4>
                    <div class="table-responsive">
                        <form action="{{ route('simpanank') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="cari" placeholder="ketikan nama" value="{{ $request->cari }}">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">cari</button>
                                </div>
                            </div>
                        </form>
                        <form class="form-valide" >
                      
                        <table class="table table-striped table-bordered zero-configuration">
                          
                            <thead>
                                <tr><th>NO Anggota</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Alamat Kegiatan</th>
                                    <th>email</th>
                                    <th>Divisi</th>
                                    <th>Aksi</th>
                                    
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($data as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->user->name }}</td>
                                    <td>{{ $item->nik }}</td>
                                    <td>{{ $item->alamat }}</td>
                                    <td>{{ $item->user->email }}</td>
                                    <td>{{ $item->user->role }}</td>
                                    
                                    <td>
                                        <a class="btn btn-warning btn-sm" href="{{ route('simpanan.details', $item->id) }}">Simpanan</a>
                                        <a class="btn btn-secondary btn-sm" href="{{ route('simpananwajib.details', $item->id) }}">Simpanan Wajib</a>
                                       
                                    </td>
                                </tr>
                                @endforeach
                                
                  
                            </tbody>
                           
                        </table>
                        {{ $data->links() }}
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection