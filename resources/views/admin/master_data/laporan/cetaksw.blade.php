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
    </style>
</head>
<body>
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
                                    <td>Rp{{ number_format($shu, 0, ',', '.') }}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
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
