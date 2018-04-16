<?php 
namespace App\Repositories;

use App\Message;
use Auth;
use DB;

class MessageRepository {
	public function create(Array $attributes){
		return Message::create($attributes);
	}

	public function mes($userid){

		return Message::where('to_user_id','=',Auth::id())->where('from_user_id','=',$userid)->get();
				
	}
}

?>