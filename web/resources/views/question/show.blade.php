@extends('layouts.app')

@include('vendor.ueditor.assets')
<link rel="stylesheet" href="{{asset('avatar/css/amazeui.min.css')}}">
<link rel="stylesheet" href="{{asset('avatar/css/amazeui.cropper.css')}}">
<link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/font-awesome.4.6.0.css">
@section('css')

    <style type="text/css">
        #scrollPl::-webkit-scrollbar{
          display:none;
        }
        #sendMessage{
            width:200px;
            background-color:#0F88EB;
            color:white;
            border-radius:5px;
            margin-bottom:10px;
        }
        #doc-prompt-toggle{
            width:90px;
            float:right;
            margin-right:5px;
        }
        a.topic {
            background: #EEF4FA;
            height:30px;
            line-height:30px;
            padding: 1px 10px 0;
            border-radius: 100px;
            text-decoration: none;
            margin: -3px 5px 5px 0;
            margin-bottom:10px;
            display: inline-block;
            white-space: nowrap;
            cursor: pointer;
            color:#5CACEE;
            float:right;
        }

        a.topic1 {
            background: #EEF4FA;
            height:30px;
            line-height:30px;
            padding: 1px 10px 0;
            border-radius: 100px;
            text-decoration: none;
            margin: -3px 5px 5px 0;
            margin-bottom:10px;
            display: inline-block;
            white-space: nowrap;
            cursor: pointer;
            color:#3E7AC2;
            margin-top:10px;
            /*float:right;*/
        }

        a.topic1:hover{
            text-decoration:underline;
        }

        a.topic:hover {
            /*background: #259;*/
            /*color: #fff;*/
            text-decoration: underline;
            /*font-weight:800;*/
        }  

        .zk:hover{
            cursor:pointer;
            color:#0F88EB;
        }
        #answer{
            width:100px;
        }
        #guanzhu{
            width:100px;
            background-color:#0F88EB;
            color:white;
        }
        #guanzhu:hover{
            background-color:#0F76C9;

        }

        #answer:hover{
            background-color:#F1F7FC;
        }


        #guanzhuU{
            width:90px;
            background-color:#0F88EB;
            color:white;
        }
        #guanzhuU:hover{
            background-color:#0F76C9;

        }

        #pinglun:hover{
            cursor:pointer;
        }
        #removepl:hover{
            cursor:pointer;
        }
        .zkanswerComment{
            cursor:pointer;
        }
         .voteUp:hover{
            cursor:pointer;
        }
        .voteDown:hover{
            cursor:pointer;
        }
         #guanzhuA{
            width:125px;
            background-color:#0F88EB;
            color:white;
            margin-left:25px;
        }
    </style>
@endsection

@section('content')
<div class="container" style="margin:0px;width:100%;margin-top:-22px;background-color:#FFFFFF;margin-bottom:10px;">
    <div class="col-md-10 col-md-offset-2" style="height:auto;">
        <div class="col-md-7 col-md-offset-1" style="height:auto">
            @foreach($question->topics as $topic)
                <a href="/topic/detail/{{$topic->id}}" class="topic1">{{$topic->name}}</a>
            @endforeach
            
            <div style="color:black;font-size:20px;font-weight:bold;">
                {{$question->title}}
                
                @if( $question->user_id === Auth::id()) 

                <a href="{{action('QuestionController@edit',array('id'=>$question->id))}}" style="margin-left:20px;font-size:14px;color:#8590A6;text-decoration:none">
                    <span class='glyphicon glyphicon-pencil' style="font-size:1px;"></span>
                    编辑
                </a>

                @endif
            </div>
            
            <div id="body"  class="panel-body pic sl" style="height:80px;overflow:hidden">
                    <div class="tp" style="height:80px;width:40%;overflow:hidden;float:left;">
                        
                    </div>    

                    <div class="wz" style="float:left;margin-left:20px;width:55%;height:80px;overflow:hidden;text-indent:27px;">
                        
                    </div>

                    <div>
                    {!! $question->body !!}
                    </div>
            </div>

                <div class="panel-body pic" style="height:0px;opacity:0;overflow:hidden">
                    {!! $question->body !!} 
                </div>

<!--             <div id="body" style="height:137px;overflow:hidden">
            </div> -->

            <div>

                @if(Auth::check())
                <button type="button" lg="1" flag="1" id="answer" class="btn btn-default navbar-btn" style="border:1px solid #0F88EB;color:#0F88EB;float:left">写回答</button>
                @else
                <button type="button" lg="2" flag="1" id="answer" class="btn btn-default navbar-btn" style="border:1px solid #0F88EB;color:#0F88EB;float:left">写回答</button>
                @endif

                <button type="button" id="guanzhu" questionid = "{{$question->id}}"class="btn btn-default navbar-btn" style="float:left;margin-left:10px;">关注问题</button>
                
                <div  data-toggle="modal" data-target=".bs-example-modal-lg" style="float:left;margin-top:15px;height:20px;margin-left:10px;line-height:20px;" id="pinglun" ><span class="glyphicon glyphicon-comment" style="margin-top:3px;margin-right:5px;font-size:11px;"></span>{{$question->comments_count}}条评论</div>
