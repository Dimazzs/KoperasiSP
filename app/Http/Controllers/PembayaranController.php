<?php

namespace App\Http\Controllers;

use App\Models\pembayaran;
use App\Models\PengajuanPinjaman;
use App\Models\Shu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PembayaranController extends Controller
{
    public function index(Request $request)
    {
        $query = PengajuanPinjaman::join('anggota', 'pengajuan_pinjaman.anggota_id', '=', 'anggota.id')
            ->join('users', 'anggota.user_id', '=', 'users.id')
            ->where('pengajuan_pinjaman.status', 'terima');

        if ($request->has('search')) {
            $searchTerm = $request->input('search');
            $query->where(function ($q) use ($searchTerm) {
                $q->where('pengajuan_pinjaman.nama_barang', 'LIKE', '%' . $searchTerm . '%')
                    ->orWhere('users.name', 'LIKE', '%' . $searchTerm . '%');
            });
        }

        $data = $query->select('pengajuan_pinjaman.*')->get();

        return view('admin.master_data.pembayaran.show', compact('data'));
    }
    public function showDetail($id)
    {
        // Cari pembayaran berdasarkan ID
        $pembayaran = Pembayaran::where('pengajuan_pinjaman_id', $id)->firstOrFail();

        // Periksa apakah pengajuan pinjaman ditemukan
        if ($pembayaran->pengajuanPinjaman) {
            // Mendapatkan objek pengajuan pinjaman dari pembayaran
            $pengajuan = $pembayaran->pengajuanPinjaman;

            // Hitung total pembayaran yang sudah dilakukan
            $totalPembayaran = $pengajuan->pembayaran->sum('jumlah_pembayaran');

            // Hitung sisa pembayaran
            $sisaPembayaran = $pengajuan->jumlah_pinjaman - $totalPembayaran;

            // Periksa apakah pinjaman sudah lunas
            $isLunas = $sisaPembayaran <= 0;

            // Hitung SHU hanya jika total pinjaman dari semua anggota tidak nol
            $totalPembayaranSemuaID = Pembayaran::sum('jumlah_pembayaran');
            $shuKoperasi = Shu::sum('jumlah_shu');

            $shu = 0; // Inisialisasi SHU dengan nilai awal 0
            if ($totalPembayaranSemuaID > 0) {
                $shu = ($totalPembayaran / $totalPembayaranSemuaID) * 0.1 *  $shuKoperasi; // 10% dari total pembayaran ID tertentu
            }

            // Mendapatkan riwayat pembayaran
            $riwayatPembayaran = $pengajuan->pembayaran;

            return view('admin.master_data.pembayaran.detail', compact('pembayaran', 'pengajuan', 'sisaPembayaran', 'shu', 'isLunas', 'riwayatPembayaran'));
        } else {
            // Jika pengajuan pinjaman tidak ditemukan, tampilkan tampilan khusus "Belum ada pembayaran"
            $pengajuan = PengajuanPinjaman::findOrFail($id);
            return view('admin.master_data.pembayaran.belumbayar');
        }
    }
    public function showNoPaymentDetail($id)
    {
        // Ambil data pengajuan berdasarkan ID yang belum lunas
        $pengajuan = PengajuanPinjaman::whereHas('pembayaran', function ($query) {
            $query->groupBy('pengajuan_pinjaman_id')
                ->havingRaw('SUM(jumlah_pembayaran) < pengajuan_pinjaman.jumlah_pinjaman');
        })->get();

        return view('admin.master_data.pembayaran.belumbayar', compact('pengajuan'));
    }
    public function bayarPinjamanForm()
    {
        // Ambil data pengajuan berdasarkan ID
        $pengajuan = PengajuanPinjaman::all();

        return view('admin.master_data.pembayaran.index', compact('pengajuan'));
    }

    public function bayarPinjamanProcess(Request $request)
    {
        // Validasi input
        $request->validate([
            'pengajuan_pinjaman_id' => 'required|exists:pengajuan_pinjaman,id',
            'jumlah_pembayaran' => 'required|numeric|min:1',
            'tanggal_pembayaran' => 'required|date',
        ]);

        // Cek apakah pengajuan pinjaman dengan ID yang diberikan ada
        $pengajuan = PengajuanPinjaman::findOrFail($request->input('pengajuan_pinjaman_id'));

        // Hitung sisa pembayaran yang harus dilakukan
        $sisaPembayaran = $pengajuan->jumlah_pinjaman - $pengajuan->pembayaran->sum('jumlah_pembayaran');

        // Ambil jumlah pembayaran yang dimasukkan
        $jumlahPembayaran = $request->input('jumlah_pembayaran');

        // Jika jumlah pembayaran melebihi sisa pinjaman, set jumlah pembayaran menjadi sisa pinjaman
        if ($jumlahPembayaran > $sisaPembayaran) {
            $jumlahPembayaran = $sisaPembayaran;
        }

        // Simpan data pembayaran pinjaman
        $pembayaran = new Pembayaran();
        $pembayaran->pengajuan_pinjaman_id = $pengajuan->id;
        $pembayaran->jumlah_pembayaran = $jumlahPembayaran;
        $pembayaran->tanggal_pembayaran = $request->input('tanggal_pembayaran');
        $pembayaran->save();

        return redirect()->route('pembayaran.form', $pengajuan->id)->with('success', 'Angsuran pinjaman berhasil.');
    }

    public function indexp()
    {
        // Get the authenticated user's ID
        $userId = Auth::id();

        // Get the pinjaman data for the authenticated user with status 'terima'
        $data = PengajuanPinjaman::where('status', 'terima')
            ->where('anggota_id', $userId)
            ->get();

        return view('anggota.master_data.laporan.index', compact('data'));
    }

    public function detailAnggota($id)
    {
        // Cari pembayaran berdasarkan ID
        $pembayaran = Pembayaran::where('pengajuan_pinjaman_id', $id)->firstOrFail();


        // Periksa apakah pengajuan pinjaman ditemukan
        if ($pembayaran->pengajuanPinjaman) {
            // Mendapatkan objek pengajuan pinjaman dari pembayaran
            $pengajuan = $pembayaran->pengajuanPinjaman;

            // Hitung total pembayaran yang sudah dilakukan
            $totalPembayaran = $pengajuan->pembayaran->sum('jumlah_pembayaran');

            // Hitung sisa pembayaran
            $sisaPembayaran = $pengajuan->jumlah_pinjaman - $totalPembayaran;

            // Periksa apakah pinjaman sudah lunas
            $isLunas = $sisaPembayaran <= 0;

            // Hitung SHU hanya jika total pinjaman dari semua anggota tidak nol
            $totalPembayaranSemuaID = Pembayaran::sum('jumlah_pembayaran');
            $shuKoperasi = Shu::sum('jumlah_shu');

            $shu = 0; // Inisialisasi SHU dengan nilai awal 0
            if ($totalPembayaranSemuaID > 0) {
                $shu = ($totalPembayaran / $totalPembayaranSemuaID) * 0.1 * $shuKoperasi; // 10% dari total pembayaran ID tertentu
            }

            // Mendapatkan riwayat pembayaran
            $riwayatPembayaran = $pengajuan->pembayaran;

            return view('anggota.master_data.laporan.detail', compact('pembayaran', 'pengajuan', 'sisaPembayaran', 'shu', 'isLunas', 'riwayatPembayaran', 'shuKoperasi', 'shuKoperasi'));
        } else {
            // Jika pengajuan pinjaman tidak ditemukan, tampilkan tampilan khusus "Belum ada pembayaran"
            $pengajuan = PengajuanPinjaman::findOrFail($id);
            return view('anggota.master_data.laporan.belumbayar');
        }
    }
    public function BlmBayar($id)
    {
        // Cari pengajuan pinjaman berdasarkan ID
        $pengajuan = PengajuanPinjaman::findOrFail($id);

        return view('anggota.master_data.laporan.belumbayar', compact('pengajuan'));
    }

    public function detailPembayaran($id)
    {
        // Cari pembayaran berdasarkan ID
        $pembayaran = Pembayaran::where('pengajuan_pinjaman_id', $id)->firstOrFail();

        // Periksa apakah pengajuan pinjaman ditemukan
        if ($pembayaran->pengajuanPinjaman) {
            // Mendapatkan objek pengajuan pinjaman dari pembayaran
            $pengajuan = $pembayaran->pengajuanPinjaman;

            // Hitung total pembayaran yang sudah dilakukan
            $totalPembayaran = $pengajuan->pembayaran->sum('jumlah_pembayaran');

            // Hitung sisa pembayaran
            $sisaPembayaran = $pengajuan->jumlah_pinjaman - $totalPembayaran;

            // Periksa apakah pinjaman sudah lunas
            $isLunas = $sisaPembayaran <= 0;

            // Hitung SHU hanya jika total pinjaman dari semua anggota tidak nol
            $totalPembayaranSemuaID = Pembayaran::sum('jumlah_pembayaran');
            $shuKoperasi = Shu::sum('jumlah_shu');

            $shu = 0; // Inisialisasi SHU dengan nilai awal 0
            if ($totalPembayaranSemuaID > 0) {
                $shu = ($totalPembayaran / $totalPembayaranSemuaID) * 0.1 * $shuKoperasi; // 10% dari total pembayaran ID tertentu
            }

            // Mendapatkan riwayat pembayaran
            $riwayatPembayaran = $pengajuan->pembayaran;

            return view('ketua.master_data.pembayaran.detail', compact('pembayaran', 'pengajuan', 'sisaPembayaran', 'shu', 'isLunas', 'riwayatPembayaran'));
        } else {
            // Jika pengajuan pinjaman tidak ditemukan, tampilkan tampilan khusus "Belum ada pembayaran"
            $pengajuan = PengajuanPinjaman::findOrFail($id);
            return view('ketua.master_data.pembayaran.belumbayar');
        }
    }
    public function NoPaymentDetail($id)
    {
        // Cari pengajuan pinjaman berdasarkan ID
        $pengajuan = PengajuanPinjaman::findOrFail($id);

        return view('ketua.master_data.pembayaran.belumbayar', compact('pengajuan'));
    }
}
