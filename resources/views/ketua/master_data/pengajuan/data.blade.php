
{{-- {{ json_encode($data) }} --}}
{{-- @extends('ketua.layouts.master')
@section('content')  
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
                        <form class="form-valide">
                      
                        <table class="table table-striped table-bordered zero-configuration">
                          
                            <thead>
                                <tr><th>#</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Pinjaman</th>
                                    <th>Tenor</th>
                                    <th>status</th>
                                    
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($pengajuan as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->anggota->user->name }}</td>
                                    <td>{{ $item->anggota->nik }}</td>
                                    <td>{{ $item->nama_barang }}</td>
                                    <td>{{ $item->jumlah_pinjaman }}</td>
                                    <td>{{ $item->tenor }}</td>
                                    <td>{{ $item->status }}</td>
                                   
                                </tr>
                                @endforeach
                                
                  
                            </tbody>
                        </table>
                       
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection --}}
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
                    <h4 class="card-title">Data Table</h4>
                    <div class="table-responsive">
                        <form action="{{ route('pinjamank') }}" method="GET">
                            <div class="input-group">
                                <input type="text" class="form-control" name="search" placeholder="Cari...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-primary">Cari</button>
                                </div>
                            </div>
                        </form>
                        <form class="form-valide" >
                      
                        <table class="table table-striped table-bordered zero-configuration">
                          
                            <thead>
                                <tr><th>#</th>
                                    <th>Nama</th>
                                    <th>NIK</th>
                                    <th>Nama Barang</th>
                                    <th>Jumlah Pinjaman</th>
                                    <th>tenor</th>
                                    <th>status</th>
                                    <th>Sisa yang harus di bayar</th>
                                    <th>Aksi</th>
                                    
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($pengajuan as $item)
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
                                        @if($item->pembayaran->isEmpty())
                                        
                                            <a class="btn btn-warning btn-sm" href="{{ route('pembayaran.no_payments', $item->id) }}">Detail</a>
                                       
                                    @else
                                       
                                            <a class="btn btn-warning btn-sm" href="{{ route('pembayaran.details', $item->id) }}">Detail</a>
                                        
                                    @endif
                                        
                                    </td>
                                </tr>
                            @endforeach
                                
                  
                            </tbody>
                        </table>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection