
@extends('anggota.layouts.master')
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
                    {{-- <h4 class="card-title">Table Simpanan</h4>
                    <div class="table-responsive">
                        <form class="form-valide" >
                      
                        <table class="table table-striped table-bordered zero-configuration">
                            <div class="card-header">
                                Nama Anggota: {{ $anggota->user->name }}
                            </div>
                            <thead>
                                <tr>
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                    
                                </tr>
                            </thead>
                            <tbody> 
                                @foreach ($simpanan as $s)
                                <tr>
                                    <td>{{ $s->tanggal }}</td>
                                    <td>{{ $s->jumlah }}</td>
                                   
                                </tr>
                            @endforeach
                            <tr>
                                <th>Jumlah Total</th>
                            <td>{{ $totalSimpanan }}</td>
                        </tr>
                  
                            </tbody>
                        </table>
                        </form>
                    </div> --}}
                    <h4 class="card-title">Table Simpanan</h4>
<div class="table-responsive">
    <form class="form-valide">
        <table class="table table-striped table-bordered zero-configuration">
            <div class="card-header">
                Nama Anggota: {{ $anggota->user->name }}
            </div>
            <thead>
                <tr>
                    <th>Tanggal</th>
                    <th>Jumlah</th>
                </tr>
            </thead>
            <tbody> 
                @foreach ($simpanan as $s)
                <tr>
                    <td>{{ $s->tanggal }}</td>
                    <td>Rp{{ number_format($s->jumlah, 0, ',', '.') }}</td>
                </tr>
                @endforeach
                <tr>
                    <th>Jumlah Total Simpanan</th>
                    <td>Rp{{ number_format($totalSimpanan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Jumlah Total Penarikan</th>
                    <td>Rp{{ number_format($totalPenarikan, 0, ',', '.') }}</td>
                </tr>
                <tr>
                    <th>Saldo Simpanan</th>
                    <td>Rp{{ number_format($saldoSimpanan, 0, ',', '.') }}</td>
                </tr>
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