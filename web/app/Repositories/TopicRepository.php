<?php
namespace App\Repositories;
use App\Question;
use App\Topic;
use App\User;
use Auth;
use App\UserDetail;
use App\Answer;
use App\User_topic;
use App\User_vote;
use DB;

class TopicRepository {

	public function getAllTopic(){
        $data = Topic::paginate(16);
        foreach($data as $key => &$val){
            $val['user'] = User_topic::where('topic_id','=',$val['id'])->where('user_id','=',Auth::id())->first();
        }

        return $data;
    }

    public function findLimit(){
        return Topic::orderBy('followers_count','desc')->limit(3)->get();
    }

    public function findUserLike(){
        return User::findOrFail(Auth::id())->follows_topicc();
    }

    public function getAllQuestion($topicid){
       

        $data = Question::where('is_hidden','=','H')->with(['topics','user','answers'])->get();
        foreach($data as $key => $val){ 

            if($val['topics'][0]['id'] != $topicid ){
                unset($data[$key]);
            }
                foreach($val['answers'] as $k => $v){

                    $val['answers'][$k]['user_vote'] = user_vote::where('answer_id','=',$v['id'])->where('user_id','=',Auth::id())->first();

                }
            }


        return $data;
    }

    public function getTopic($topicid){
        return Topic::where('id','=',$topicid)->first();
    }
}

?>