<!-- 评论开始 -->
<div class="modal fade bs-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel">
  <div class="modal-dialog modal-lg" role="document" style="height:500px;width:700px;position:relative;" >
    <div class="modal-content" style="height:100%" >
        <div style="height:50px;border-bottom:1px solid #F1F3F8;position:relative">
            <div style="height:100%;width:15%;float:left;line-height:50px;padding-left:30px;color:black;font-size:14px;font-weight:bold">{{$question->comments_count}}条评论</div>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="margin-top:15px;margin-right:10px;"><span aria-hidden="true" class="glyphicon glyphicon-remove" style="font-size:14px;"></span></button>
        </div>

        <div id="scrollPl" style="height:390px;;width:100%;overflow:scroll;">
        @foreach($comments as $comment)
            <div style="height:auto;border-bottom:1px solid #F0F2F7;width:95%;margin-left:17px;margin-top:10px;">
                <div style="height:40px;padding-top:5px;">
                    <a href="{{action('UserController@index',array('id'=>$comment->user->id))}}"><img src="{{$comment->user->avatar}}" width="30px;" style="border-radius:5px;margin-right:10px;"alt=""></a>
                    <span style="color:black;font-size:17px;">{{$comment->user->name}}</span>
                    <span style="float:right">{{$comment->created_at->diffForHumans()}}</span>
                </div>

                <div style="word-wrap:break-word; margin-top:10px;color:262626;font-size:16px;height:auto">
                    {{$comment -> body}}
                </div>

                <div style="margin-top:10px;margin-bottom:5px;">
                    
                </div>
            </div>
        @endforeach
        </div>

        <div style="border-top:1px solid #F0F2F7;width:100%;height:60px;position:absolute;bottom:0px;">
            <div class="col-lg-6" style="width:85%;margin-top:10px;margin-left:40px;">
                <div class="input-group" >
                  <input type="text" class="form-control" id="commentBody" placeholder="Search for...">
                  <span class="input-group-btn">

                    <button class="btn btn-default" id="sendComment" style="width:0px;overflow:hidden;opacity:0;background-color:#0F88EB;color:white;"type="button" >评论</button>
                  </span>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div>
    </div>


  </div>
</div>
<!-- 评论结束 -->
            <span class="label label-default" style="float:left;margin-top:15px;margin-left:50px;background-color:#FFFFFF;color:black;box-shadow:0px 0px 3px #C1C1C1;color:#333333">已有{{$question->answers_count}}个答案</span>

                 <div style="float:right;margin-top:10px;" class="zkQ" info="1">∨ 点击展开</div>
            </div>

        </div>
        <div class="col-md-2" style="height:200px;">
            <div style="border-right:1px solid #E7EAF1;float:left;width:50%;height:30%;margin-top:30px;">
                <div style="text-align:center">
                    关注者
                </div>
                <div style="text-align:center;margin-top:5px;font-weight:bold;color:#262626;font-size:20px;" id="gzz">
                    {{$question->followers_count}}
                </div>
            </div>
            <div style="float:left;width:50%;height:60%;margin-top:30px;">
                <!-- 关注者{{$question->followers_count}} -->
            </div>
        </div>
    </div>
</div>


