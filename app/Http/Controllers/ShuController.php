<?php

namespace App\Http\Controllers;

use App\Models\Shu;
use Illuminate\Http\Request;

class ShuController extends Controller
{
    public function createForm()
    {
        return view('ketua.master_data.shu');
    }

    // Fungsi untuk memproses data yang dikirimkan dari form
    public function processForm(Request $request)
    {
        // Validasi input (jika diperlukan)
        $request->validate([
            'jumlah_shu' => 'required|numeric'
        ]);

        // Mendapatkan nilai 'jumlah_shu' dari input HTTP menggunakan $request->input()
        $jumlahShu = $request->input('jumlah_shu');

        // Cari data berdasarkan kriteria tertentu, misalnya ID shu
        $idShu = 1; // Ganti dengan ID shu yang ingin Anda update atau create

        // Lakukan update atau create
        Shu::updateOrCreate(['shu_id' => $idShu], ['jumlah_shu' => $jumlahShu]);

        // Redirect ke halaman yang diinginkan setelah berhasil update/create
        return redirect()->route('shu.create')->with('success', 'Data SHU berhasil diupdate atau dibuat.');
    }
}
