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
}
