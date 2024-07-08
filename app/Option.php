<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    use HasFactory;

    protected $table = 'options';
    public $timestamps = false;

    public function question()
    {
        return $this->belongsTo(Question::class,'questions_id', 'id');
    }

    public function user_answers()
    {
        return $this->hasMany(UserAnswer::class,'options_id', 'id');
    }
}
