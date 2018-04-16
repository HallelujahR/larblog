<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Requests\QuestionRequest;
use App\Repositories\QuestionRepository;
use App\Repositories\UserRepository;
use App\Repositories\AnswerRepository;
use App\Dynamic;

class QuestionController extends Controller
{
    
    protected $questionRepository; 

    public function __construct(QuestionRepository $questionRepository,AnswerRepository $AnswerRepository,UserRepository $UserRepository) {

        $this -> middleware('auth')->except(['index','show','search','searchWeb']);
        $this ->questionRepository = $questionRepository;
        $this ->answerRepository = $AnswerRepository;
        $this ->userRepository = $UserRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $questions = $this->questionRepository->getAllQuestions();
        // $data = $questions->toArray();
        return view('question.index',compact('questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('question.create');
        // return view('question.test');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(QuestionRequest $request)
    {
        
        // dd($request->all());
        // Auth::login($user);让$user 这个用户登录  获取当前登录者的id
        // Auth::login($user);让$user 获取当前登录者的id

        $arr = $this -> questionRepository->deal($request->get('topics'));
        
        $data = array_merge($request->all(),['user_id'=>\Auth::id()]);

        $question = $this->questionRepository->create($data);//create自动过滤_token

        //关联关系表数据
        $question->topics()->attach($arr);

        //插入user_question Follow关系
        $this->questionRepository->follow($question->id);

        Dynamic::create([
            'user_id'=>Auth::id(),
            'detail'=>json_encode($question),
            'action'=>'createQuestion',
            ]);

        return redirect() -> action('QuestionController@show',['id'=>$question->id]);
    }



    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        // $question = Question::where('id',$id)->with('topics')->first();
        $question = $this->questionRepository->byIdWithTopics($id);
        $answer = $this->answerRepository->getAllAnswer($id);
        $comments = $question->comments()->with('user')->get();
        return view('question.show',compact(['question','answer','comments','user']));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $questions = $this->questionRepository->byIdWithTopics($id);
        // dump($questions);

        return view('question.edit',compact('questions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $arr = $this->questionRepository->deal($request->get('topics'));

        //查询出该条数据
        $findone_que = $this->questionRepository->FindOne($id);

        //修改该条数据
        $findone_que->update($request->all());

        //关联表进行同步
        $findone_que->topics()->sync($arr);

        $questions = $this->questionRepository->getAllQuestions();

        return redirect() -> action('UserController@index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy()
    {
        //
        $arr = [];
        
        $this->questionRepository->unfollow($_POST['id']);
        
        $findone = $this->questionRepository->FindOne($_POST['id'])->topics()->sync($arr);
        $question = $this->questionRepository->FindOne($_POST['id'])->delete();
        echo 'true';
    }

    public function search(Request $request){
        return $this->questionRepository->search($_POST['title']);
    }

    public function searchWeb(){
        $data = $this->questionRepository->searchWeb($_POST['title']);
        return view('question.search',compact('data'));
    }
}
