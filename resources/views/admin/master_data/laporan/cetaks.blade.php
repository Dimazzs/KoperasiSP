<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container-fluid {
            padding: 20px;
        }

        .card {
            border: 1px solid #ddd;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .card-body {
            padding: 20px;
        }

        .card-title {
            margin-bottom: 20px;
        }

        .table {
            width: 100%;
            border-collapse: collapse;
        }

        .table th, .table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        .table th {
            background-color: #f5f5f5;
        }

        .text-center {
            text-align: center;
        }

        .alert {
            padding: 10px;
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if (session('message'))
                        <p class="alert alert-success">{{ session('message') }}</p>
                    @endif
                    <h4 class="card-title">Tabel Simpanan</h4>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered zero-configuration">
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
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="text-center">
    <p><strong>Nama Anggota:</strong> {{ $anggota->user->name }}</p>
</div>
<script>
    // Fungsi untuk mencetak halaman secara otomatis
    function printPage() {
        window.print(); // Mencetak halaman
        setTimeout(function() {
            window.close(); // Menutup jendela cetak setelah pencetakan selesai (opsional)
        }, 1000);
    }

    // Memanggil fungsi cetak ketika halaman selesai dimuat
    window.onload = function() {
        printPage();
    };
</script>
</body>
</html>
