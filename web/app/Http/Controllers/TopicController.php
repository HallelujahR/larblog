<?php

namespace App\Http\Controllers;

use App\Repositories\TopicRepository;
use App\Http\Requests\QuestionRequest;
use Illuminate\Http\Request;
use Auth;
use App\User;
use App\Dynamic;
use App\User_topic;
use App\Topic;

class TopicController extends Controller
{
    //
    public function __construct(TopicRepository $TopicRepository) {

        $this -> middleware('auth')->except(['index','show','circle']);
        $this ->topicRepository = $TopicRepository;
    }

    public function index(){

    	$userTopics = $this->topicRepository->findUserLike()->get();

    	return view('topic.index',compact(['userTopics']));

    }

    //话题圈
    public function circle(){	
    	$topics = $this->topicRepository->getAllTopic();
    	$hotTopic = $this->topicRepository->findLimit();
    	return view('topic.circle',compact(['topics','hotTopic']));
    }

    //关注话题
      public function follow_topic(Request $request){

    	$res = Auth::user()->followeTopicThis($request->get('topic_id'));

		if(count($res['attached'])>0){
			Topic::findOrFail($request->get('topic_id'))->increment('followers_count');
            Dynamic::create([
                'user_id'=>Auth::id(),
                'detail'=>Topic::findOrFail($request->get('topic_id')),
                'action'=>'followTopic',
                ]);
			return '1';
		}else{
			Topic::findOrFail($request->get('topic_id'))->decrement('followers_count');
			return '2';
		}
    }


    public function userTopic(){

        $questions = $this->topicRepository->getAllQuestion($_POST['topicid']);

        return $questions;
    }

    public function getTopic(Request $request){
        return $this->topicRepository->getTopic($request->get('topicid'));
    }

    public function detail($id){
        $topics =  $this->topicRepository -> getTopic($id);
        $topics['user'] = User_topic::where('topic_id','=',$id)->where('user_id','=',Auth::id())->first();
        return view('topic.detail',compact('topics'));
    }
}
