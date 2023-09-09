<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PengajuanPinjaman extends Model
{
    use HasFactory;
    protected $table = 'pengajuan_pinjaman';

    protected $fillable = [
        'anggota_id',
        'nama_barang',
        'jumlah_pinjaman',
        'tenor',
        'status',
        'comment'
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }
    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class, 'pengajuan_pinjaman_id');
    }
}
