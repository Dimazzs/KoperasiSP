<!DOCTYPE html>
<html>
<head>
    <title>Laporan Simpanan</title>
    <style>
        /* Gaya tampilan cetakan */
        body {
            font-family: Arial, sans-serif;
        }
        h5 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        .header {
            text-align: center; /* Penempatan teks di tengah */
        }
        .footer {
            text-align: center; /* Penempatan teks di tengah */
            margin-top: 20px; /* Margin atas agar tidak terlalu dekat dengan footer */
        }
        th, td {
            border: 1px solid #000;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="header">
                        <h2>Koperasi Wanita Jasmine Sejahtera</h2>
                        <p>Jalan Bunga Raya Taman Ciruas Permai, Ciruas, Pelawad, </p>
                        
                    </div>
                        <h5>Laporan Simpanan Sukarela</h5>
                         <table>
                                <tr>
                                    <th>NIK</th>
                                    <th>Nama</th>
                                    <th>Total Simpanan</th>
                                    <th>Saldo Simpanan</th>
                                </tr>
                                @foreach ($data as $anggota)
                                    <tr>
                                        <td>{{ $anggota->nik }}</td>
                                        <td>{{ $anggota->nama }}</td>
                                        <td>{{ $totalSimpananPerAnggota[$anggota->id] }}</td>
                                        <td>{{ $saldoSimpananPerAnggota[$anggota->id] }}</td>
                                    </tr>
                                @endforeach
                         </table>
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
