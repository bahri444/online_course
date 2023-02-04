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
        'a_one',
        'a_two',
        'status_answer',
        'created_at',
        'updated_at',
    ];
    public $timestamps = true;
}
