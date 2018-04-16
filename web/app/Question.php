<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = ['title','body','user_id'];

    public function topics(){
    	return $this -> belongsToMany('App\Topic');
    }

    public function user(){

    	return $this->belongsTo('App\User');

    }

    public function answers(){
    	return $this->hasMany('\App\Answer');
    }

    public function follows(){
        return $this->belongsToMany('App\User','user_question')->withTimestamps();
    }

    public function comments(){
        return $this->morphMany('App\Comment','commentable');
    }


}