<div class="container" style="width:100%">    
    <div class="col-md-10 col-md-offset-2">
        <div class="col-md-7 col-md-offset-1">
            <div style="height:0px;overflow:hidden;" id="hd">
                <div >
                    <div>
                        <div class="panel panel-default">
                            <div class="panel-heading" style="border-bottom:none">
                                <span>回答问题 </span>
                                <div id="tipA" style="float:right;color:#FF6666;opacity:0;">
                                    <span class="glyphicon glyphicon-info-sign"></span>
                                    答案不能为空
                                </div>
                            </div>
                            {!! Form::open(['url'=>action('AnswerController@store',['id'=>$question->id]),'method'=>'post']) !!}

                                <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
                                    
                                    <!--百度编辑器开始-->
                                    <script id="container" name="body" style='height:200px;margin-bottom:-20px;' type="text/plain">
                                           {!! old('body') !!} 
                                    </script>
                                    <!--百度编辑器结束-->  
                                    
                                    @if ($errors->has('body'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('body') }}</strong>
                                        </span>
                                    @endif   

                                </div>
                               
                                {!!Form::submit('提交答案',['class'=>'btn btn-info btn-block'])!!} 
                            </div>

                            {!!Form::close()!!}
                    </div>
                </div>
            </div>
            @foreach($answer as $answers)
                <div class="panel panel-default"style="padding-bottom:10px;position:relative">

                    <div class="panel-heading">
                    <a href="{{action('UserController@index',array('id'=>$answers->user->id))}}"><img class="user" flag="1" src="{{$answers->user->avatar}}" userid="{{$answers->user->id}}" width="30px;" alt=""></a>

                    <div class="userB" style="background-color:white;height:0px;overflow:hidden;opacity:0;width:350px;position:absolute;box-shadow:0px 0px 5px #EAEDED;border-radius:5px;top:60px;">
                     
                    </div>

                        <span style="margin-left:10px;font-weight:bold;color:#555555">
                            {{$answers->user->name}}
                        </span>
                    </div>

                        <div class="panel-body pic sl" style="height:auto;">
                             <div class="tp" style="height:auto;width:40%;overflow:hidden;float:left;">
                                
                            </div>    

                            <div class="wz" style="float:left;margin-left:20px;width:55%;height:200px;overflow:hidden;text-indent:27px;">
                                
                            </div>
                        
                            <div>
                            {!! $answers->body !!}
                            </div>
                        </div>

                        <div class="panel-body pic" style="height:0px;opacity:0;overflow:hidden;padding:0px;">
                            {!! $answers->body !!} 
                        </div>

                        <div style="height:30px;padding-left:15px;padding-top:0px;" answerid="{{$answers->id}}">

                            <div class="voteUp" vote="1" 
                            
                                @if($answers->user_vote != null)
                                    @if($answers->user_vote['vote'] === 1)
                                    flag='2'
                                    @else
                                    flag='1'
                                    @endif
                                @else
                                flag ='1'
                                @endif

                            style="float:left;margin-top:-10px;margin-right:10px;height:40px;padding:10px;border-radius:5px;background-color:#EBF3FB;color:#2D84CC;"><span class="glyphicon glyphicon-triangle-top" style="font-size:14px;margin-right:5px;"></span><span class="upvote">{{$answers->votes_count}}</span></div>

                            <div class="voteDown" vote="2"
                                
                            @if($answers->user_vote != null)
                                    @if($answers->user_vote['vote'] === 2)
                                    flag='2'
                                    @else
                                    flag='1'
                                    @endif
                                @else
                                flag ='1'
                                @endif

                             style="float:left;margin-top:-10px;margin-right:10px;height:40px;padding:12px;border-radius:5px;background-color:#EBF3FB;color:#2D84CC;text-align:center;line-height:40px;">
                            <span class="glyphicon glyphicon-triangle-bottom" style="font-size:14px;"></span></div>


                            <div style="width:100px;float:left;" info="1" class="zkanswerComment"><span class="glyphicon glyphicon-comment" style="font-style:12px;"></span> {{$answers->comments_count}}条评论</div>

                        

                            <div style="float:right;margin-right:10px;margin-bottom:5px;" class="click zk" info="1">∨ 点击展开</div>

                        </div>


                        <!-- 回答评论 -->
                        <div style="border:1px solid #E7EAF2;height:0px;opacity:0;overflow:hidden;width:96%;margin-left:15px;border-radius:5px;" id="answersComment">
                            <div style="border-bottom:1px solid #E7EAF2;height:50px;line-height:50px;font-size:15px;font-weight:bold;color:#1E1E1E;padding-left:10px;">{{$answers->comments_count}}条评论</div>
                            
                        @if($answers->comments_count != 0)
                            @foreach($answers->comments as $comment)
                            <div style="border-bottom:1px solid #E7EAF2;margin-top:10px;width:97%;margin-left:9px;height:auto;padding-bottom:5px;">
                                <div style="height:30px;">
                                    <a href="{{action('UserController@index',array('id'=>$comment->user->id))}}"><img src="{{$comment->user->avatar}}" width="30px;" style="border-radius:3px;float:left" alt=""></a>
                                    <span style="float:left;margin-left:5px;margin-top:3px;color:#1E1E1E">{{$comment->user->name}}</span>
                                    <span style="float:right;margin-top:3px;margin-right:5px;color:#1E1E1E ">{{$comment->created_at->diffForHumans()}}</span>
                                </div>
                                <div style="margin-top:10px;word-wrap:break-word;" id="answerCommentBody">
                                    {{$comment->body}}
                                </div>
                                <div style="height:30px;margin-top:5px;">
                                </div>
                            </div>
                            @endforeach
                        @endif

                             <div style="width:95%;height:35px;margin-top:10px;padding-left:20px;">
                                <div class="input-group" >
                                  <input type="text" class="form-control answerPl" placeholder="Search for...">
                                  <span class="input-group-btn">
                                    <button class="btn btn-default sendAnswerPl"  answerid="{{$answers->id}}" style="background-color:#0F88EB;color:white;width:0px;opacity:0;overflow:hidden" type="button" >评论</button>
                                  </span>
                                </div><!-- /input-group -->
                            </div><!-- /.col-lg-6 -->
                        </div>
                        <!-- 回答评论结束 -->
                </div>
            @endforeach
        </div>

         <div class="col-md-2" style="height:300px;background-color:white;box-shadow:0px 0px 3px #C1C1C1;padding:0px;">
            <div style="border-bottom:1px solid #F0F2F7;height:60px;color:black;padding-left:15px;line-height:60px;font-size:15px;font-weight:bold;">
                关于作者
            </div>
            <div style="border-bottom:1px solid #F0F2F7;height:90px;">
                <div style="width:30%;height:100%;padding-top:20px;padding-left:10px;float:left;">
                    <a href="{{action('UserController@index',array('id'=>$question->user->id))}}"><img src="{{$question->user->avatar}}" width="50px;" style="border-radius:5px;" alt=""></a>
                </div>
                <div style="width:70%;height:100%;float:left;line-height:60px;font-size:20px;font-weight:bold;color:black;padding-left:10px;">
                    {{$question->user->name}}
                </div>
            </div>

            <div style="height:90px;border-bottom:1px solid #F0F2F7;">
                <div style="width:32%;float:left;margin-left:1px;height:100%">
                    <div style="width:100%;height:50%;color:#8590A6;font-size:16px;text-align:center;line-height:50px;">回答</div>
                    <div style="width:100%;height:50%;color:black;font-size:20px;text-align:center;line-height:30px;font-weight:bold">{{$question->user->answers_count}}</div>
                </div>

                <div style="width:32%;float:left;margin-left:1px;height:100%">
                    <div style="width:100%;height:50%;color:#8590A6;font-size:16px;text-align:center;line-height:50px;">文章</div>
                    <div style="width:100%;height:50%;color:black;font-size:20px;text-align:center;line-height:30px;font-weight:bold">{{$question->user->questions_count}}</div>
                </div>

                <div style="width:32%;float:left;margin-left:1px;height:100%">
                    <div style="width:100%;height:50%;color:#8590A6;font-size:16px;text-align:center;line-height:50px;">关注者</div>
                    <div style="width:100%;height:50%;color:black;font-size:20px;text-align:center;line-height:30px;font-weight:bold">{{$question->user->followings_count}}</div>
                </div>
            </div>
            
            @if(Auth::id() != $question->user->id)
            <div style="height:60px;padding-left:13px;padding-top:5px;">
                <button type="button" userid="{{$question->user->id}}" id="guanzhuU" flag="{{Auth::check()&&Auth::user()->followed_user($question->user->id)}}"class="btn btn-default navbar-btn"><span class="glyphicon glyphicon-plus" ></span>  关注他</button>

                <button type="button"  id="doc-prompt-toggle"  class="btn btn-default navbar-btn" style="margin-left:10px;"><span class="glyphicon glyphicon-send" ></span>  私信他</button>
            </div>
            @endif
        </div>
    </div>
