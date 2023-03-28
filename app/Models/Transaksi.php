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
    public function scopeJoinToKelas($query)
    {
        return $query->join('kelas', 'kelas.id_kelas', '=', 'transaksi_kelas.id_kelas');
    }
    public function scopeJoinToBidang($query)
    {
        return $query->join('bidang', 'bidang.id_bidang', '=', 'kelas.id_bidang');
    }
    public function scopeJoinToUser($query)
    {
        return $query->join('user', 'user.id_user', '=', 'transaksi_kelas.id_user');
    }
    public function scopeJoinToModul($query)
    {
        return $query->join('modul', 'modul.id_kelas', '=', 'kelas.id_kelas');
    }
}
