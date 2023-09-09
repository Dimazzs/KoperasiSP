<?php

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\Dashboard;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PinjamanController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SesiConttroller;
use App\Http\Controllers\ShuController;
use App\Http\Controllers\SimpananController;
use App\Http\Controllers\SimpananWajibController;
use App\Models\Pembayaran;
use App\Models\SimpananWajib;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::middleware(['guest'])->group(function () {

    Route::get('/', [SesiConttroller::class, 'index'])->name('login');
    Route::post('/', [SesiConttroller::class, 'login']);
});
Route::get('/home', function () {
    return redirect('/index');
});
Route::middleware(['auth'])->group(function () {
});

//Tampilan sesuai Role
Route::get('index', [IndexController::class, 'index']);
Route::get('/index/ketua', [IndexController::class, 'ketua'])->middleware('userAkses:ketua');;
Route::get('/index/admin', [IndexController::class, 'admin']);
Route::get('/index/anggota', [IndexController::class, 'anggota']);
Route::get('/logout', [SesiConttroller::class, 'logout']);
//TambahAnggota
Route::get('/register', [SesiConttroller::class, 'register']);
Route::post('/admin/create', [SesiConttroller::class, 'create']);
//profile
Route::get('profile', [ProfileController::class, 'index']);
Route::post('profile', [ProfileController::class, 'updateProfile']);
//Dat Anggota
Route::get('anggota', [ProfileController::class, 'indexs'])->name('anggota');;
Route::get('/ketua/anggota', [ProfileController::class, 'indexk'])->name('anggotak');
Route::get('/anggota/{id}/edit', [ProfileController::class, 'edit'])->name('anggota.edit');
Route::get('/ketua/detail/{id}', [ProfileController::class, 'detail'])->name('anggota.detail');
Route::put('/anggota/{id}', [ProfileController::class, 'update'])->name('anggota.update');
//simpanan
Route::get('simpanan', [SimpananController::class, 'index'])->name('simpanan');
Route::get('/simpanan/create', [SimpananController::class, 'create'])->name('simpanan.create');
Route::post('/simpanan/create', [SimpananController::class, 'createSimpanan'])->name('simpanan.create');
Route::get('/simpanan/detail/{id}', [SimpananController::class, 'detail'])->name('simpanan.detail');
Route::get('/laporan/simpanan', [SimpananController::class, 'indexl']);
//simpanan ketua
Route::get('simpanank', [SimpananController::class, 'indexk'])->name('simpanank');
Route::get('/simpanank/detail/{id}', [SimpananController::class, 'detailks'])->name('simpanan.details');
//Dashboard
Route::get('/index/anggota', [Dashboard::class, 'index']);
Route::get('/index/admin', [Dashboard::class, 'indexa']);
Route::get('/index/ketua', [Dashboard::class, 'indexk']);

