<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $table = 'transaksi_kelas';
    protected $primaryKey = 'id_transaksi';
    protected $fillable = [
        'id_kelas',
        'id_member',
        'tgl_bayar',
        'validasi_pembayaran',
    ];
    public $timestamps = true;
}
