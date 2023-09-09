@extends('anggota.layouts.master')
@section('content')    

    <div class="row">
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-1">
                <div class="card-body">
                    <h3 class="card-title text-white">Saldo Simpanan</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">Rp{{ number_format($saldoSimpanan, 0, ',', '.') }}</h2>
                        <p class="text-white mb-0"></p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-2">
                <div class="card-body">
                    <h3 class="card-title text-white">Simpanan Wajib</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">Rp{{ number_format($totalSimpananWajib, 0, ',', '.') }}</h2>
                        <p class="text-white mb-0"></p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>
        
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-3">
                <div class="card-body">
                    <h3 class="card-title text-white">Simpanan Koperasi</h3>
                    <div class="d-inline-block">
                        <h2 class="text-white">Rp{{  number_format($totalSimpananAnggota, 0, ',', '.') }}</h2>
                        <p class="text-white mb-0"></p>
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>
        <div class="col-lg-3 col-sm-6">
            <div class="card gradient-4">
                <div class="card-body">
                    <h3 class="card-title text-white">SHU Koperasi</h3>
                    <div class="d-inline-block">
                        @foreach ($shus as $shu)
                        <h4 class="text-white">Rp{{number_format ($shu->jumlah_shu, 0, ',', '.') }}</h4>
                        <p class="text-white mb-0">{{ $shu->updated_at->format('F-Y-m-d') }}</p>
                        @endforeach
                    </div>
                    <span class="float-right display-5 opacity-5"><i class="fa fa-money"></i></span>
                </div>
            </div>
        </div>
 
    </div>

    

    


@endsection