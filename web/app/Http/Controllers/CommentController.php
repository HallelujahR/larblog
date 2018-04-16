<?php

namespace App\Http\Controllers;

use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use App\Question;
use App\Answer;
use Auth;
use App\Dynamic;

class CommentController extends Controller
{

	protected $commentRepository; 

    public function __construct(UserRepository $UserRepository) {

        // $this -> middleware('auth')->except(['index','show']);
        // $this ->questionRepository = $questionRepository;
        // $this ->answerRepository = $AnswerRepository;
        $this ->userRepository = $UserRepository;
    }

    public function question(Request $request){
    	$question = Question::findOrFail($request->get('question_id'));

    	$res = $question->comments()->create(['user_id'=>Auth::id(),'body'=>$request->get('body')]);
    	$user = $this->userRepository->getAllUser(Auth::id());

    	if($res){
    		$question->increment('comments_count');
            Dynamic::create([
                'user_id'=>Auth::id(),
                'detail'=>$question,
                'action'=>'commentQuestion',
            ]);
    		return $user;
    	}else{
    		return 2;
    	}
    }

	public function answerComment(Request $request){
		$answer = Answer::findOrFail($request->get('answer_id'));

		$res = $answer->comments()->create(['user_id'=>Auth::id(),'body'=>$request->get('body')]);
		$user = $this->userRepository->getAllUser(Auth::id());
		if($res){
			$answer->increment('comments_count');
            Dynamic::create([
                'user_id'=>Auth::id(),
                'detail'=>$answer,
                'action'=>'commentAnswer',
                ]);
			return $user;
		}else{
			return '2';
		}
	}
}