<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;
    protected $table = 'member';
    protected $primarykey = 'id_member';
    protected $fillable = [
        'id_user',
        'nama_member',
        'tgl_lhr',
        'foto',
        'gender',
        'alamat',
        'github',
        'telepon',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;
}
