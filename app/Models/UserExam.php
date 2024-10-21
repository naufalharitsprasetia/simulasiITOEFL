<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserExam extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'exam_id',
        'attempt_number',
        'start_time',
        'end_time',
        'end_time',
        'score',
        'created_at',
        'updated_at',
    ];
    public function answers()
    {
        return $this->hasMany(Answer::class, 'user_exam_id', 'id');
    }
}
