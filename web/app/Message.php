<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    
    protected  $table='messages';
	protected  $fillable=['from_user_id','to_user_id','body'];


	//Message.php 模型   一个私信属于发起用户
	public function fromUser(){
	    
	    return $this->belongsTo('App\User','from_user_id');
	    
	}

	//Message.php 模型   一个私信属于接收用户
	public function toUser(){
	    
	    return $this->belongsTo('App\User','to_user_id');
	    
	}
}