//penarikan
Route::get('/penarikan/create', [SimpananController::class, 'creatp'])->name('penarikan.create');
Route::post('/penarikan', [SimpananController::class, 'createPenarikan'])->name('penarikan.create');
//simpananwajib
Route::get('/simpananwajib/detail/{id}', [SimpananWajibController::class, 'detail'])->name('simpananwajib.detail');
Route::get('/simpananwajibk/detail/{id}', [SimpananWajibController::class, 'details'])->name('simpananwajib.details');
Route::get('/simpananwajib/create', [SimpananWajibController::class, 'create'])->name('simpananwajib.create');
Route::post('/simpananwajib', [SimpananWajibController::class, 'store'])->name('simpananwajib.store');
Route::get('/simpananwajib', [SimpananWajibController::class, 'index']);
//pengajuan
Route::get('/pengajuan/create', [PinjamanController::class, 'create'])->name('pengajuan.create');
Route::post('/pengajuan', [PinjamanController::class, 'store'])->name('pengajuan.store');
Route::get('/pengajuan/{id}/terima', [PinjamanController::class, 'showTerima'])->name('pengajuan.showTerima');
Route::get('/pengajuan/{id}/detail', [PinjamanController::class, 'showDetail'])->name('pengajuan.showDetail');
Route::get('/anggota/pengajuan', [PinjamanController::class, 'indexs']);
Route::get('/ketua/pinjaman', [PinjamanController::class, 'indexsk'])->name('pinjamank');
// Rute untuk menampilkan daftar pengajuan pinjaman yang perlu diverifikasi oleh ketua
Route::get('/pengajuan', [PinjamanController::class, 'index'])->name('pengajuan.index');
//comment Ketua
Route::get('/pengajuan/{id}/edit-comment', [PinjamanController::class, 'editComment'])->name('pengajuan.editComment');
Route::put('/pengajuan/{id}/update-comment', [PinjamanController::class, 'updateComment'])->name('pengajuan.updateComment');
//veririfikasi ketua
Route::patch('/pengajuan/{id}/verify', [PinjamanController::class, 'verify'])->name('pengajuan.verify');
Route::delete('/pengajuan/{id}', [PinjamanController::class, 'destroy'])->name('pengajuan.destroy');
//pembayaran
Route::get('/pengajuan/pembayaran', [PembayaranController::class, 'bayarPinjamanForm'])->name('pembayaran.form');
Route::post('/pengajuan/bayar', [PembayaranController::class, 'bayarPinjamanProcess'])->name('pembayaran.process');
//data pinjaman Admin
Route::get('/data/pinjaman', [PembayaranController::class, 'index'])->name('datapinjaman');
Route::get('/pembayaran/{id}/detail', [PembayaranController::class, 'showDetail'])->name('pembayaran.detail');
Route::get('/pembayaran/no_payment/{id}', [PembayaranController::class, 'showNoPaymentDetail'])->name('pembayaran.no_payment');
//data pinjaman Ketua
Route::get('/pembayarank/{id}/detail', [PembayaranController::class, 'detailPembayaran'])->name('pembayaran.details');
Route::get('/pembayarank/no_payment/{id}', [PembayaranController::class, 'NoPaymentDetail'])->name('pembayaran.no_payments');
//laporan adminn
Route::get('/admin/laporan/simpanan', [SimpananWajibController::class, 'laporan']);
Route::post('/laporan/simpanan-wajib/generate', [SimpananWajibController::class, 'generateSimpananWajib'])->name('laporan.generateSimpananWajib');
Route::get('/admin/laporan/pinjaman', [PinjamanController::class, 'laporanPinjaman']);
Route::get('/admin/laporan/simpananSukarela', [SimpananController::class, 'ls'])->name('laporan.simpanan');
//laporan anggota
Route::get('/anggota/pembayaran', [PembayaranController::class, 'indexp']);
Route::get('/anggota/pembayaran/{id}/detail', [PembayaranController::class, 'detailAnggota'])->name('pembayaran.detailA');
Route::get('/anggota/no_pembayaran/{id}', [PembayaranController::class, 'BlmBayar'])->name('pembayaran.no_pembayaran');
//laporan ketua
Route::get('/ketua/laporan/simpananSukarela', [SimpananController::class, 'lsk'])->name('laporan.simpanank');
Route::get('/admin/laporan/simpananWajib', [SimpananWajibController::class, 'laporans']);
Route::get('/ketua/laporan/pinjaman', [PinjamanController::class, 'laporanPinjamank']);
Route::post('/laporan/simpanan-wajib/generates', [SimpananWajibController::class, 'generateSimpananWajibs'])->name('laporan.generateSimpananWajibs');
//shu
Route::get('/shu/create', [ShuController::class, 'createForm'])->name('shu.create');
Route::post('/shu/process', [ShuController::class, 'processForm'])->name('shu.process');
//cetak
Route::get('/cetak-laporan', [SimpananController::class, 'cetak'])->name('cetak.laporan');
Route::get('/cetak-laporanwajib', [SimpananWajibController::class, 'cetakSimpananWajib'])->name('laporan.cetakSimpananWajib');
Route::post('/pinjaman/generate', [PinjamanController::class, 'pinjamangen'])->name('laporan.generatepinjaman');
Route::get('/cetak-laporansd/{id}', [SimpananController::class, 'cetaksd'])->name('cetak.laporansd');
Route::get('/cetak-laporanswd/{id}', [SimpananWajibController::class, 'cetakswd'])->name('cetak.laporanswd');
//edit pengajuan
Route::get('edit/pengajuan/{id}', [PinjamanController::class, 'editp'])->name('edit.pengajuan');
Route::post('edit/pengajuan{id}', [PinjamanController::class, 'updatep'])->name('update.pengajuan');
