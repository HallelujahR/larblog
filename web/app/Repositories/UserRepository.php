<?php
namespace App\Repositories;
use App\Question;
use App\Topic;
use App\User;
use Carbon\Carbon;
use Auth;
use App\UserDetail;
use App\Answer;
use App\Dynamic;
use DB;

class UserRepository {

    
    public function getAllQuestions($user_id) {
        
        $data = [];

        // $id = Auth::id();

        return Question::where('user_id',$user_id)->with('topics')->get();


    }

    public function getAllUser($user_id){

        return User::where('id',$user_id)->with('images')->first();

    }

    public function getuserDetail($user_id){
        return UserDetail::where('user_id',$user_id)->first();
    }

    //获取该用户的关注者
    public function getAllFollowers($user_id){
        return User::findOrFail($user_id)->follows_user()->get();
    }

    //获取该关注该用户的人
    public function getAllFollowed($user_id){
        return User::findOrFail($user_id)->followings_user()->get();
    }

    public function FindOne(){
        return User::findOrFail(Auth::id());
    }

    public function getAllAnswer($user_id){
        return Answer::where('user_id',$user_id)->with('question')->get();
    }

    public function getUser($user_id){
            $data[0] = AUth::check()&&Auth::user()->followed_user($user_id);
            $data[1] = User::findOrFail($user_id);
        return $data;
    }

      public function findUserLike($user_id){
        return User::findOrFail($user_id)->follows_topicc();
    }

    public function getAllDynamic($user_id){
         $data = Dynamic::where('user_id','=',$user_id)->orderBy('created_at','desc')->get();

         $res['followUser'] = [];
         $res['followQuestion'] = [];
         $res['voteup'] = [];
         $res['commentAnswer'] = [];
         $res['followTopic'] = [];
         $res['createQuestion'] = [];
         $res['questionAnswer'] = [];


         foreach($data as $key => $val){

            if($val['action'] == 'followUser' ){
                if($val->detail != null){
                    $res['followUser'][$key] = $val->detail;
                }else{

                    $res['followUser'][$key] = 'null';
                }

            }

            if($val['action'] == 'followQuestion'){
                if($val->detail != null){
                    $res['followQuestion'][$key] = $val->detail;
                }else{
                   $res['followQuestion'][$key] = 'null';
                }
            }

            if($val['action'] == 'voteup'){
                if($val->detail != null){
                    $res['voteup'][$key] = $val->detail;
                }else{
                    $res['voteup'][$key] = 'null';
                }
            }

            if($val['action'] == 'commentAnswer'){
                if($val->detail != null){
                    $res['commentAnswer'][$key] = $val->detail;
                }else{
                    $res['commentAnswer'][$key] = 'null';
                }
            }


            if($val['action'] == 'followTopic'){
                if($val->detail != null){
                    $res['followTopic'][$key] = $val->detail;
                }else{
                    $res['followTopic'][$key] = 'null';
                }
            }

            if($val['action'] == 'createQuestion'){
                if($val->detail != null){
                    $res['createQuestion'][$key] = $val->detail;
                }else{
                    $res['createQuestion'][$key] = 'null';
                }
            }

            if($val['action'] == 'questionAnswer'){

                if($val->detail != null){

                    $res['questionAnswer'][$key] = $val->detail;
                }else{
                    $res['questionAnswer'][$key] = 'null';
                }
            }

         }


         return $res;
    }


}

?>