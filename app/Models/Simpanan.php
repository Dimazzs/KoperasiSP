<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Simpanan extends Model
{
    use HasFactory;
    protected $table = 'simpanan'; // Nama tabel yang terkait dengan model

    protected $fillable = [
        'anggota_id',
        'tanggal',
        'jumlah',
    ];
    public function anggota()
    {
        return $this->belongsTo(Anggota::class, 'anggota_id');
    }
}
