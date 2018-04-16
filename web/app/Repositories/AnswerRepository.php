<?php  

namespace App\Repositories;
use App\Answer;
use App\User_vote;
use Auth;

class AnswerRepository {
	public function create($attributes){
		return Answer::create($attributes);
	}

	public function getAllAnswer($id){

		$data =  Answer::where('question_id','=',$id)->with(['User','comments.user'])->get();
		foreach($data as $key => &$val){
			$val['user_vote'] = user_vote::where('answer_id','=',$val['id'])->where('user_id','=',Auth::id())->first();
		}

		return $data;
	}

	public function findOne($answerid){
		return Answer::findOrFail($answerid);
	}

	public function addUser_vote($answerid,$vote){

		if(User_vote::where('answer_id','=',$answerid)->where('user_id','=',Auth::id())->count() > 0){

			if($vote == '1'){	
				$this->findOne($answerid)->decrement('unvotes_count');
				User_vote::where('answer_id','=',$answerid)->where('user_id','=',Auth::id())->update(['vote'=>$vote]);
			}else{
				$this->findOne($answerid)->decrement('votes_count');
				User_vote::where('answer_id','=',$answerid)->where('user_id','=',Auth::id())->update(['vote'=>$vote]);
			}

		}else{
				User_vote::create([
				'user_id'=>Auth::id(),
				'answer_id'=>$answerid,
				'vote'=>$vote,
				]);
		}

	}

	public function delUser_vote($answerid,$vote){
		return User_vote::where('answer_id','=',$answerid)->where('user_id','=',Auth::id())->where('vote','=',$vote)->delete();
	}
}

?>