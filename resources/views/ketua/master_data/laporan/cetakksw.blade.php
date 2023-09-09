<!DOCTYPE html>
<html>
<head>
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .page-content-wrapper {
            text-align: center; /* Penempatan konten ke tengah */
            margin-top: 50px; /* Margin atas agar tidak terlalu dekat dengan header */
        }
        .header {
            text-align: center; /* Penempatan teks di tengah */
        }
        .footer {
            text-align: center; /* Penempatan teks di tengah */
            margin-top: 20px; /* Margin atas agar tidak terlalu dekat dengan footer */
        }
        .hr-divider {
            border: none;
            border-top: 2px solid #333; /* Warna dan ketebalan garis pemisah */
            margin: 20px auto; /* Margin atas dan bawah untuk garis pemisah */
            width: 50%; /* Lebar garis pemisah */
        }
    </style>
</head>
<body>
    <div class="page-content-wrapper">
        <div class="container-fluid">
            
            
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="header">
                                <h2>Koperasi Wanita Jasmine Sejahtera</h2>
                                <p>Jalan Bunga Raya Taman Ciruas Permai, Ciruas, Pelawad, </p>
                            </div>
                            
                            <hr class="hr-divider"> <!-- Garis pemisah -->
                            
                            <h4 class="card-title">Laporan Simpanan Wajib</h4>
                            <p>Periode: {{ $tanggalAwal }} - {{ $tanggalAkhir }}</p>
    
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Nama Anggota</th>
                                        <th>Jumlah Simpanan</th>
                                        <th>Tanggal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($simpananWajib as $index => $simpanan)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $simpanan->anggota->user->name }}</td>
                                            <td>Rp{{ number_format($simpanan->jumlah, 0, ',', '.') }}</td>
                                            <td>{{ $simpanan->tanggal }}</td>
                                        </tr>
                                    @endforeach
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
