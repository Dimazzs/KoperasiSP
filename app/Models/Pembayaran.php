<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;
    protected $table = 'pembayaran';

    protected $fillable = [
        'pengajuan_pinjaman_id',
        'jumlah_pembayaran',
        'tanggal_pembayaran',
    ];

    public function pengajuanPinjaman()
    {
        return $this->belongsTo(PengajuanPinjaman::class, 'pengajuan_pinjaman_id');
    }
}
