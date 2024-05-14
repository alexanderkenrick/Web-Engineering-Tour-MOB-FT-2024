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

    public function answers()
    {
        return $this->belongsToMany(User::class, 'answers', 'question_id', 'user_id')
            ->withPivot(['pos_id', 'answer']);
    }
}
