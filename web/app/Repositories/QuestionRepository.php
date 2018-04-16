<?php
namespace App\Repositories;
use App\Question;
use App\Topic;
use App\User;
use App\Follow;
use Auth;
use App\Comment;
use Carbon\Carbon;
use App\user_vote;

class QuestionRepository {
	public function byIdWithTopics($id){
		return Question::where('id',$id)->with(['topics','user'])->first();
	}

	public function create(array $attributes){
		return Question::create($attributes);
	}

	public function getAllQuestions() {

        $data = Question::where('is_hidden','=','H')->with(['topics','user','answers'])->get();

        foreach($data as $key => &$val){
            foreach($val['answers'] as $k => &$v){

                $val['answers'][$k]['user_vote'] = user_vote::where('answer_id','=',$v['id'])->where('user_id','=',Auth::id())->first();

            }
        }

        return $data;


	}


	//根据form提交的topics数组，如果是number ， 则不要需要添加新的topics表数据，如果是string就需要插入topics表，并返回对应的id

    public function deal($topics){
        return collect($topics)->map(function($topic){
            if(is_numeric($topic)){
                //让标签的questions_count字段自增
                Topic::findOrFail($topic)->increment('questions_count');
                return $topic;
            }else{
                //插入topics表数据
                $topic = Topic::create(['name'=>$topic,'questions_count'=>1]);
                return $topic->id;
            }
        })->toArray();
    }

    public function FindOne($id){
        return Question::findOrFail($id);
    }


    public function follow($question_id){

        Follow::create([
            'user_id'=>Auth::id(),
            'question_id'=>$question_id,
        ]);

    }

    public function unfollow($question_id){
        $follow = Follow::where('question_id',$question_id)->where('user_id',Auth::id())->first();
        $follow->delete();
    }

    public function search($title){
        $data = [];
        $data[0] = Question::where('title','like','%'.$title.'%')->limit('5')->get();
        $data[1] = User::where('name','like','%'.$title.'%')->limit('3')->get();
        $data[2] = Topic::where('name','like','%'.$title.'%')->limit('1')->get();
        return $data;
    }

    public function searchWeb($title){
          $data = [];
        $data[0] = Question::where('title','like','%'.$title.'%')->with(['answers','user'])->get();


        foreach($data[0] as $key => &$val){
            foreach($val['answers'] as $k => &$v){

                $val['answers'][$k]['user_vote'] = user_vote::where('answer_id','=',$v['id'])->where('user_id','=',Auth::id())->first();

            }
        }

        $res1 = User::where('name','like','%'.$title.'%')->get();
        $res2 = Topic::where('name','like','%'.$title.'%')->get();

        if(count($data[0]) == 0){
            $data[0] = 'no';
        }

        if(count($res1) == 0){

            $data[1] = 'no';
        }else{
            $data[1] = $res1;
        }

        if(count($res2) == 0){
            $data[2] = 'no';
        }else{
            $data[2] = $res2;
        }

        return $data;
    
    }
}
?>