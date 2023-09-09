<?php

namespace App\Http\Controllers;

use App\Models\Anggota;
use App\Models\Penarikan;
use App\Models\Simpanan;
use App\Models\SimpananWajib;
use Illuminate\Http\Request;

class SimpananController extends Controller
{
    public function index(Request $request)
    {
        if ($request->has('cari')) {
            $data = Anggota::join('users', 'anggota.user_id', '=', 'users.id')
                ->where('users.name', 'like', '%' . $request->cari . '%')
                ->paginate(10);
        } else {
            $data = Anggota::orderBy('id', 'asc')->paginate(10);
        }

        return view('admin.master_data.simpanan.index', compact('data', 'request'));
    }

    public function detail($id)
    {
        $anggota = Anggota::findOrFail($id);
        $simpanan = Simpanan::where('anggota_id', $id)->get();
        $totalSimpanan = Simpanan::where('anggota_id', $id)->sum('jumlah');

        // Mendapatkan data penarikan untuk anggota tertentu
        $penarikan = Penarikan::where('anggota_id', $id)->get();
        $totalPenarikan = Penarikan::where('anggota_id', $id)->sum('jumlah');

        // Menghitung saldo simpanan setelah dikurangi total penarikan
        $saldoSimpanan = $totalSimpanan - $totalPenarikan;

        return view('admin.master_data.simpanan.simpanan', compact('anggota', 'simpanan', 'totalSimpanan', 'penarikan', 'totalPenarikan', 'saldoSimpanan'));
    }
    public function cetaksd($id)
    {
        $anggota = Anggota::findOrFail($id);
        $simpanan = Simpanan::where('anggota_id', $id)->get();
        $totalSimpanan = Simpanan::where('anggota_id', $id)->sum('jumlah');

        // Mendapatkan data penarikan untuk anggota tertentu
        $penarikan = Penarikan::where('anggota_id', $id)->get();
        $totalPenarikan = Penarikan::where('anggota_id', $id)->sum('jumlah');

        // Menghitung saldo simpanan setelah dikurangi total penarikan
        $saldoSimpanan = $totalSimpanan - $totalPenarikan;

        return view('admin.master_data.laporan.cetaks', compact('anggota', 'simpanan', 'totalSimpanan', 'penarikan', 'totalPenarikan', 'saldoSimpanan'));
    }

    public function create()
    {
        $anggotas = Anggota::all();
        return view('admin.master_data.simpanan.tambahs', compact('anggotas'));
    }

    public function createSimpanan(Request $request)
    {
        $request->validate([
            'anggota_id' => ['required', 'exists:anggota,id'],
            'tanggal' => ['required', 'date'],
            'jumlah' => ['required', 'numeric'],
        ]);

        $simpanan = new Simpanan();
        $simpanan->anggota_id = $request->input('anggota_id');
        $simpanan->tanggal = $request->input('tanggal');
        $simpanan->jumlah = $request->input('jumlah');
        $simpanan->save();

        return redirect()->back()->with('success', 'Simpanan berhasil ditambahkan');
    }


    //penarikan
    public function creatp()
    {
        $anggotas = Anggota::all();
        return view('admin.master_data.simpanan.penarikan', compact('anggotas'));
    }
    public function createPenarikan(Request $request)
    {
        $request->validate([
            'anggota_id' => ['required', 'exists:anggota,id'],
            'tanggal' => ['required', 'date'],
            'jumlah' => ['required', 'numeric'],
        ]);

        $penarikan = new Penarikan();
        $penarikan->anggota_id = $request->input('anggota_id');
        $penarikan->tanggal = $request->input('tanggal');
        $penarikan->jumlah = $request->input('jumlah');
        $penarikan->save();

        return redirect()->back()->with('success', 'Penarikan simpanan berhasil dilakukan');
    }

    public function indexl()
    {
        $user_id = auth()->id();
        $anggota = Anggota::where('user_id', $user_id)->first();

        $simpanan = Simpanan::where('anggota_id', $anggota->id)->get();
        $totalSimpanan = Simpanan::where('anggota_id', $anggota->id)->sum('jumlah');

        $penarikan = Penarikan::where('anggota_id', $anggota->id)->get();
        $totalPenarikan = Penarikan::where('anggota_id', $anggota->id)->sum('jumlah');

        // Hitung saldo simpanan berdasarkan total simpanan dan total penarikan
        $saldoSimpanan = $totalSimpanan - $totalPenarikan;

        return view('anggota.master_data.laporan.simpanan', compact('anggota', 'simpanan', 'totalSimpanan', 'penarikan', 'totalPenarikan', 'saldoSimpanan'));
    }

