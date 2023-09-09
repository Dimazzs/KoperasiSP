<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Pembayaran;
use App\Models\Penarikan;
use App\Models\PengajuanPinjaman;
use App\Models\Shu;
use App\Models\Simpanan;
use App\Models\SimpananWajib;
use Illuminate\Http\Request;

class Dashboard extends Controller
{
    public function index()
    {
        $anggota = Anggota::findOrFail(auth()->id());
        $simpanan = Simpanan::where('anggota_id', $anggota->id)->get();
        $totalSimpanan = Simpanan::where('anggota_id', $anggota->id)->sum('jumlah');
        $totalSimpananWajib = SimpananWajib::where('anggota_id', $anggota->id)->sum('jumlah');
        $penarikan = Penarikan::where('anggota_id', $anggota->id)->get();
        $totalPenarikan = Penarikan::where('anggota_id', $anggota->id)->sum('jumlah');
        $saldoSimpanan = $totalSimpanan - $totalPenarikan;
        $totalSimpananAnggota = SimpananWajib::sum('jumlah');
        $shus = Shu::all();

        return view('anggota.master_data.index', compact('anggota', 'simpanan', 'totalSimpananWajib', 'saldoSimpanan', 'totalSimpananAnggota', 'shus'));
    }

    public function indexa()
    {
        $totalSimpananAnggota = SimpananWajib::sum('jumlah');
        $jumlahanggota = Anggota::count();
        $totalPinjaman = PengajuanPinjaman::where('status', 'terima')->sum('jumlah_pinjaman');
        $shus = Shu::all();

        return view('admin.master_data.index', compact('totalSimpananAnggota', 'jumlahanggota', 'totalPinjaman', 'shus'));
    }

    public function indexk()
    {
        $simpananPokok = Anggota::sum('simpanan_pokok');
        $totalSimpananAnggota = SimpananWajib::sum('jumlah');
        $jumlahanggota = Anggota::count();
        $totalPinjaman = PengajuanPinjaman::where('status', 'terima')->sum('jumlah_pinjaman');
        $shus = Shu::all();
        return view('ketua.master_data.index', compact('simpananPokok', 'totalSimpananAnggota', 'jumlahanggota', 'totalPinjaman', 'shus'));
    }
}
