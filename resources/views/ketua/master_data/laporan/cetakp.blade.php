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
                            <p>Laporan dibuat dari {{ $startDate }} hingga {{ $endDate }}</p>
                            <h4 class="card-title">Laporan Simpanan Wajib</h4>
    
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Nama</th>
                                        <th>NIK</th>
                                        <th>Nama Barang</th>
                                        <th>Jumlah Pinjaman</th>
                                        <th>Tenor</th>
                                        <th>Status</th>
                                        <th>Sisa yang harus dibayar</th>
                                        <th>Status Pembayaran</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data as $item)
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
                                                {{ ($sisa_pembayaran <= 0) ? 'Lunas' : 'Belum Lunas' }}
                                            </td>
                                        </tr>
                                    @endforeach
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
