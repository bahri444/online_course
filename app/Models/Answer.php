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
        'a_three',
        'a_four',
        'a_five',
        'a_six',
        'a_seven',
        'a_eight',
        'a_nine',
        'a_ten',
        'status_answer',
        'created_at',
        'updated_at',
    ];
    public $timestamps = true;
}