</div>


<div id="login" flag="{{Auth::check()?'1':'2'}}"></div>
<div id="flag" flag="{{Auth::check()&&Auth::user()->followed($question->id) ? "1" : "2"}}"></div>



<!-- 私信 -->
<div class="am-modal am-modal-prompt" tabindex="-1" id="my-prompt" >
  <div class="am-modal-dialog"  style="width:400px;position:relative;">
    <span id="closeMes" class="am-modal-btn glyphicon glyphicon-remove" style="position:absolute;top:0px;right:-30px;color:white;border:1px none white;font-size:10px;"></span>
    <div class="am-modal-hd" style="height:100px;color:black;line-height:0px;line-height:80px;font-weight:bold;font-size:20px;">发送私信</div>
    <div style="height:30px;padding-left:20px;padding-right:20px;">
        <div style="float:left;color:black;font-weight:bold">{{$question->user->name}}</div>
        <div><a href="javascript:void(0)" class="mes closes" userid="{{$question->user->id}}" style="color:#1D6EB5;text-decoration:none;float:right" data-toggle="modal" data-target="#myModal">查看私信记录</a></div>
    </div>
    <div class="am-modal-bd" style="border:1px none white;">
        <textarea name="messageBody" id="" cols="20" rows="10" class="am-modal-prompt-input" id="messageBody" name="body" style="resize: none;"></textarea>
    </div>
      <!-- <span class="am-modal-btn">取消</span> -->
       <button type="button" toid="{{$question->user->id}}"  class="btn btn-default navbar-btn am-modal-btn" id="sendMessage" fromid="{{Auth::id()}}" style="margin-left:10px;">发送</button>
       <!-- <button type="button" class="btn btn-default navbar-btn am-modal-btn" style="margin-left:10px;">取消</button> -->
      <!-- <span class="am-modal-btn">提交</span> -->
  </div>
</div>
<!-- 私信结束 -->
@endsection

@section('js')
<script src="https://cdn.bootcss.com/jquery/3.1.1/jquery.js"></script>
<script src="https://cdn.bootcss.com/amazeui/2.7.2/js/amazeui.min.js" charset="utf-8"></script>
<script type="text/javascript" src="{{asset('spin.min.js')}}"></script>
<script type="text/javascript" src="{{asset('layer/layer.js')}}"></script>
@endsection

