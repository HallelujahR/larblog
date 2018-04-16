<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\MessageRepository;
use Auth;
use App\Notifications\UserMessageNotification;
Use Illuminate\Support\Facades\Redis;
use App\User;
use DB;
use App\Message;
use Carbon\Carbon;

class MessageController extends Controller
{
	protected $message;

	public function __construct(MessageRepository $messageRepository){

		$this->message = $messageRepository;

	}
    public function store(Request $request){
    	
    	$message = $this->message->create([
    		'from_user_id'=>Auth::id(),
    		'to_user_id'=>$request->get('to_user_id'),
    		'body'=>$request->get('body')
    		]);

        //获取$user_id对应的模型
        $toUser = User::findOrFail($request->get('to_user_id'));

        //关联了模型
        $toUser->notify(new UserMessageNotification());

    	if($message){

            $data = [
                'event'=>User::findOrFail($request->get('to_user_id'))->email,
                'data'=>[
                    'name'=>Auth::user()->name,
                    'avatar'=>Auth::user()->avatar,
                    'id'=>Auth::id(),
                    'body'=>$request->get('body'),
                ],
            ];

            Redis::publish('message',json_encode($data));

    		echo '1';
    	}else{
    		echo '2';
    	}

    }


    public function mes(Request $request){

        $arr = Message::where('from_user_id',Auth::id())->orwhere('from_user_id',$request->user_id)->get();

        foreach($arr as $key=>$v){
            if(!((($v->from_user_id == Auth::id() || $v->from_user_id == $request->user_id)) && (($v->to_user_id == Auth::id() || $v->to_user_id == $request->user_id)))){
                unset($arr[$key]);
            }
        }
        $arr1 = [];
        foreach($arr as $key=>$v){
            $arr1[] = $v->id;
        }

        $arr2 = Message::whereIn('id',$arr1)->orderBy('id')->get();

        foreach($arr2 as $k=>$v){
            if($v->read_at == ''){
                $arr = ['has_read'=>'H','read_at'=>Carbon::now()];
                Message::whereIn('id',$arr1)->where('to_user_id',Auth::id())->update($arr);
            }
            if($v->from_user_id == Auth::id()){
                $arr2[$k]['user'] = Message::findOrFail($v->id)->fromUser()->first();
            }else{
                $arr2[$k]['user'] = Message::findOrFail($v->id)->fromUser()->first();
            }
        }

        return $arr2;



        // $data['from']= DB::table('users')->where('id','=',$request->get('userid'))->first();
        // $data['message'] = $this->message->mes($request->get('userid'));
        // return $data;
    }
}