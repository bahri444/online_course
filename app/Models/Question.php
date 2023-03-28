<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;
    protected $table = 'question';
    protected $primaryKey = 'id_question';
    protected $fillable = [
        'id_modul',
        'one',
        'two',
        'status_question',
        'created_at',
        'updated_at'
    ];
    public $timestamps = true;
    public function scopeJoinToModul($query)
    {
        return $query->join('modul', 'modul.id_modul', '=', 'question.id_modul');
    }
    public function scopeJoinToKelas($query)
    {
        return $query->join('kelas', 'kelas.id_kelas', '=', 'modul.id_kelas');
    }
}
