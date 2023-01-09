<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kegiatan extends Model
{
    use HasFactory;
    protected $table = 'kegiatan';
    protected $primaryKey = 'id_kegiatan';
    protected $fillable = ['id_kategori_keg',    'nama_kegiatan',    'foto_keg',    'deskripsi',    'tujuan',    'manfaat',    'dari',    'sampai',    'created_at',    'updated_at'];
    public $timestamps = false;
}
