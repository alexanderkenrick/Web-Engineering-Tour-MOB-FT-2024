<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAnswer extends Model
{
    use HasFactory;

    protected $table = 'user_answers';
    public $timestamps = false;

    public function question()
    {
        return $this->belongsTo(Question::class,'questions_id', 'id');
    }

    public function option()
    {
        return $this->belongsTo(Option::class,'options_id', 'id');
    }

    public function user(){
        return $this->belongsTo(User::class,'users_id', 'id');
    }
}
