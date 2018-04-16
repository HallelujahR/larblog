<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\AnswerRepository;
use Auth;
use App\Dynamic;
use DB;

class AnswerController extends Controller
{
    protected $answerRepository;

    public function __construct(AnswerRepository $answerRepository){
        $this->answerRepository = $answerRepository;
    }

	public function store(Request $request ,$question_id){



		$answer = $this ->answerRepository->create([
			'user_id'=>Auth::id(),
			'question_id'=>$question_id,
			'body'=>$request->get('body'),
		]);

		$question = DB::table('questions')->where('id','=',$question_id)->first();
		$user = DB::table('users')->where('id','=',Auth::id())->first();

		$data['id'] = $question_id;
		$data['body'] = $request->get('body');
		$data['title'] = $question->title;
		$data['user_avatar'] = $user->avatar;
		$data['user_id'] = Auth::id();
		$data['name'] = $user->name;

		Dynamic::create([
			'user_id'=>Auth::id(),
			'detail'=>json_encode($data),
			'action'=>'questionAnswer'
			]);

		$answer -> question->increment('answers_count');
		$answer -> user -> increment('answers_count');
		return back();
	}

	public function voteup(Request $request){

			if($request->get('flag')=='1'){
				$this->answerRepository->addUser_vote($request->get('answerid'),$request->get('vote'));
				$this->answerRepository->findOne($request->get('answerid'))->increment('votes_count');

				$qid = $this->answerRepository->findOne($request->get('answerid'))->question_id;
				$q = DB::table('questions')->where('id','=',$qid)->first();
				$user = DB::table('users')->where('id','=',Auth::id())->first();

				$data['answer'] = $this->answerRepository->findOne($request->get('answerid'))->body;
				$data['question_id'] = $qid;
				$data['title'] = $q->title;
				$data['user_avatar'] = $user->avatar;
				$data['user_id'] = Auth::id();
				$data['name'] = $user->name;

				Dynamic::create([
					'user_id'=>Auth::id(),
					'detail'=>json_encode($data),
					'action'=>'voteup',
					]);
				echo '1';
			}else{
				$this->answerRepository->delUser_vote($request->get('answerid'),$request->get('vote'));
				$this->answerRepository->findOne($request->get('answerid'))->decrement('votes_count');
				echo '2';
			}

	}

	public function votedown(Request $request){

		if($request->get('flag') == '1'){
			$this->answerRepository->addUser_vote($request->get('answerid'),$request->get('vote'));
			$this->answerRepository->findOne($request->get('answerid'))->increment('unvotes_count');
			echo '1';
		}else{
			$this->answerRepository->delUser_vote($request->get('answerid'),$request->get('vote'));
			$this->answerRepository->findOne($request->get('answerid'))->decrement('unvotes_count');
			echo '2';
		}
	}

}
