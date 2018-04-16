<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Question;
use App\Dynamic;

class FollowController extends Controller
{
    //
    public function __construct(){
    	$this->middleware('auth');
    }

    public function store(){
    	
    	$res = Auth::user()->followThis($_POST['id']);
    	// echo $res;
    	if(count($res['attached'])>0){
    		//关注
    		Question::findOrFail($_POST['id'])->increment('followers_count');
            Dynamic::create([
                'user_id'=>Auth::id(),
                'detail'=>Question::findOrFail($_POST['id']),
                'action'=>'followQuestion'
                ]);
    		echo '1';
    	}else{
    		//取消关注
    		Question::findOrFail($_POST['id'])->decrement('followers_count');
    		echo '2';

    	}

    }
}
