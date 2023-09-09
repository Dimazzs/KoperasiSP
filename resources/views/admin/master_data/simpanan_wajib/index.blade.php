@extends('admin.layouts.master')
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
                    <h4 class="card-title">Data Table</h4>
                    <div class="table-responsive">
                        <form class="form-valide" >
                      
                        <table class="table table-striped table-bordered zero-configuration">
                          
                            <thead>
                                <tr><th>#</th>
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
                                        <a class="btn btn-warning btn-sm" href="{{ route('simpananwajib.detail', $item->id) }}">Detail Simpanan</a>
                                       
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