    public function ls()
    {
        $data = Anggota::orderBy('nik', 'asc')->paginate(10);

        // Membuat array kosong untuk menyimpan totalSimpanan dan saldoSimpanan untuk setiap id anggota
        $totalSimpananPerAnggota = [];
        $saldoSimpananPerAnggota = [];

        // Menghitung totalSimpanan dan saldoSimpanan untuk setiap anggota dan menyimpannya dalam array
        foreach ($data as $anggota) {
            $totalSimpanan = Simpanan::where('anggota_id', $anggota->id)->sum('jumlah');
            $totalPenarikan = Penarikan::where('anggota_id', $anggota->id)->sum('jumlah');
            $saldoSimpanan = $totalSimpanan - $totalPenarikan;

            $totalSimpananPerAnggota[$anggota->id] = $totalSimpanan;
            $saldoSimpananPerAnggota[$anggota->id] = $saldoSimpanan;
        }

        return view('admin.master_data.laporan.simpanan', compact('data', 'totalSimpananPerAnggota', 'saldoSimpananPerAnggota'));
    }

    public function indexk(Request $request)
    {
        if ($request->has('cari')) {
            $data = Anggota::join('users', 'anggota.user_id', '=', 'users.id')
                ->where('users.name', 'like', '%' . $request->cari . '%')
                ->paginate(10);
        } else {
            $data = Anggota::orderBy('id', 'asc')->paginate(10);
        }

        return view('ketua.master_data.simpanan.index', compact('data', 'request'));
    }

    public function detailks($id)
    {
        $anggota = Anggota::findOrFail($id);
        $simpanan = Simpanan::where('anggota_id', $id)->get();
        $totalSimpanan = Simpanan::where('anggota_id', $id)->sum('jumlah');

        // Mendapatkan data penarikan untuk anggota tertentu
        $penarikan = Penarikan::where('anggota_id', $id)->get();
        $totalPenarikan = Penarikan::where('anggota_id', $id)->sum('jumlah');

        // Menghitung saldo simpanan setelah dikurangi total penarikan
        $saldoSimpanan = $totalSimpanan - $totalPenarikan;

        return view('ketua.master_data.simpanan.detail', compact('anggota', 'simpanan', 'totalSimpanan', 'penarikan', 'totalPenarikan', 'saldoSimpanan'));
    }

    public function lsk()
    {
        $data = Anggota::orderBy('nik', 'asc')->paginate(10);

        // Membuat array kosong untuk menyimpan totalSimpanan dan saldoSimpanan untuk setiap id anggota
        $totalSimpananPerAnggota = [];
        $saldoSimpananPerAnggota = [];

        // Menghitung totalSimpanan dan saldoSimpanan untuk setiap anggota dan menyimpannya dalam array
        foreach ($data as $anggota) {
            $totalSimpanan = Simpanan::where('anggota_id', $anggota->id)->sum('jumlah');
            $totalPenarikan = Penarikan::where('anggota_id', $anggota->id)->sum('jumlah');
            $saldoSimpanan = $totalSimpanan - $totalPenarikan;

            $totalSimpananPerAnggota[$anggota->id] = $totalSimpanan;
            $saldoSimpananPerAnggota[$anggota->id] = $saldoSimpanan;
        }

        return view('ketua.master_data.laporan.simpanan', compact('data', 'totalSimpananPerAnggota', 'saldoSimpananPerAnggota'));
    }

    public function cetak()
    {
        $data = Anggota::orderBy('nik', 'asc')->paginate(10);

        // Membuat array kosong untuk menyimpan totalSimpanan dan saldoSimpanan untuk setiap id anggota
        $totalSimpananPerAnggota = [];
        $saldoSimpananPerAnggota = [];

        // Menghitung totalSimpanan dan saldoSimpanan untuk setiap anggota dan menyimpannya dalam array
        foreach ($data as $anggota) {
            $totalSimpanan = Simpanan::where('anggota_id', $anggota->id)->sum('jumlah');
            $totalPenarikan = Penarikan::where('anggota_id', $anggota->id)->sum('jumlah');
            $saldoSimpanan = $totalSimpanan - $totalPenarikan;

            $totalSimpananPerAnggota[$anggota->id] = $totalSimpanan;
            $saldoSimpananPerAnggota[$anggota->id] = $saldoSimpanan;
        }

        return view('ketua.master_data.laporan.cetakss', compact('data', 'totalSimpananPerAnggota', 'saldoSimpananPerAnggota'));
    }
}
