<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Notifications\UserFollowNotification;
use App\Dynamic;

class FollowUserController extends Controller
{
    //
    public function store($user_id){
    	//关注这个用户
    	$res = Auth::user()->followThis_user($user_id);

    	if(count($res['attached']) > 0){
            //给user_id 这个用户发送一个通知

            //获取$user_id对应的模型
            $toUser = User::findOrFail($user_id);

    		//关联了模型
            $toUser->notify(new UserFollowNotification());

            //关注动作
    		Auth::user()->increment('followers_count');

    		User::findOrFail($user_id)->increment('followings_count');

            Dynamic::create([
                'user_id'=>Auth::id(),
                'action'=>'followUser',
                'detail'=>User::findOrFail($user_id),
                ]);
    		echo '1';
    	}else{
    		//取消关注动作
    		Auth::user()->decrement('followers_count');
    		User::findOrFail($user_id)->decrement('followings_count');
    		echo '2';
    	}
    }
}
