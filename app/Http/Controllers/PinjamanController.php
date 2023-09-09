<?php

namespace App\Http\Controllers;

use App\Models\PengajuanPinjaman;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PinjamanController extends Controller
{
    public function create()
    {
        return view('anggota.master_data.pinjaman.pengajuan');
    }
    public function store(Request $request)
    {
        $request->validate([
            'nama_barang' => 'required|string',
            'jumlah_pinjaman' => 'required|numeric|min:200000|max:1500000',
            'tenor' => 'required||numeric|max:6',
        ], [
            'jumlah_pinjaman.min' => 'minimal 200.000',
            'jumlah_pinjaman.max' => 'maksimal 1.500.000',
            'tenor.max' => 'maksimal 6 bulan'
        ]);

        $anggota_id = Auth::id();
        $comment = $request->input('comment');

        $comment = empty($comment) ? '' : $comment;


        PengajuanPinjaman::create([
            'anggota_id' => $anggota_id,
            'nama_barang' => $request->nama_barang,
            'jumlah_pinjaman' => $request->jumlah_pinjaman,
            'tenor' => $request->tenor,
            'status' => 'proses',
            'comment' => $comment,
        ]);

        return redirect()->route('pengajuan.create')->with('success', 'Pengajuan pinjaman berhasil disimpan.');
    }

    public function index()
    {
        $pengajuan = PengajuanPinjaman::where('status', 'proses')->get();
        return view('ketua.master_data.pengajuan.index', compact('pengajuan'));
    }

    public function editp($id)
    {
        $pengajuan = PengajuanPinjaman::where('id', $id)->first();
        return view('ketua.master_data.pengajuan.edit', compact('pengajuan'));
    }

    public function updatep(Request $request, $id)
    {
        $request->validate([
            'nama_barang' => 'required',
            'jumlah_pinjaman' => 'required',
            'tenor' => 'required'
        ]);

        $pengajuan = [
            'nama_barang' => $request->nama_barang,
            'jumlah_pinjaman' => $request->jumlah_pinjaman,
            'tenor' => $request->tenor
        ];
        PengajuanPinjaman::where('id', $id)->update($pengajuan);
        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan berhasil di update');
    }
    // Fungsi untuk verifikasi pengajuan pinjaman oleh ketua
    public function verify(Request $request, $id)
    {
        $pengajuan = PengajuanPinjaman::findOrFail($id);

        // Lakukan validasi atau aturan lainnya untuk verifikasi
        // Misalnya, Anda dapat memeriksa apakah pengguna yang saat ini terotentikasi adalah ketua

        // Set status pengajuan menjadi "terima" atau "tolak" berdasarkan kondisi verifikasi
        $pengajuan->status = $request->status; // Pastikan Anda sudah menambahkan input untuk status di view
        $pengajuan->save();

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan pinjaman berhasil diverifikasi.');
    }
    public function editComment($id)
    {
        // Cari data pengajuan pinjaman berdasarkan ID
        $pengajuan = PengajuanPinjaman::findOrFail($id);

        return view('ketua.master_data.pengajuan.comment', compact('pengajuan'));
    }
    public function updateComment(Request $request, $id)
    {
        $request->validate([
            'comment' => 'required|string'
        ]);

        $pengajuan = PengajuanPinjaman::findOrFail($id);

        $pengajuan->update([
            'comment' => $request->comment
        ]);

        return redirect()->route('pengajuan.index')->with('success', 'Komentar berhasil diperbarui.');
    }
    // Fungsi untuk menghapus data pengajuan pinjaman
    public function destroy($id)
    {
        $pengajuan = PengajuanPinjaman::findOrFail($id);

        // Lakukan validasi atau aturan lainnya untuk menghapus data
        // Misalnya, Anda dapat memeriksa apakah pengguna yang saat ini terotentikasi adalah ketua atau memiliki hak akses untuk menghapus data

        $pengajuan->delete();

        return redirect()->route('pengajuan.index')->with('success', 'Pengajuan pinjaman berhasil dihapus.');
    }

    public function showTerima($id)
    {
        $pengajuan = PengajuanPinjaman::findOrFail($id);
        return view('pengajuan.terima', compact('pengajuan'));
    }

    public function showDetail($id)
    {
        $pengajuan = PengajuanPinjaman::findOrFail($id);
        return view('anggota.master_data.pinjaman.status', compact('pengajuan'));
    }
    public function indexs()
    {
        // Mendapatkan ID anggota yang saat ini login
        $anggotaId = Auth::id();

        // Mengambil data pengajuan pinjaman berdasarkan anggota_id yang sesuai dengan ID anggota yang login
        $pengajuan = PengajuanPinjaman::where('anggota_id', $anggotaId)->get();

        return view('anggota.master_data.pinjaman.status', compact('pengajuan'));
    }

    public function indexsk(Request $request)
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

        $pengajuan = $query->select('pengajuan_pinjaman.*')->get();
        return view('ketua.master_data.pengajuan.data', compact('pengajuan'));
    }

    public function laporanPinjaman(Request $request)
    {


        // Ambil semua pengajuan pinjaman yang statusnya "terima" dan sesuai dengan pencarian
        $data = PengajuanPinjaman::where('status', 'terima')->get();


        // Lakukan perhitungan untuk menentukan status "Lunas" atau "Belum Lunas"


        return view('admin.master_data.laporan.pinjaman', compact('data'));
    }

    public function laporanPinjamank(Request $request)
    {


        // Ambil semua pengajuan pinjaman yang statusnya "terima" dan sesuai dengan pencarian
        $data = PengajuanPinjaman::where('status', 'terima')->get();


        // Lakukan perhitungan untuk menentukan status "Lunas" atau "Belum Lunas"


        return view('ketua.master_data.laporan.pinjaman', compact('data'));
    }


    public function pinjamangen(Request $request)
    {
        $startDate = $request->input('start_date');
        $endDate = $request->input('end_date');

        // Ambil data berdasarkan rentang tanggal
        $data = PengajuanPinjaman::whereBetween('created_at', [$startDate, $endDate])->get();

        return view('ketua.master_data.laporan.cetakp', compact('data', 'startDate', 'endDate'));
    }
}
