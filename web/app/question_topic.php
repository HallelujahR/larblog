<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class question_topic extends Model
{
    //
    
    public function topic(){
    	return $this->belongsToMany('App\Topic');
    }
}
