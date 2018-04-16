<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
	protected $table ='comments';

	protected $fillable = ['user_id','body','commentable_id','commentable_type'];


	// 申明多态关联关系
	public function commentable(){
	    return $this->morphTo();
	}
	
   public function user(){

    	return $this->belongsTo('App\User');

    }

}
