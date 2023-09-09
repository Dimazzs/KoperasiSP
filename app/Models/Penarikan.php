<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penarikan extends Model
{
    use HasFactory;
    protected $table = 'penarikan'; // Nama tabel yang terkait dengan model

    protected $fillable = [
        'anggota_id',
        'tanggal',
        'jumlah',
        // Tambahkan kolom-kolom lain yang diperlukan untuk penarikan
    ];

    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }
}
