<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modul extends Model
{
    use HasFactory;
    protected $table = 'modul';
    protected $primaryKey = 'id_modul';
    protected $fillable = [
        'id_kategori_modul',
        'id_kelas',
        'nama_modul',
        'jml_modul',
        'tgl_terbit',
        'penulis',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;
}
