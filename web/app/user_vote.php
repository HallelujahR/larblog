<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class user_vote extends Model
{
    //
    protected $fillable = ['answer_id','user_id','vote'];

    public function Answer(){
    	return $this->belongsToMany('App\Answer');
    }
}
