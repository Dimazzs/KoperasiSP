<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Shu;
use App\Models\SimpananWajib;
use Illuminate\Http\Request;

class SimpananWajibController extends Controller
{
    public function index()
    {
        $user_id = auth()->id();
        $shuKoperasi = Shu::sum('jumlah_shu');
        $anggota = Anggota::where('user_id', $user_id)->first();
        $simpananWajibs = SimpananWajib::where('anggota_id', $anggota->id)->get();
        $totalSimpananWajib = SimpananWajib::where('anggota_id', $anggota->id)->sum('jumlah');
        if ($totalSimpananWajib != 0) {
            $totalSimpananAnggota = SimpananWajib::sum('jumlah');
            $totalSimpananAnggotaId = SimpananWajib::where('anggota_id', $anggota->id)->sum('jumlah');
            $shu = ($totalSimpananAnggota / $totalSimpananAnggotaId) * 0.35 * $shuKoperasi;
        } else {
            $shu = 0;
        }
        return view('anggota.master_data.laporan.simpananwajib', compact('anggota', 'simpananWajibs', 'totalSimpananWajib', 'shu'));
    }

    public function detail($id)
    {
        $simpananWajibs = SimpananWajib::where('anggota_id', $id)->get();
        $totalSimpananWajib = SimpananWajib::where('anggota_id', $id)->sum('jumlah');

        // Menghitung SHU
        $shuKoperasi = Shu::sum('jumlah_shu');
        $totalSimpananAnggota = SimpananWajib::sum('jumlah');
        $totalSimpananAnggotaId = SimpananWajib::where('anggota_id', $id)->sum('jumlah');
        $shu = ($totalSimpananAnggotaId / $totalSimpananAnggota) * 0.35 * $shuKoperasi;

        return view('admin.master_data.simpanan_wajib.detail', compact('simpananWajibs', 'totalSimpananWajib', 'shu', 'totalSimpananAnggota', 'totalSimpananAnggotaId', 'shuKoperasi'));
    }
    public function cetakswd($id)
    {
        $simpananWajibs = SimpananWajib::where('anggota_id', $id)->get();
        $totalSimpananWajib = SimpananWajib::where('anggota_id', $id)->sum('jumlah');

        // Menghitung SHU
        $shuKoperasi = Shu::sum('jumlah_shu');
        $totalSimpananAnggota = SimpananWajib::sum('jumlah');
        $totalSimpananAnggotaId = SimpananWajib::where('anggota_id', $id)->sum('jumlah');
        $shu = ($totalSimpananAnggotaId / $totalSimpananAnggota) * 0.35 * $shuKoperasi;

        return view('admin.master_data.laporan.cetaksw', compact('simpananWajibs', 'totalSimpananWajib', 'shu', 'totalSimpananAnggota', 'totalSimpananAnggotaId', 'shuKoperasi'));
    }


    public function create()
    {
        $anggotas = Anggota::all();
        return view('admin.master_data.simpanan_wajib.tambah', compact('anggotas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'anggota_id' => ['required', 'exists:anggota,id'],
            'tanggal' => ['required', 'date'],
            'jumlah' => ['required', 'numeric'],
        ]);

        SimpananWajib::create([
            'anggota_id' => $request->input('anggota_id'),
            'tanggal' => $request->input('tanggal'),
            'jumlah' => $request->input('jumlah'),
        ]);

        return redirect()->back()->with('success', 'Simpanan Wajib berhasil ditambahkan');
    }
    public function laporan()
    {

        return view('admin.master_data.laporan.simpananWajib');
    }
    public function generateSimpananWajib(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        // Query data simpanan wajib berdasarkan tanggal awal dan tanggal akhir
        $simpananWajib = SimpananWajib::whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])->get();

        return view('admin.master_data.laporan.laporansw', compact('simpananWajib', 'tanggalAwal', 'tanggalAkhir'));
    }



    public function details($id)
    {
        $simpananWajibs = SimpananWajib::where('anggota_id', $id)->get();
        $totalSimpananWajib = SimpananWajib::where('anggota_id', $id)->sum('jumlah');

        // Menghitung SHU
        $shuKoperasi = Shu::sum('jumlah_shu');
        $totalSimpananAnggota = SimpananWajib::sum('jumlah');
        $totalSimpananAnggotaId = SimpananWajib::where('anggota_id', $id)->sum('jumlah');
        $shu = ($totalSimpananAnggotaId / $totalSimpananAnggota) * 0.35 * $shuKoperasi;

        return view('ketua.master_data.simpanan_wajib.detail', compact('simpananWajibs', 'totalSimpananWajib', 'shu', 'totalSimpananAnggota', 'totalSimpananAnggotaId', 'shuKoperasi'));
    }
    public function laporans()
    {

        return view('ketua.master_data.laporan.simpananWajib');
    }
    public function generateSimpananWajibs(Request $request)
    {
        $request->validate([
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after_or_equal:tanggal_awal',
        ]);

        $tanggalAwal = $request->tanggal_awal;
        $tanggalAkhir = $request->tanggal_akhir;

        // Query data simpanan wajib berdasarkan tanggal awal dan tanggal akhir
        $simpananWajib = SimpananWajib::whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])->get();

        return view('ketua.master_data.laporan.laporansw', compact('simpananWajib', 'tanggalAwal', 'tanggalAkhir'));
    }
    public function cetakSimpananWajib(Request $request)
    {
        $tanggalAwal = $request->input('tanggal_awal');
        $tanggalAkhir = $request->input('tanggal_akhir');

        $simpananWajib = SimpananWajib::whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])->get();

        return view('ketua.master_data.laporan.cetakksw', compact('simpananWajib', 'tanggalAwal', 'tanggalAkhir'));
    }
}
