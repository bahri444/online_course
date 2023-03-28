<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    use HasFactory;
    protected $table = 'answer';
    protected $primaryKey = 'id_answer';
    protected $fillable = [
        'id_question',
        'nama_anda',
        'a_one',
        'a_two',
        'status_answer',
        'created_at',
        'updated_at',
    ];
    public $timestamps = true;
    public function scopeLeftJoinToQuestion($query)
    {
        return $query->leftJoin('question', 'question.id_question', '=', 'answer.id_question');
    }
    public function scopeLeftJoinToModul($query)
    {
        return $query->leftJoin('modul', 'modul.id_modul', '=', 'question.id_modul');
    }
    public function scopeLeftJoinToKelas($query)
    {
        return $query->leftJoin('kelas', 'kelas.id_kelas', '=', 'modul.id_kelas');
    }
    public function scopeLeftJoinToBidang($query)
    {
        return $query->leftJoin('bidang', 'bidang.id_bidang', '=', 'kelas.id_bidang');
    }
}
