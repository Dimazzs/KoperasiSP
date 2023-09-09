
@extends('admin.layouts.master')
@section('content')  
<div class="container-fluid">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Simpanan Wajib</h4>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <tbody>
                                <tr>
                                 
                                    <th>Tanggal</th>
                                    <th>Jumlah</th>
                                </tr>
                                @foreach ($simpananWajibs as $simpananWajib)
                              
                                <tr>
                                    <td>{{ $simpananWajib->tanggal }}</td>
                               
                                    <td>Rp{{ number_format($simpananWajib->jumlah, 0, ',', '.') }}</td>
                                </tr>
                                @endforeach
                                <tr>
                                    <th>Total Simpanan Wajib</th>
                                    <td>Rp{{ number_format($totalSimpananWajib, 0, ',', '.') }}</td>
                                </tr>
                                <tr>
                                    <th>SHU</th>
                                    
                                    <td>Rp{{ number_format($shu, 0, ',', '.')}}</td>
                                </tr>
                                
                                
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection