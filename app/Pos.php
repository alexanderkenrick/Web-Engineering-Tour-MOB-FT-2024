<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pos extends Model
{

    protected $table = 'pos';
    public $timestamps = false;

    public function questions()
    {
        return $this->hasMany(Question::class,'pos_id', 'id');
    }


}
