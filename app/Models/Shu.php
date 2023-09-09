<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shu extends Model
{
    use HasFactory;
    protected $table = 'shu';
    public $timestamps = true;
    protected $primaryKey = 'shu_id';
    protected $fillable = ['jumlah_shu'];
}
