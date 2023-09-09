@extends('admin.layouts.master')

@section('content')
<div class="page-content-wrapper">
    <div class="container-fluid">
        <h1 class="page-title">Laporan Simpanan Wajib</h1>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h4 class="card-title">Pilih Tanggal</h4>
                        <form action="{{ route('laporan.generateSimpananWajib') }}" method="post">
                            @csrf
                            <div class="form-group">
                                <label for="tanggal_awal">Tanggal Awal</label>
                                <input type="date" name="tanggal_awal" id="tanggal_awal" class="form-control" required>
                            </div>

                            <div class="form-group">
                                <label for="tanggal_akhir">Tanggal Akhir</label>
                                <input type="date" name="tanggal_akhir" id="tanggal_akhir" class="form-control" required>
                            </div>

                            <button type="submit" class="btn btn-primary">Generate Laporan</button>
                        </form>
                        <button type="button" class="btn btn-primary" id="cetakButton">Cetak Laporan</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    document.getElementById('cetakButton').addEventListener('click', function() {
        const tanggalAwal = document.getElementById('tanggal_awal').value;
        const tanggalAkhir = document.getElementById('tanggal_akhir').value;
        const cetakURL = "{{ route('laporan.cetakSimpananWajib') }}?tanggal_awal=" + tanggalAwal + "&tanggal_akhir=" + tanggalAkhir;
        window.open(cetakURL, '_blank');
    });
</script>
@endsection