<script type="text/javascript">
window.onload = function(){
 $('.closes').click(function(){
        $('#closeMes').trigger('click');
    })
    //     //点赞
    $('.voteUp').click(function(){
        if($('#login').attr('flag') == '2'){
            // layer.msg('请登录');
            alert('请先登录');
            return false;
        }
        var answerid = $(this).parent().attr('answerid');
        var vote = $(this).attr('vote');
        var flag = $(this).attr('flag');
        var thiss = $(this);

        $.ajax({
            url:'/answer/voteup',
            data:{answerid:answerid,vote:vote,flag:flag},
            type:'get',
            success:function(mes){
                if(mes == '1'){
                    if(thiss.attr('flag') == '1'){

                            thiss.css({
                                'background-color':'#2D84CC',
                                'color':'white',
                            })
                            var num = thiss.find('span:eq(1)').html();
                            num++;
                            thiss.find('span:eq(1)').html(''+num+'')

                        if(thiss.next().attr('flag') == '2'){
                            thiss.next().css({
                                'background-color':'#EBF3FB',
                                'color':'#2D84CC',
                            })
                            thiss.next().attr('flag','1');
                        }

                    }

                    thiss.attr('flag','2');
                }else{
                        thiss.css({
                            'background-color':'#EBF3FB',
                            'color':'#2D84CC',
                        })
                        var num = thiss.find('span:eq(1)').html();
                            num--;
                        thiss.find('span:eq(1)').html(''+num+'');

                    thiss.attr('flag','1');
                }
            }
        })
    })


    $('.voteDown').click(function(){
        var answerid = $(this).parent().attr('answerid');
        var vote = $(this).attr('vote');
        var flag = $(this).attr('flag');
        var thiss = $(this);
        $.ajax({
            url:'/answer/votedown',
            data:{answerid:answerid,vote:vote,flag:flag},
            type:'get',
            success:function(mes){
                if(mes == '1'){

                    if(thiss.attr('flag') == '1'){
                        thiss.css({
                            'background-color':'#2D84CC',
                            'color':'white',
                        })

                    if(thiss.prev().attr('flag') == '2'){
                        thiss.prev().css({
                            'background-color':'#EBF3FB',
                            'color':'#2D84CC',
                        })

                        var num = thiss.prev().find('span:eq(1)').html();
                            num--;
                        thiss.prev().find('span:eq(1)').html(''+num+'');

                        thiss.prev().attr('flag','1');
                    }

                    }

                    thiss.attr('flag','2');
                }else{
                        thiss.css({
                            'background-color':'#EBF3FB',
                            'color':'#2D84CC',
                        })
                    thiss.attr('flag','1');
                }
            }
        })
    })
    
    for(var a = 0;a<$('.voteUp').length;a++){
        if($('.voteUp:eq('+a+')').attr('flag') == '2'){
            $('.voteUp:eq('+a+')').css({
                'background-color':'#2D84CC',
                'color':'white',
            })
        }
    }

    for(var a = 0;a<$('.voteDown').length;a++){
        if($('.voteDown:eq('+a+')').attr('flag') == '2'){
            $('.voteDown:eq('+a+')').css({
                'background-color':'#2D84CC',
                'color':'white',
            })
        }
    }
    // //点赞结束

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    //控制评论弹出的ajax
    $('#sendComment').click(function(){

        if($('#login').attr('flag') == '2'){
            // layer.msg('请先登录');
            alert('请先登录');
            return false;
        }

        var comment = $(this).parent().prev().val();

        $.ajax({
            url:'/comment/question',
            type:'post',
            data:{'question_id':{{$question->id}},'body':comment},
            success:function(mes){
                if(mes != 2){
                    $('#scrollPl').append(`
                        <div style="height:auto;border-bottom:1px solid #F0F2F7;width:95%;margin-left:17px;margin-top:10px;">
                            <div style="height:40px;padding-top:5px;">
                                <img src="/avatar/default.jpg" width="30px;" style="border-radius:5px;margin-right:10px;"alt="">
                                <span style="color:black;font-size:17px;">`+mes['name']+`</span>
                                <span style="float:right">刚刚</span>
                            </div>

                            <div style="word-wrap:break-word; margin-top:10px;color:262626;font-size:16px;height:auto" >
                                `+comment+`
                            </div>

                            <div style="margin-top:10px;margin-bottom:5px;">
                            </div>
                        </div>
                        `)  
                    // layer.msg('评论该问题成功');
                    alert('评论成功');
                    $('#commentBody').val('');
                }else{
                    alert('评论失败');
                    // layer.msg('评论该问题失败');
                }
            }
        });
    });

    //控制私信弹出的ajax
    $('#doc-prompt-toggle').on('click', function() {
        if($('#login').attr('flag') == '2'){
            // layer.msg('请登录');
            alert('请登录');
            return false;
        }
        $('#my-prompt').modal({
          relatedTarget: this,
          onConfirm: function(e) {
            alert('你输入的是：' + e.data || '');
          },
          onCancel: function(e) {
            alert('不想说!');
          }
        });
    });

    //发送私信的ajax
    $('#sendMessage').click(function(){
        var toid = $(this).attr('toid');
        var body = $('textarea[name="messageBody"]').val();

        if(body==''){
            // layer.msg('不能为空');
            alert('不能为空');
            return false;
        }

        $.ajax({
            url:'/message/store',
            type:'get',
            data:{to_user_id:toid,body:body},
            success:function(mes){
                if(mes == '1'){
                    // layer.msg('私信发送成功');
                    alert('私信发送成功');
                }
            }

        });
    })

    //评论模态框控制

    $('#commentBody').on('input',function(){
        if($(this).val() == ''){
            $('#sendComment').attr('disabled','disabled');
        }else{
            $('#sendComment').removeAttr('disabled');
        }
    })

    if($('#commentBody').val() == ''){
        $('#sendComment').attr('disabled','disabled');
    }else{
        $('#sendComment').removeAttr('disabled');
    }


    $('#commentBody').focus(function(){
        $('#sendComment').css({
            'width':'100px',
            'opacity':'1',
            'transition':'all 0.4s',
        })
    }).blur(function(){
        $('#sendComment').css({
            'width':'0px',
            'opacity':'0',
            'overflow':'hidden',
            'transition':'all 0.4s',
        })
    })

    //回答评论控制
    for(var a = 0;a<$('.answerPl').length;a++){

    if($('.answerPl:eq('+a+')').val() == ''){

        $('.answerPl:eq('+a+')').next().find('button:eq(0)').attr('disabled','disabled');
    }else{
        $('.answerPl:eq('+a+')').next().find('button:eq(0)').removeAttr('disabled');
    }
    }

    $('.answerPl').on('input',function(){
        if($(this).val() == ''){
            $(this).next().find('button:eq(0)').attr('disabled','disabled');
        }else{
             $(this).next().find('button:eq(0)').removeAttr('disabled');
        }
    })


    $('.answerPl').focus(function(){
         $(this).next().find('button:eq(0)').css({
            'width':'100px',
            'opacity':'1',
            'transition':'all 0.4s',
        })
    }).blur(function(){
         $(this).next().find('button:eq(0)').css({
            'width':'0px',
            'opacity':'0',
            'overflow':'hidden',
            'transition':'all 0.4s',
        })
    });

        var num = null;
    $('.zkanswerComment').click(function(){
        if($(this).attr('info') == 1){
             num = $(this).html();

            $(this).parent().next().css({
                'opacity':'1',
                'height':'auto',
                'transition':'all 0.4s',
                'padding-bottom':'10px',
            });
            $(this).html('<span class="glyphicon glyphicon-comment" style="font-style:12px;"></span> 点击收起');
            $(this).attr('info','2');
        }else{
            $(this).parent().next().css({
                'opacity':'0',
                'height':'0',
                'overflow':'hidden',
                'transition':'all 0.4s',
            });
            $(this).html(''+num+'');
            $(this).attr('info','1');
        }

    })


    $('.sendAnswerPl').click(function(){
        var body = $(this).parent().prev().val();
        var answer_id = $(this).attr('answerid');
        var cr = $(this).parent().parent().parent();
        var thiss = $(this)
        $.ajax({
            url:'/comment/answer',
            data:{body:body,answer_id:answer_id},
            type:'get',
            success:function(mes){
                if(mes != '2'){
                    cr.before(`<div style="border-bottom:1px solid #E7EAF2;margin-top:10px;width:97%;margin-left:9px;height:auto;padding-bottom:5px;"><div style="height:30px;"><img src="/avatar/default.jpg" width="30px;" style="border-radius:3px;float:left" alt=""><span style="float:left;margin-left:5px;margin-top:3px;color:#1E1E1E">`+mes['name']+`</span><span style="float:right;margin-top:3px;margin-right:5px;color:#1E1E1E ">刚刚</span></div><div style="margin-top:10px;word-wrap:break-word;" id="answerCommentBody">`+body+`</div><div style="height:30px;margin-top:5px;"></div></div>`);
                    thiss.val('');
                }
            }
        })
    })
    //关注问题的ajax
    $('#guanzhu').click(function(){
        if($('#login').attr('flag') == '2'){
            // alert('请先登录');

            // layer.msg('请先登录');
            alert('请登录');
            return false;
        }
        

        var question_id = $(this).attr('questionid');

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

        $.ajax({
            url:'/follow/store',
            data:{id:question_id},
            type:'post',
            success:function(mes){
                if(mes == '1'){
                    $('#guanzhu').css({
                        'background-color':'#C3CCD9',
                    })
                    $('#guanzhu').html('已关注');

                    guanzhu(1);
                    var gz = parseInt($('#gzz').text());
                    $('#gzz').html(''+(gz+1)+'');
                    // layer.msg('已关注');
                    alert('已关注');
                }else{
                    $('#guanzhu').css({
                        'background-color':'#0F88EB',
                    });
                    $('#guanzhu').html('关注问题');
                    guanzhu(2);
                    var gz = parseInt($('#gzz').text());
                    $('#gzz').html(''+(gz-1)+'');
                     // layer.msg('已取消关注');
                     alert('已取消关注');
                }
            }
        })
    })

    //判断问题是否关注
    if($('#flag').attr('flag') == '1' ){
        $('#guanzhu').css({
            'background-color':'#C3CCD9',
        });
        $('#guanzhu').html('已关注');
        guanzhu(1);

    }else{
        guanzhu(2);
    }

    function guanzhu(a){
        if(a == 1){

            $('#guanzhu').mouseover(function(){

                $(this).css({
                    'background-color':'#ABB6C5',
                });

                $(this).html('取消关注');
            }).mouseout(function(){
                $(this).css({
                    'background-color':'#ABB6C5',
                });
                $(this).html('已关注');
            })
        }else{
            $('#guanzhu').mouseover(function(){
                $(this).css({
                    'background-color':'#0F76C9',
                });
                 $('#guanzhu').html('关注问题');
            }).mouseout(function(){
                 $('#guanzhu').html('关注问题');
                $(this).css({
                    'background-color':'#0F88EB',
                    
                })
            })
        }
    }


//关注用户
    $('#guanzhuU').click(function(){
        if($('#login').attr('flag') == '2'){
            // alert('请先登录');
            layer.msg('请先登录');
            return false;
        }
        

        var user_id = $(this).attr('userid');

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

        $.ajax({
            url:'/follow/'+user_id+'/user',
            type:'get',
            success:function(mes){
                if(mes == '1'){
                    $('#guanzhuU').css({
                        'background-color':'#C3CCD9',
                    })
                    $('#guanzhuU').html('已关注');

                    guanzhuU(1);
                }else{
                    $('#guanzhuU').css({
                        'background-color':'#0F88EB',
                    });
                    $('#guanzhuU').html('<span class="glyphicon glyphicon-plus"></span>  关注他');
                    guanzhuU(2);
                }
            }
        })
    })

    if($('#guanzhuU').attr('flag') == '1'){
        $('#guanzhuU').css({
            'background-color':'#C3CCD9',
        });
        $('#guanzhuU').html('已关注');
        guanzhuU(1);

    }else{
        guanzhuU(2);
    }

        function guanzhuU(a){
        if(a == 1){

            $('#guanzhuU').mouseover(function(){

                $(this).css({
                    'background-color':'#ABB6C5',
                });

                $(this).html('取消关注');
            }).mouseout(function(){
                $(this).css({
                    'background-color':'#ABB6C5',
                });
                $(this).html('已关注');
            })
        }else{
            $('#guanzhuU').mouseover(function(){
                $(this).css({
                    'background-color':'#0F76C9',
                });
                 $('#guanzhuU').html('<span class="glyphicon glyphicon-plus"></span>  关注他');
            }).mouseout(function(){
                 $('#guanzhuU').html('<span class="glyphicon glyphicon-plus"></span>  关注他');
                $(this).css({
                    'background-color':'#0F88EB',
                    
                })
            })
        }
    }


    // //回答不能为空
    $('.btn-block').click(function(){
        var html = ue.getContent();
        if(html == ''){
            $('#tipA').css({
                'opacity':'1',
                'transition':'all 0.4s',
            });

            return false;
        }
    })

    //控制回答框的收缩
    $('#answer').click(function(){

        if($(this).attr('lg') =='2'){
            layer.msg('请先登录');
            // alert('请先登录');
            return false;
        }
        if($(this).attr('flag') == '1'){

            $('#hd').css({
                'height':'auto',
                'transition':'all 0.4s',
            })
            $(this).attr('flag','2');
        }else{
            $('#hd').css({
                'height':'0px',
                'overflow':'hidden',
                'transition':'all 0.4s',
            })
            $(this).attr('flag','1');
        }
    })

    // 加载百度编辑器
    var ue = UE.getEditor('container', {
            toolbars: [
                    ['bold', 'italic', 'underline', 'strikethrough', 'blockquote', 'insertunorderedlist', 'insertorderedlist', 'justifyleft','justifycenter', 'justifyright',  'link', 'insertimage', 'fullscreen']
                ],
            elementPathEnabled: false,
            enableContextMenu: false,
            autoClearEmptyNode:true,
            wordCount:false,
            imagePopup:false,
            autotypeset:{ indent: true,imageBlockLine: 'center' }
        });
    ue.ready(function() {
        ue.execCommand('serverparam', '_token', '{{ csrf_token() }}'); // 设置 CSRF token.
    });



    var pic = document.getElementsByClassName('pic');

    for(var a = 0;a<pic.length;a++){

        var img = pic[a].getElementsByTagName('img');

        for(var i=0;i<img.length;i++){
           img[i].setAttribute('class','img-responsive'); 
        }
        
    }
    

    for(var a = 0;a < $('.sl').length;a++){ 

        if($('.sl:eq('+a+') img').length != 0){

            $('.sl:eq('+a+') img:eq(0)').appendTo($('.sl:eq('+a+') div:eq(0)'));
            $('.sl:eq('+a+') img:eq(0)').css({'height':'180px'});
        }else{

            $('.sl:eq('+a+') div:eq(0)').css({

                'display':'none',

            });
            $('.sl:eq('+a+') div:eq(1)').css({

                'width':'95%',

            });


        }

        $('.sl:eq('+a+') div:eq(1)').html($('.sl:eq('+a+')').text());

        $('.sl:eq('+a+') div:eq(2)').remove();
    }

    $('.zk').mouseover(function(){

        $(this).css({
            'cursor':'pointer',
            'color':'0f88eb',
            'transition':'all 0.4s',
        });

    }).mouseout(function(){
        $(this).css({
            'color':'636B6F',
            'transition':'all 0.4s',
        });        
    })


    $('.zk').click(function(){

        if($(this).attr('info') == '1'){

           $(this).parent().prev().prev().css({
                'height':'0px',
                'opacity':'0',
                'overflow':'hidden',
                'padding':'0px',
           });

            $(this).parent().prev().css({
                // 'display':'block',
                'height':'auto',
                'transition':'all 0.3s',
                'opacity':'1',
                'padding':'15px',

            });

            $(this).attr('info','0');
            $(this).text('∧ 点击收起');

        }else{

            $(this).parent().prev().prev().css({
                'height':'240px',
                'overflow':'hidden',
                'opacity':'1',
                'padding':'15px',
            });

            $(this).parent().prev().css({
                'height':'0px',
                // 'display':'none',
                'overflow':'hidden',
                'opacity':'0',
                'padding':'0px',
            });

            $(this).attr('info','1');
            $(this).text('∨ 点击展开');

        }
 

    })

 $('.zkQ').mouseover(function(){

        $(this).css({
            'cursor':'pointer',
            'color':'0f88eb',
            'transition':'all 0.4s',
        });

    }).mouseout(function(){
        $(this).css({
            'color':'636B6F',
            'transition':'all 0.4s',
        });        
    })


    $('.zkQ').click(function(){

        if($(this).attr('info') == '1'){

           $(this).parent().prev().prev().css({
                'height':'0px',
                'opacity':'0',
                'overflow':'hidden',
                'padding':'0px',
           });

            $(this).parent().prev().css({
                // 'display':'block',
                'height':'auto',
                'transition':'all 0.3s',
                'opacity':'1',
                'padding':'15px',

            });

            $(this).attr('info','0');
            $(this).text('∧ 点击收起');

        }else{

            $(this).parent().prev().prev().css({
                'height':'80px',
                'overflow':'hidden',
                'opacity':'1',
                'padding':'15px',
            });

            $(this).parent().prev().css({
                'height':'0px',
                // 'display':'none',
                'overflow':'hidden',
                'opacity':'0',
                'padding':'0px',
            });

            $(this).attr('info','1');
            $(this).text('∨ 点击展开');

        }
 

    })

//鼠标移动到头像出现个人资料
    function newload(){

    var opts = {

                lines: 9, // The number of lines to draw

                length: 0, // The length of each line

                width: 10, // The line thickness

                radius: 15, // The radius of the inner circle

                corners: 1, // Corner roundness (0..1)

                rotate: 0, // The rotation offset

                color: '#777777', // #rgb or #rrggbb

                speed: 1, // Rounds per second

                trail: 60, // Afterglow percentage

                shadow: false, // Whether to render a shadow

                hwaccel: false, // Whether to use hardware acceleration

                className: 'spinner', // The CSS class to assign to the spinner

                zIndex: 2e9, // The z-index (defaults to 2000000000)

                top: 'auto', // Top position relative to parent in px

                left: 'auto' // Left position relative to parent in px

            };

            var target = document.getElementById('foo');

            var spinner = new Spinner(opts).spin(target);
    }

    $('.user').mouseover(function(){

        var userid = $(this).attr('userid');
        var thiss = $(this);
        $(this).parent().next().css({
            'height':'200px',
            'opacity':'1',
            'overflow':'visible',
            'transition':'all 0.3s',
        })
          thiss.parent().next().append(`  
            <div id="foo" style="width:100px; height:200px; margin-left:120px;">

             </div>
        `);

        newload();

        $.ajax({
            url:'/user/getUser',
            data:{userid:userid},
            type:'get',
            success:function(mes){
                thiss.parent().next().empty();

                    thiss.parent().next().append(`  
                                <div style="height:70px;border-bottom:1px solid #E8E5E5">
                                    <a href="/user/index/`+mes['1']['id']+`"><img src="`+mes['1']['avatar']+`" width="70px;" style="border-radius:5px;position:absolute;top:-15px;left:20px;" alt=""></a>
                                    <div style="margin-left:105px;height:100%;">
                                        <div style="height:50%;line-height:35px;color:#1A1A1A">`+mes['1']['name']+`</div>
                                        <div style="height:50%;color:#1A1A1A">`+mes['1']['created_at']+`加入知乎</div>
                                    </div>
                                </div>

                                 <div style="height:70px;">
                                    <div style="width:50%;height:100%;float:left;">
                                        <div style="height:50%;width:100%;text-align:center;color:#8590A6;font-size:15px;padding-top:5px;padding-left:20px;">回答</div>
                                        <div style="height:50%;width:100%;text-align:center;font-size:18px;font-weight:bold;color:black;padding-left:20px;">`+mes['1']['answers_count']+`</div>
                                    </div>
                                    <div style="width:50%;height:100%;float:left;">
                                        <div style="height:50%;width:100%;text-align:center;color:#8590A6;font-size:15px;padding-top:5px;padding-right:20px;">关注者</div>
                                        <div style="height:50%;width:100%;text-align:center;font-size:18px;font-weight:bold;color:black;padding-right:20px;">`+mes['1']['followings_count']+`</div>
                                    </div>
                                    <div>
                                         <button type="button" id="guanzhuA" flag="`+mes['0']+`" class="btn btn-default navbar-btn" userid="`+mes['1']['id']+`" style=""><span class="glyphicon glyphicon-plus"></span>  关注他</button>
                                         <button type="button" id="doc-prompt-toggle"  class="btn btn-default navbar-btn" style="margin-right:30px;width:125px;"><span class="glyphicon glyphicon-send" ></span>  私信他</button>
                                    </div>
                                </div>
                            `);
                      
                    gzA();
                    if($('#guanzhuA').attr('flag') == 'true'){
                       $('#guanzhuA').css({
                            'background-color':'#C3CCD9',
                        });
                        $('#guanzhuA').html('已关注');
                        guanzhu(1);
                    }else{
                        guanzhu(2);
                    }
                
            }
        })

    }).mouseout(function(){ 
        var thiss = $(this);

        $(this).parent().next().mouseover(function(){
            thiss.attr('flag','2');
        }).mouseleave(function(){

            thiss.attr('flag','1');
               $(this).css({
                    'height':'0px',
                    'opacity':'0',
                    'overflow':'hidden',
                    'transition':'all 0.3s',
                })
                $(this).empty();
        });

        setTimeout(function(){

            if(thiss.attr('flag') == '1'){
                $(this).parent().next().css({
                    'height':'0px',
                    'opacity':'0',
                    'overflow':'hidden',
                    'transition':'all 0.3s',
                })
                $(this).parent().next().empty();

            }

        }.bind($(this)),400);

    })

//鼠标移入关注
function gzA(){

    $('#guanzhuA').click(function(){
        if($('#login').attr('flag') == '2'){
            // alert('请先登录');
            layer.msg('请先登录');
            return false;
        }
        

        var user_id = $(this).attr('userid');

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

        $.ajax({
            url:'/follow/'+user_id+'/user',
            type:'get',
            success:function(mes){
                if(mes == '1'){
                    $('#guanzhuA').css({
                        'background-color':'#C3CCD9',
                    })
                    $('#guanzhuA').html('已关注');

                    guanzhuA(1);
                }else{
                    $('#guanzhuA').css({
                        'background-color':'#0F88EB',
                    });
                    $('#guanzhuA').html('<span class="glyphicon glyphicon-plus"></span>  关注他');
                    guanzhuA(2);
                }
            }
        })
    })
}


    function guanzhuA(a){
        if(a == 1){

            $('#guanzhuA').mouseover(function(){

                $(this).css({
                    'background-color':'#ABB6C5',
                });

                $(this).html('取消关注');
            }).mouseout(function(){
                $(this).css({
                    'background-color':'#ABB6C5',
                });
                $(this).html('已关注');
            })
        }else{
            $('#guanzhuA').mouseover(function(){
                $(this).css({
                    'background-color':'#0F76C9',
                });
                 $('#guanzhuA').html('<span class="glyphicon glyphicon-plus"></span>  关注他');
            }).mouseout(function(){
                 $('#guanzhuA').html('<span class="glyphicon glyphicon-plus"></span>  关注他');
                $(this).css({
                    'background-color':'#0F88EB',
                    
                })
            })
        }
    }



    
}
</script>
