<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// use App\User_topic;

class Topic extends Model
{
    //
    protected $fillable = ['name','questions_count'];

	public function questions(){
    	return $this -> belongsToMany('App\Question');
    }

    public function user(){
    	return $this->belongsToMany('App\User');
    }

    // public function user_topics(){
    // 	return $this->belongsToMany('App\User_topics');
    // }


    public function question_topic(){
        return $this->beloingsToMany('App\Question_topic');
    }



    
}
