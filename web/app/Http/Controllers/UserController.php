<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\UserRepository;
use App\Repositories\TopicRepository;
use DB;
use Carbon\Carbon;
use Auth;

class UserController extends Controller
{
    //

    protected $userRepository;

    public function __construct(UserRepository $userRepository , TopicRepository $topicRepository) {

        $this -> middleware('auth')->except(['index','getUser']);
        $this ->userRepository = $userRepository;
        $this ->topicRepository = $topicRepository;
    }


    public function index($user_id) {

        $questions = $this->userRepository->getAllQuestions($user_id);
        $user = $this->userRepository->getAllUser($user_id);
        $answers = $this->userRepository->getAllAnswer($user_id);

        $follows = $this->userRepository->getAllFollowers($user_id);
        $followeds = $this->userRepository->getAllFollowed($user_id);

        $userdetails = $this->userRepository->getuserDetail($user_id);
        $topics = $this->userRepository->findUserLike($user_id)->get();
        $dynamics = $this->userRepository->getAllDynamic($user_id);
        return view('user.index',compact(['questions','user','answers','follows','followeds','userdetails','topics','dynamics']));

    }

    public function updateAvatar(){
        $a = $this->userRepository->FindOne();

        if($a->update($_POST)){
            return response()->json(['result'=>'ok','file'=>$_POST['avatar']]);
        };

        // echo $_POST['avatar'];

    }

    public function userDetail(){
        $user = $this->userRepository->getAllUser(Auth::id());
        $userdetails = $this->userRepository->getuserDetail(Auth::id());
        
        return view('user.detail',compact(['user','userdetails']));
    }

    public function updateDetail(){
        $detail = $this->userRepository->getuserDetail(Auth::id());

        if($detail->update($_POST)){
            echo '1';
        };
        // var_dump($detail);
    }

    public function getUser(Request $request){
        return $this->userRepository->getUser($request->get('userid'));
    }


    
}
