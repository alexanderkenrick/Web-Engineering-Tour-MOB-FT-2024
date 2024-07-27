<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    public $timestamps = false;

    public function pos()
    {
        return $this->belongsTo(Pos::class,'pos_id', 'id');
    }

    public function option()
    {
        return $this->hasMany(Option::class,'questions_id', 'id');
    }

    public function user_answers()
    {
        return $this->hasMany(UserAnswer::class,'questions_id', 'id');
    }
}
