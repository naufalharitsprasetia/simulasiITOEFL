<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;


class UserExam extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'exam_id',
        'attempt_number',
        'start_time',
        'end_time',
        'score',
        'created_at',
        'updated_at',
    ];
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];
    public function answers()
    {
        return $this->hasMany(Answer::class, 'user_exam_id', 'id');
    }
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
