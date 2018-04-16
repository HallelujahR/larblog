@extends('layouts.app')
<link rel="stylesheet" href="{{asset('avatar/css/amazeui.min.css')}}">
<link rel="stylesheet" href="{{asset('avatar/css/amazeui.cropper.css')}}">
<link rel="stylesheet" href="{{asset('avatar/css/custom_up_img.css')}}">
<link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/font-awesome.4.6.0.css">
<link rel="stylesheet" href="{{asset('xxk/tabulous.css')}}">
<link rel="stylesheet" href="{{asset('cropper/cropper.min.css')}}">


@section('css')
    <style type="text/css">            
        .up-img-cover {width: 100px;height: 100px;}
        .up-img-cover img{width: 100%;}
        .up-img-txt label{font-weight: 100;margin-top: 50px;}
        
        .up-img-cover{
            height:170px;
            width:170px;
            position:absolute;
            top:-50px;
            left:20px;
            border-radius:10px;

        }
        #topPic{
            height:125px;
            box-shadow: rgb(234, 237, 237) 0px 0px 5px;
            background-color:#99CCCC;
        }
        .navbar-btn:hover{
            background-color:#F1F7FC;
        }
        #detail:hover{
            cursor:pointer;
        }
        #fm{
            background-color: rgba(0,0,0,0.0);
            border:1px solid #827A80;
            color:#827A80;
            position:absolute;
            top:10px;
            right:10px;
        }
        #fm:hover{
            background-color:rgba(0,0,0,0.1);
        }
        #xg{
            width:163px;height:163px;background-color:black;position:absolute;top:4px;left:4px;
            border-radius:8px;
            opacity:0;
        }
        #xg1{
            width:163px;height:163px;position:absolute;top:4px;left:4px;
            border-radius:8px;
            opacity:0;
        }
        #xg1:hover{
            cursor:pointer;
        }
        .xxkLi{
            background-color:white;
            height:50px;

        }
        .xxkA{
            background-color:white;
            /*border:1px solid red;*/
            height:50px;
          
        }
        .myan{
            border-bottom:1px solid #F0F2F7;display:block;
            font-size:14px;
            line-height:40px;
            color:black;
            font-weight:bold;
            padding-left:0px;
            height:40px;
        }
        #tabs-1 span{
            display:block;
        }
        #tabs-2 span{
            display:block;
        }
        #tabs-3 span{
            display:block;
        }
        #tabs-4 span{
            display:block;
        }
        #tabs-5 span{
            display:block;
        }
        #tabs-0 span{
            display:block;
        }
        #guanzhu{
            width:100px;
            background-color:#0F88EB;
            color:white;
            float:right;
            margin-top:-30px;
        }
        
        #sendMessage{
            width:200px;
            background-color:#0F88EB;
            color:white;
            border-radius:5px;
            margin-bottom:10px;
        }
        #doc-prompt-toggle{
            width:100px;
            float:right;
            margin-top:-30px;
        }
        #guanzhu:hover{
            background-color:#0F76C9;

        }

        .bguanzhu{
            width:100px;
            background-color:#0F88EB;
            color:white;
            float:right;
        }
        .gzTop{
         width:100px;
            background-color:#0F88EB;
            color:white;
            float:right;   
        }
        .gzTop:hover{
            background-color:#0F76C9;
            color:white;

        }
        .bguanzhu:hover{
            background-color:#0F76C9;

        }
        .bgz:hover{
            cursor:pointer;
        }
        #guanzhuA{
            width:100px;
            background-color:#0F88EB;
            color:white;
            margin-left:25px;
        }
        #guanzhule:hover{
            cursor:pointer;
        }
        #guanzhuzhe:hover{
            cursor:pointer;
        }

        .followQuestion:hover{
            cursor:pointer;
        }
    </style>
@endsection
@section('content')

<div class="container" style="margin-top:-5px;margin-bottom:10px;">
    <div class="col-md-10  col-md-offset-1 ">
        <div class="row">
            <div id="topPic" style="position:relative;height:220px;overflow:hidden;">
                     
                @if($userdetails->cover != 'null')
                    <img src="{{$userdetails->cover}}" alt="" id="image">
                @endif
                
                @if(Auth::id() === $user->id)
                <button type="button" id="fm" class="btn btn-default" style="" ><span class='glyphicon glyphicon-camera'></span>&nbsp;&nbsp;编辑封面图片</button>
                @endif

            </div>
                <button style='position:absolute;background-color:#0FA5F2;border:1px solid #0FA5F2;letter-spacing:1px;color:#fff;right:100px;top:10px;font-weight:bold;display:none;' class="btn btn-default" id='upload_qd'>确 定</button>

                <button style='position:absolute;background-color:#0FA5F2;border:1px solid #0FA5F2;letter-spacing:1px;color:#fff;right:10px;top:10px;font-weight:bold;display:none;' class="btn btn-default" id='upload_qq'>取 消</button>
            <input type="file" name="" id="bb_inp" style="display:none;">
            <div style="height:auto;background-color:white;position:relative;box-shadow: rgb(234, 237, 237) 0px 0px 5px;">
                
                <div class="up-img-cover" 
                    @if(Auth::check()&&Auth::id() === $user->id)
                       id="up-img-touch" 
                    @endif
                 >
                    @if(Auth::check()&&Auth::id() === $user->id)
                    <div id="xg">
                    </div>
                    <div id="xg1">
                        <div style="font-size:40px;color:white;height:50%;text-align:center;padding-top:25%;">
                            <span class='glyphicon glyphicon-camera'></span>
                        </div>
                        <div style="height:50%;text-align:center;padding-top:10%;color:white">点击修改头像</div>
                    </div>
                    @endif
                    <img class="am-circle" src="{{$user->avatar}}"  width="168px" alt="" style="border-radius:10px;border:4px solid white">
                </div>
                
                <div style="padding-top:10px;">
                    <span style="margin-left:220px;font-size:30px;font-weight:bold;color:#666666;">{{$user->name}}</span>
                </div>
                
                @if($userdetails->introduce != null)
                <div style="margin-left:220px;">
                    <div style="width:100px;float:left;font-size:15px;font-weight:bold;">个性签名</div>
                    <div style="float:left">{{$userdetails->introduce}}</div>
                </div>
                @endif

                <div id="personDetail" flag="1" style="width:70%;margin-left:220px;height:20px;margin-top:0px;height:0px;overflow:hidden">

                    <div style="height:28px;margin-top:5px;">
                        <div style="width:100px;float:left;font-size:15px;font-weight:normal;color:black;">注册时间</div>
                        <div style="float:left;">{{$user->created_at}}</div>
                    </div>

                    @if($userdetails->industry !=null)
                    <div style="height:28px;margin-top:5px;">
                        <div style="width:100px;float:left;font-size:15px;font-weight:normal;color:black;">行业</div>
                        <div style="float:left;">{{$userdetails->industry}}</div>
                    </div>
                    @endif

                    @if($userdetails->career !=null)
                    <div style="height:28px;margin-top:5px;">
                        <div style="width:100px;float:left;font-size:15px;font-weight:normal;color:black;">职业</div>
                        <div style="float:left;">{{$userdetails->career}}</div>
                    </div>
                    @endif

                    @if($userdetails->domicile !=null)
                    <div style="height:28px;margin-top:5px;">
                        <div style="width:100px;float:left;font-size:15px;font-weight:normal;color:black;">居住地</div>
                        <div style="float:left;">{{$userdetails->domicile}}</div>
                    </div>
                    @endif
                </div>

                <div style="width:70%;margin-left:220px;height:40px;margin-top:25px;">
                    <div id="detail" style="margin-right:200px;margin-top:10px;">∨ 查看详细资料</div>
                    <!-- ∧ -->
                    @if(Auth::id() === $user->id)
                    <a href="{{action('UserController@userDetail')}}"><button type="button" class="btn btn-default navbar-btn" id ="information" style="border:1px solid #0F88EB;color:#0F88EB;float:right;margin-top:-30px;">编辑个人资料</button></a>
                    @else
                     <button type="button" id="doc-prompt-toggle"  class="btn btn-default navbar-btn" style="margin-left:10px;"><span class="glyphicon glyphicon-send" ></span>  私信他</button>
                    <button type="button" id="guanzhu" flag="{{AUth::check()&&Auth::user()->followed_user($user->id)}}" userid = "{{$user->id}}"class="btn btn-default navbar-btn" style=""><span class="glyphicon glyphicon-plus"></span>  关注他</button>
                    @endif
                </div>
            </div>
        </div>
    </div>   
</div>

<!-- 私信 -->
<div class="am-modal am-modal-prompt" tabindex="-1" id="my-prompt">
  <div class="am-modal-dialog"  style="width:400px;position:relative;">
    <span id="closeMes" class="am-modal-btn glyphicon glyphicon-remove" style="position:absolute;top:0px;right:-30px;color:white;border:1px none white;font-size:10px;"></span>
    <div class="am-modal-hd" style="height:100px;color:black;line-height:0px;line-height:80px;font-weight:bold;font-size:20px;">发送私信</div>
    <div style="height:30px;padding-left:20px;padding-right:20px;">
        <div style="float:left;color:black;font-weight:bold">{{$user->name}}</div>
        <!-- /////////////////////////////////////////////// -->
        <div><a href="javascript:void(0)" class="mes closes" userid="{{$user->id}}" style="color:#1D6EB5;text-decoration:none;float:right" data-toggle="modal" data-target="#myModal">查看私信记录</a></div>
    </div>
    <div class="am-modal-bd" style="border:1px none white;">
        <textarea name="messageBody" id="" cols="20" rows="10" id="messageBody"class="am-modal-prompt-input" style="resize: none;"></textarea>
    </div>
      <!-- <span class="am-modal-btn">取消</span> -->
       <button type="button" class="btn btn-default navbar-btn am-modal-btn" id="sendMessage"  toid="{{$user->id}}"style="margin-left:10px;">发送</button>
       <!-- <button type="button" class="btn btn-default navbar-btn am-modal-btn" style="margin-left:10px;">取消</button> -->
      <!-- <span class="am-modal-btn">提交</span> -->
  </div>
</div>
<!-- 私信结束 -->

<!-- 修改头像 -->

        <!--图片上传框-->
        <div class="am-modal am-modal-no-btn up-modal-frame" tabindex="-1" id="up-modal-frame">
          <div class="am-modal-dialog up-frame-parent up-frame-radius">
            <div class="am-modal-hd up-frame-header">
               <label>修改头像</label>
              <a href="javascript: void(0)" class="am-close am-close-spin" data-am-modal-close>&times;</a>
            </div>
            <div class="am-modal-bd  up-frame-body">
              <div class="am-g am-fl">
                
                <div class="am-form-group am-form-file">
                  <div class="am-fl">
                    <button type="button" class="am-btn am-btn-default am-btn-sm">
                      <i class="am-icon-cloud-upload"></i> 选择要上传的文件</button>
                  </div>
                  <input type="file" class="up-img-file">
                </div>
              </div>
              <div class="am-g am-fl">
                <div class="up-pre-before up-frame-radius">
                    <img alt="" src="{{$user->avatar}}" class="up-img-show" id="up-img-show" >
                </div>
                <div class="up-pre-after up-frame-radius">
                </div>
              </div>
              <div class="am-g am-fl">
                <div class="up-control-btns">
                    <span class="am-icon-rotate-left"   id="up-btn-left"></span>
                    <span class="am-icon-rotate-right"  id="up-btn-right"></span>
                    <span class="am-icon-check up-btn-ok" url="/user/updateAvatar"
                        parameter="{width:'170',height:'170'}">
                    </span>
                </div>
              </div>
              
            </div>
          </div>
        </div>
        
        <!--加载框-->
        <div class="am-modal am-modal-loading am-modal-no-btn" tabindex="-1" id="up-modal-loading">
          <div class="am-modal-dialog">
            <div class="am-modal-hd">正在上传...</div>
            <div class="am-modal-bd">
              <span class="am-icon-spinner am-icon-spin"></span>
            </div>
          </div>
        </div>
        
        <!--警告框-->
        <div class="am-modal am-modal-alert" tabindex="-1" id="up-modal-alert">
          <div class="am-modal-dialog">
            <div class="am-modal-hd">信息</div>
            <div class="am-modal-bd"  id="alert_content">
                      成功了
            </div>
            <div class="am-modal-footer">
              <span class="am-modal-btn">确定</span>
            </div>
          </div>
        </div>


<!-- 结束修改头像 -->

<!-- 内容部分 -->
    <div class="container" style="margin-top:0px;margin-bottom:10px;padding:0px;">
        <div class="col-md-10  col-md-offset-1 " style="">
            <div class="col-md-8" style="padding:0px;padding-right:10px;">
                <!-- Demo start -->
                <div class="tabs" style="margin:0px;width:100%;background-color:white;box-shadow: rgb(234, 237, 237) 0px 0px 5px;">
                    <ul style="margin:0px;background-color:white;border-bottom:1px solid #F0F2F7;">

                        <li class="xxkLi"><a class="xxkA" id="tabss-0" style="background-color:white;padding-right:22px;
            padding-left:22px;" href="#tabs-0" title="">动态</a></li>
                        <li class="xxkLi"><a class="xxkA" id="tabss-1" style="background-color:white;padding-right:22px;
            padding-left:22px;" href="#tabs-1" title="">回答({{$user->answers_count}})</a></li>
                        <li class="xxkLi"><a class="xxkA" id="tabss-2"  style="background-color:white;padding-right:22px;
            padding-left:22px;"href="#tabs-2" title="">提问({{$user->questions_count}})</a></li>
                        <li class="xxkLi"><a class="xxkA" id="tabss-3"  style="background-color:white;padding-right:22px;
            padding-left:22px;"href="#tabs-3" title="">我关注的({{$user->followers_count}})</a></li>
                        <li class="xxkLi"><a class="xxkA" id="tabss-4"  style="background-color:white;padding-right:22px;
            padding-left:22px;"href="#tabs-4" title="">关注我的({{$user->followings_count}})</a></li>
                        <li class="xxkLi"><a class="xxkA" id="tabss-5"  style="background-color:white;padding-right:22px;
            padding-left:22px;"href="#tabs-5" title="">关注话题({{$topics->count()}})</a></li>
                    </ul>

                    <div id="tabs_container" style="background-color:white;padding:0px;">
                        
                        <div id="tabs-0" class="tabs_container" style="width:97%;margin:0px;padding:0px;margin-left:10px;">
                            <span class="myan" style="border-bottom:1px solid #F6F6F6">动态</span>
                                
                                    @foreach($dynamics['followQuestion'] as $followQuestion)
                                    <span style="border-bottom:1px solid #F6F6F6;height:90px;padding-top:10px;padding-bottom:10px;">
                                        <span>关注了问题</span>
                                        <span style="margin-top:10px;">
                                            <span class="followQuestion" style="color:#1A1A1A;font-size:18px;font-weight:bold;" questionid = '{{$followQuestion->id}}'>{{$followQuestion->title}}</span>
                                        </span>
                                    </span>
                                    @endforeach
                                
                                @foreach($dynamics['createQuestion'] as $createQuestion)
                                <span style="border-bottom:1px solid #F6F6F6;height:90px;padding-top:10px;padding-bottom:10px;">
                                    <span>添加了问题</span>
                                    <span style="margin-top:10px;">
                                        <span class="CreateQuestion" style="color:#1A1A1A;font-size:18px;font-weight:bold;" questionid='{{$createQuestion->id}}'>{{$createQuestion->title}}</span>
                                    </span>
                                </span>
                                @endforeach
                                
                                @foreach($dynamics['followTopic'] as $followTopic)
                                <span style="border-bottom:1px solid #F6F6F6;height:120px;padding-top:10px;padding-bottom:10px;">
                                    <span>关注了话题</span>
                                    <span style="margin-top:10px;">
                                        <span style="float:left;margin-right:20px;">
                                            <img src="{{$followTopic->topic_pic}}" class="followTopicPic" topicid="25" style="border-radius:5px;" width="60px;"alt="">
                                        </span>
                                        <span style="float:left">
                                            <span class="followTopic" style="color:#1A1A1A;font-size:18px;font-weight:bold;" topicid = '{{$followTopic->id}}'>{{$followTopic->name}}</span>
                                            <span style="color:#1A1A1A;font-size:14px;overflow:hidden;margin-top:5px;" >{{$followTopic->desc}}</span>
                                        </span>
                                    </span>
                                </span>   
                                @endforeach

                                @foreach($dynamics['followUser'] as $followUser)
                                <span style="border-bottom:1px solid #F6F6F6;height:120px;padding-top:10px;padding-bottom:10px;">
                                    <span>关注了用户</span>
                                    <span style="margin-top:10px;">
                                        <span style="float:left;margin-right:20px;">
                                            <img src="{{$followUser->avatar}}" class="followUserPic" userid="11" style="border-radius:5px;" width="60px;"alt="">
                                        </span>
                                        <span style="float:left">
                                            <span class="followUser" style="color:#1A1A1A;font-size:18px;font-weight:bold;" userid='11'>{{$followUser->name}}</span>
                                            <span style="color:#1A1A1A;font-size:14px;overflow:hidden;margin-top:5px;" >{{$followUser->created_at}}加入知乎</span>
                                        </span>
                                    </span>
                                </span>      
                                @endforeach
                                
                            @foreach($dynamics['questionAnswer'] as $answer)
                                <span style="height:auto;padding-top:10px;padding-bottom:10px;">
                                    <span>回答了问题</span>
                                        <span style="border-bottom:1px solid #F0F2F7;height:auto;">
                                            <span style="color:black;font-size:18px;font-weight:bold;margin-bottom:5px;margin-top:10px;">
                                               <a href="{{action('QuestionController@show',array('id'=>$answer->id))}}" class="answerQ" style="color:black">{{$answer->title}}</a>
                                            </span>

                                            <span style="height:50px;position:relative">
                                                <span style="float:left;margin-top:5px;"><img src="{{$user->avatar}}" flag="1" class="user" userid="{{$user->id}}" width="35px;" alt="" style="border-radius:3px;"></span>
                                                    
                                                    <span class="userB" style="background-color:#F5F8FA;height:0px;overflow:hidden;opacity:0;width:300px;position:absolute;box-shadow:0px 0px 5px #7E8179;border-radius:5px;top:0px;left:60px;z-index:10000" flag="1">
                                                        
                                                    </span>


                                                <span style="float:left;height:100%;">
                                                    <span style="margin-left:10px;margin-top:3px;font-weight:bold;font-size:15px;">{{$user->name}}</span>
                                                    <span></span>
                                                </span>
                                            </span>

                                            <span style="width:100%;">
                                                <span style="height:50px;overflow:hidden;color:black" class="pic" >{!!$answer->body!!}</span>
                                                <span style="width:100%;height:30px;margin-bottom:10px;">
                                                    <span style="float:right;height:100%;line-height:30px;" flag="1" class="commentAnswer"  info="tabss-0">∨ 点击展开</span>
                                                </span>
                                            </span>
                                        </span>
                                </span>    
                            @endforeach
                            

                            @foreach($dynamics['voteup'] as $vote)
                                <span style="border-bottom:1px solid #F6F6F6;height:auto;padding-top:10px;padding-bottom:10px;">
                                    <span>点赞评论</span>
                                        <span style="border-bottom:1px solid #F0F2F7;height:auto;">
                                            <span style="color:black;font-size:18px;font-weight:bold;margin-bottom:5px;margin-top:10px;">
                                               <a href="{{action('QuestionController@show',array('id'=>$vote->question_id))}}" class="answerQ" style="color:black">{{$vote->title}}</a>
                                            </span>

                                            <span style="height:50px;position:relative">
                                                <span style="float:left;margin-top:5px;"><img src="{{$vote->user_avatar}}" flag="1" class="user" userid="{{$vote->user_id}}" width="35px;" alt="" style="border-radius:3px;"></span>
                                                    
                                                    <span class="userB" style="background-color:#F5F8FA;height:0px;overflow:hidden;opacity:0;width:300px;position:absolute;box-shadow:0px 0px 5px #7E8179;border-radius:5px;top:0px;left:60px;z-index:10000" flag="1">
                                                        
                                                    </span>


                                                <span style="float:left;height:100%;">
                                                    <span style="margin-left:10px;margin-top:3px;font-weight:bold;font-size:15px;">{{$vote->name}}</span>
                                                    <span></span>
                                                </span>
                                            </span>

                                            <span style="width:100%;">
                                                <span style="height:50px;overflow:hidden;color:black" class="pic" >{!!$vote->answer!!}</span>
                                                <span style="width:100%;height:30px;margin-bottom:10px;">
                                                    <span style="float:right;height:100%;line-height:30px;" flag="1" class="commentAnswer"  info="tabss-0">∨ 点击展开</span>
                                                </span>
                                            </span>
                                        </span>
                                </span>    
                            @endforeach

                        </div>

                        <div id="tabs-1" class="tabs_container" style="width:97%;margin:0px;padding:0px;margin-left:10px;">
                            <span class="myan">我的回答</span>
                            @foreach($answers as $answer)
                                <span style="border-bottom:1px solid #F0F2F7;height:auto;">
                                    <span style="color:black;font-size:18px;font-weight:bold;margin-bottom:5px;margin-top:10px;">
                                       <a href="{{action('QuestionController@show',array('id'=>$answer->question->id))}}" class="answerQ" style="color:black">{{$answer->question->title}}</a>
                                    </span>
                                    <span style="height:50px;position:relative">
                                        <span style="float:left;margin-top:5px;"><img src="{{$user->avatar}}" flag="1" class="user" userid="{{$user->id}}" width="35px;" alt="" style="border-radius:3px;"></span>
                                            
                                            <span class="userB" style="background-color:#F5F8FA;height:0px;overflow:hidden;opacity:0;width:300px;position:absolute;box-shadow:0px 0px 5px #7E8179;border-radius:5px;top:0px;left:60px;z-index:10000" flag="1">
                                                
                                            </span>


                                        <span style="float:left;height:100%;">
                                            <span style="margin-left:10px;margin-top:3px;font-weight:bold;font-size:15px;">{{$user->name}}</span>
                                            <span></span>
                                        </span>
                                    </span>
                                    <span style="width:100%;">
                                        <span style="height:50px;overflow:hidden;color:black" class="pic" >{!!$answer->body!!}</span>
                                        <span style="width:100%;height:30px;margin-bottom:10px;">
                                            <span style="float:right;height:100%;line-height:30px;" flag="1" class="anzk"  info="tabss-1">∨ 点击展开</span>
                                        </span>
                                    </span>
                                </span>
                            @endforeach
                        </div>

                        <div id="tabs-2"  class="tabs_container" style="height:auto;width:97%;margin:0px;padding:0px;margin-left:10px;" >
                            <span class="myan" style="border-bottom:1px none white;position:relative;">我的提问</span>
                            @foreach($questions as $question)
                                <span style="border-top:1px solid #F0F2F7;height:auto;width:100%;margin-bottom:15px;">
                                    <span style="margin-bottom:5px;margin-top:10px;width:100%;">
                                        <span style="width:100%;color:black;font-size:18px;font-weight:bold;"><a href="{{action('QuestionController@show',array('id'=>$question->id))}}" class="ques"  style="color:black;">{{$question->title}}</a>
                                            <span class="glyphicon glyphicon-option-horizontal" aria-hidden="true" style="float:right;margin-top:5px;position:relative;font-size:10px;color:#636B6F;right:10px;top:-10px;" flag="true">
                                                <span class="list-group" style="width:60px;position:absolute;top:8px;right:-15px;box-shadow:0px 0px 3px #E3E3E3;opacity:0;height:0px;overflow:hidden;display:block" >
                                                  <a href="javascript:void(0)" class="list-group-item del" id="{{$question->id}}" del="tabss-2">
                                                    删除
                                                  </a>

                                                  <span class="edit" href="{{action('QuestionController@edit',array('id'=>$question->id))}}" ><a href="javascript:void(0)" class="list-group-item">编辑</a></span>
                                                
                                                </span>
                                            </span>
                                        </span>
                                        <span style="width:100%;">{{$question->created_at}} • {{$question->answers_count}}个回答 • {{$question->followers_count}}个关注</span>
                                    
                                    </span>
                                </span>
                            @endforeach
                        </div>
                        
                        <div id="tabs-3" class="tabls_container" style="width:97%;margin:0px;padding:0px;margin-left:10px;">
                            <span class="myan" style="border-bottom:1px none white;position:relative;">我关注的</span>  
                               @foreach($follows as $follow)
                                <span style="border-top:1px solid #F0F2F7;height:auto;width:100%;">
                                    <span style="margin-bottom:5px;margin-top:10px;width:100%;padding-left:10px;">
                                        <span style="width:100%;height:80px;position:relative">
                                            <span>
                                                <img src="{{$follow->avatar}}" class="bgz user" flag='1' userid="{{$follow->id}}"  href="{{action('UserController@index',array('id'=>$follow->id))}}" width="50px;" style="float:left;margin-top:5px;margin-right:15px;border-radius:5px;" alt="">
                                            </span>

                                             <span class="userB" style="background-color:#F5F8FA;height:0px;overflow:hidden;opacity:0;width:300px;position:absolute;box-shadow:0px 0px 5px #7E8179;border-radius:5px;top:-30px;left:60px;z-index:10000" flag="1">
                         
                                            </span>

                                            <span style="float:left;">
                                                <span style="font-size:18px;font-weight:bold;">{{$follow->name}}</span>
                                                <span style="">
                                                    个性签名
                                                </span>
                                                <span style="width:100%;">{{$follow->questions_count}}个问题 • {{$follow->answers_count}}个回答 • {{$follow->followers_count}}个关注</span>
                                            </span>
                                            <span style="padding-top:10px;">
                                                <button type="button" flag="{{AUth::check()&&Auth::user()->followed_user($follow->id)}}" userid = "{{$follow->id}}"class="btn btn-default navbar-btn bguanzhu" ><span class="glyphicon glyphicon-plus" style="display:inline"></span>  关注他</button>
                                            </span>
                                        </span>
                                    
                                    </span>
                                </span>
                            @endforeach
                        </div>

                        <div id="tabs-4" class="tabls_container" style="width:97%;margin:0px;padding:0px;margin-left:10px;">
                            <span class="myan" style="border-bottom:1px none white;position:relative;">关注我的</span>  
                               @foreach($followeds as $followed)
                                <span style="border-top:1px solid #F0F2F7;height:auto;width:100%;">
                                    <span style="margin-bottom:5px;margin-top:10px;width:100%;">
                                        <span style="width:100%;height:80px;padding-left:10px;">
                                            <img src="{{$followed->avatar}}" class="bgz"  href="{{action('UserController@index',array('id'=>$followed->id))}}" width="50px;" style="float:left;margin-top:10px;margin-right:15px;border-radius:5px;" alt="">

                                            <span style="float:left;height:100%;">
                                                <span style="font-size:18px;font-weight:bold;">{{$followed->name}}</span>
                                                <span style="">
                                                    个性签名
                                                </span>
                                                <span style="width:100%;">{{$followed->questions_count}}个问题 • {{$followed->answers_count}}个回答 • {{$followed->followers_count}}个关注</span>
                                            </span>
                                             <span style="padding-top:10px;">
                                                <button type="button" flag="{{AUth::check()&&Auth::user()->followed_user($followed->id)}}" userid = "{{$followed->id}}"class="btn btn-default navbar-btn bguanzhu" ><span class="glyphicon glyphicon-plus" style="display:inline"></span>  关注他</button>
                                            </span>
                                        </span>
                                    
                                    </span>
                                </span>
                            @endforeach
                        </div>

                        <div id="tabs-5" class="tabls_container" style="width:97%;margin:0px;padding:0px;margin-left:10px;">
                            <span class="myan" style="border-bottom:1px none white;position:relative;">关注话题</span>  
                               @foreach($topics as $topic)
                                <span style="border-top:1px solid #F0F2F7;height:auto;width:100%;">
                                    <span style="margin-bottom:5px;margin-top:10px;width:100%;">
                                        <span style="width:100%;height:80px;padding-left:10px;">
                                            <img src="{{$topic->topic_pic}}" class="bgz" width="50px;" style="float:left;margin-top:10px;margin-right:15px;border-radius:5px;" alt="">

                                            <span style="float:left;height:100%;padding-top:10px;">
                                                <span style="font-size:18px;font-weight:bold;">{{$topic->name}}</span>
                                                <span style="">
                                                    {{$topic->desc}}
                                                </span>
                                            </span>

                                            <span style="padding-top:10px;">
                                                <button type="button" class="btn btn-default navbar-btn gzTop" flag="1" topid="{{$topic->id}}" style="background-color:#ABB6C5" ><span class="glyphicon glyphicon-plus" style="display:inline"></span>  取消关注</button>
                                            </span>
                                        </span>
                                        
                                    </span>
                                </span>
                            @endforeach
                        </div>
                        
                    </div>
                </div>
                <!-- Demo end -->        
            </div>
            <div class="col-md-4" style="padding:0px;">
                <div style="height:100px;box-shadow: rgb(234, 237, 237) 0px 0px 5px;">
                    <div style="padding-left:10px;height:50px;line-height:50px;background-color:white;border-bottom:1px solid #F0F2F7;font-size:16px;font-weight:bold;">个人成就</div>
                    <div style="height:50px;background-color:white;"></div>
                </div>
                <div style="margin-top:10px;height:80px;background-color:white;">
                    <div  style="height:100%;width:50%;float:left;border-right:1px solid ##F0F2F7">
                        <div style="height:50%;width:100%;text-align:center;border:blue;line-height:50px;font-size:15px;">关注了</div>
                        <div style="height:50%;width:100%;text-align:center;font-size:20px;font-weight:bold;color:black" id="guanzhule">{{$user->followers_count}}</div>
                    </div>
                    <div style="height:100%;width:50%;float:left;border-right:1px solid ##F0F2F7">
                        <div style="height:50%;width:100%;text-align:center;border:blue;line-height:50px;font-size:15px;">关注者</div>
                        <div style="height:50%;width:100%;text-align:center;font-size:20px;font-weight:bold;color:black" id="guanzhuzhe" >{{$user->followings_count}}</div>
                    </div>
                </div>

                <div style="margin-top:10px;">
                    <div style="height:50px;border-top:1px solid #E6E6E6;line-height:50px;padding-left:10px;padding-right:10px;">
                        <span style="">关注的话题</span>
                        <span style="float:right;font-size:16px;">0</span>
                    </div>
                      <div style="height:50px;border-top:1px solid #E6E6E6;line-height:50px;padding-left:10px;padding-right:10px;">
                        <span style="">关注的专栏</span>
                        <span style="float:right;font-size:16px;">0</span>
                    </div>
                      <div style="height:50px;border-top:1px solid #E6E6E6;line-height:50px;padding-left:10px;padding-right:10px;">
                        <span style="">关注的问题</span>
                        <span style="float:right;font-size:16px;">{{$user->followers_count}}</span>
                    </div>
                      <div style="height:50px;border-top:1px solid #E6E6E6;line-height:50px;padding-left:10px;padding-right:10px;">
                        <span style="">关注的收藏夹</span>
                        <span style="float:right;font-size:16px;">0</span>
                    </div>
                    <div style="height:50px;border-top:1px solid #E6E6E6;line-height:50px;padding-left:10px;padding-right:10px;">
                        <span style="">
                            个人主页被浏览 0 次
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
<!-- 内容部分结束 -->
    <!-- 用来判断是否收起列表框 -->
    <div id="pd" flag="true"></div>
    <!-- 用来判断是否收起列表框 -->
    <div id="login" flag="{{Auth::check() ? '1' : '2'}}"></div>
    <!-- 用来获取登录者当前的id -->
    <div id="auth" authid="{{Auth::check()&&Auth::id() ? Auth::id() : 'b' }}"></div>




@endsection
<!-- laravel-lamp -->

@section('js')
<script src="https://cdn.bootcss.com/jquery/3.1.1/jquery.js"></script>
<script type="text/javascript" src="{{asset('layer/layer.js')}}"></script>
<!-- <script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script> -->
<script src="https://cdn.bootcss.com/amazeui/2.7.2/js/amazeui.min.js" charset="utf-8"></script>
<script src="{{asset('avatar/js/cropper.min.js')}}" charset="utf-8"></script>
<script src="{{asset('avatar/js/custom_up_img.js')}}" charset="utf-8"></script>
<script src="{{asset('xxk/tabulous.js')}}"></script>
<script src="{{asset('cropper/cropper.js')}}"></script>
<script type="text/javascript" src="{{asset('spin.min.js')}}"></script>

<script type="text/javascript">
window.onload = function(){ 
    $('.closes').click(function(){
        $('#closeMes').trigger('click');
    })
    //动态相关操作

    //问题
    $('.followQuestion').mouseover(function(){
        $(this).css({
            'color':'#175199',
            'transition':'all 0.4s',
        })
    }).mouseout(function(){
        $(this).css({
            'color':'#1A1A1A',
            'transition':'all 0.4s',
        })
    })


    $('.createQuestion').mouseover(function(){
        $(this).css({
            'color':'#175199',
            'transition':'all 0.4s',
            'cursor':'pointer',
        })
    }).mouseout(function(){
        $(this).css({
            'color':'#1A1A1A',
            'transition':'all 0.4s',
        })
    })

    $('.followQuestion').click(function(){
        window.location.href='/question/'+$(this).attr('questionid');
    })

     $('.createQuestion').click(function(){
        window.location.href='/question/'+$(this).attr('questionid');
    })
    //话题
    $('.followTopic').mouseover(function(){
        $(this).css({
            'color':'#175199',
            'transition':'all 0.4s',
            'cursor':'pointer',
        })

    }).mouseout(function(){
        $(this).css({
            'color':'#1A1A1A',
            'transition':'all 0.4s',
        })
    })

    $('.followTopicPic').mouseover(function(){
        $(this).css({
            'cursor':'pointer',
        })
    })

    $('.followTopic').click(function(){
        window.location.href='/topic/detail/'+$(this).attr('topicid');
    })

    $('.followTopicPic').click(function(){
        window.location.href='/topic/detail'+$(this).attr('topicid');
    })



    //用户

     $('.followUser').mouseover(function(){
        $(this).css({
            'color':'#175199',
            'transition':'all 0.4s',
            'cursor':'pointer',
        })

    }).mouseout(function(){
        $(this).css({
            'color':'#1A1A1A',
            'transition':'all 0.4s',
        })
    })

    $('.followUserPic').mouseover(function(){
        $(this).css({
            'cursor':'pointer',
        })
    })

    $('.followUser').click(function(){
        window.location.href='/user/index/'+$(this).attr('userid');
    })

    $('.followUserPic').click(function(){
        window.location.href='/user/index/'+$(this).attr('userid');
    })

    //回答的问题
    $('.commentAnswer').mouseover(function(){
        $(this).css({
            'color':'#0F88EB',
            'transition':'all 0.4s',
            'cursor':'pointer',
        })
    }).mouseout(function(){
        $(this).css({
            'color':'#636B6F',
            'transition':'all 0.4s',
        })
    })

    $('.commentAnswer').click(function(){
        if($(this).attr('flag') == '1'){
            for(var a = 0;a<$(this).parent().prev().find('img').length;a++){
                $(this).parent().prev().find('img:eq('+a+')').css({
                    'display':'block',
                });
            }

            $(this).parent().prev().css({
                'height':'auto',
            });


            var info = $(this).attr('info');
            $('#'+info+'').trigger('click');
            $(this).attr('flag','2');
            $(this).html('∧ 点击收起');
        }else{
            $(this).parent().prev().css({
                'height':'50px',
                'overflow':'hidden',
            });

            for(var a = 0;a<$(this).parent().prev().find('img').length;a++){
                $(this).parent().prev().find('img:eq('+a+')').css({
                    'display':'none',
                });
            }
            var info = $(this).attr('info');
            $('#'+info+'').trigger('click');
            $(this).attr('flag','1');
            $(this).html('∨ 点击展开');
        }
    })




    //动态相关操作结束
    //
    $('.gzTop').click(function(){

        var topic_id = $(this).attr('topid');
        var thiss = $(this);
        $.ajax({
            url:'/topic/follow',
            data:{topic_id:topic_id},
            type:'get',
            success:function(mes){
                if(mes == '1'){
                    $(this).css({
                        'width':'100px',
                        'background-color':'#ABB6C5',
                    });

                    thiss.html('<span class="glyphicon glyphicon-plus" style="font-size:4px;display:inline;"></span>取消关注');
                }else{
                    $(this).css({
                        'width':'100px',
                        'background-color':'#0F88EB',
                    });

                    thiss.html('<span class="glyphicon glyphicon-plus" style="font-size:4px;display:inline;"></span>关注话题');
                }
            }.bind($(this))
        })
    })




    //编辑封面图片
    $('#fm').click(function(){

        $('#bb_inp').click();

        $('#bb_inp').change(function(e){

            var file = e.target.files[0];

            var reader = new FileReader();

            reader.readAsDataURL(file); // 读出 base64
            reader.onloadend = function () {
                $('#image').cropper({
                    viewMode: 3,
                    dragMode: 'move',
                    autoCropArea: 1,
                    restore: true,
                    modasl: false,
                    guides: true,
                    highlight: true,
                    cropBoxMovable: true,
                    cropBoxResizable: false,
                });
                $('#image').cropper('replace',reader.result)
            }

            $('#fm').hide();
            $('#upload_qd').show();
            $('#upload_qq').show();
        });

        $('#upload_qd').click(function(){
            var dataURL = $('#image').cropper('getCroppedCanvas',{
                width:1168,
                height:240,
            });
            $('#image').cropper('destroy');
            $('#image').attr('src',dataURL.toDataURL("image/jpeg", 0.5));
            $.ajax({
                url:'/api/user_detail/background',
                data:{id:{{$userdetails->id}},cover:dataURL.toDataURL("image/jpeg", 0.5)},
                type:'post',
                success:function(mes){
                    if(mes == 'ok'){
                        $('#fm').show();
                        $('#upload_qd').hide();
                        $('#upload_qq').hide();
                    }else{
                        $('#fm').show();
                        $('#upload_qd').hide();
                        $('#upload_qq').hide();
                        alert('上传失败');
                    }
                }
            });
            
        });

        $('#upload_qq').click(function(){
            $('#image').cropper('destroy');
            $('#fm').show();
            $('#upload_qd').hide();
            $('#upload_qq').hide();
        });
    });






    var pic = document.getElementsByClassName('pic');

    for(var a = 0;a<pic.length;a++){

        var img = pic[a].getElementsByTagName('img');

        for(var i=0;i<img.length;i++){
           img[i].setAttribute('class','img-responsive');
           img[i].setAttribute('style','display:none');
        }
        
    }



    $('.ques').click(function(){
        var href = $(this).attr('href');
        window.location.href = href;
    })

    $('.answerQ').click(function(){
        var href = $(this).attr('href');
        window.location.href=href;
    })

    $('#tabs-1-1').css({
        'position':'absolute',
        'top':'0px',
    })
    //选项卡
    $('.tabs').tabulous({
        effect: 'slideLeft'
    });

    //选项卡中回答展开
    $('.anzk').mouseover(function(){
        $(this).css({
            'color':'#0F88EB',
            'transition':'all 0.4s',
            'cursor':'pointer',
        })
    }).mouseout(function(){
        $(this).css({
            'color':'#636B6F',
            'transition':'all 0.4s',
        })
    })

    $('.anzk').click(function(){
        if($(this).attr('flag') == '1'){
            for(var a = 0;a<$(this).parent().prev().find('img').length;a++){
                $(this).parent().prev().find('img:eq('+a+')').css({
                    'display':'block',
                });
            }

            $(this).parent().prev().css({
                'height':'auto',
            });


            var info = $(this).attr('info');
            $('#'+info+'').trigger('click');
            $(this).attr('flag','2');
            $(this).html('∧ 点击收起');
        }else{
            $(this).parent().prev().css({
                'height':'50px',
                'overflow':'hidden',
            });

            for(var a = 0;a<$(this).parent().prev().find('img').length;a++){
                $(this).parent().prev().find('img:eq('+a+')').css({
                    'display':'none',
                });
            }
            var info = $(this).attr('info');
            $('#'+info+'').trigger('click');
            $(this).attr('flag','1');
            $(this).html('∨ 点击展开');
        }
    })

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

    //页头详细个人资料
        //获取个人资料高度
    $('#personDetail').css({
        'height':'auto',
    });
    var personDetail = $('#personDetail').height();
    $('#personDetail').css({
        'height':'0px',
    });
        //展开的鼠标移入颜色变化
    $('#detail').mouseover(function(){
        $(this).css({
            'color':'#0F88EB',
            'transition':'all 0.4s',
        })

    }).mouseout(function(){
        $(this).css({
            'color':'#636B6F',
            'transition':'all 0.4s',
        })
    });

    //展开的鼠标点击 使个人资料展开
    $('#detail').click(function(){
        if($('#personDetail').attr('flag') == '1'){

            $('#personDetail').css({
                'height':''+personDetail+'px',
                'transition':'all 0.4s',
            })
            $('#personDetail').attr('flag','2');
            $('#detail').html('∧ 收起详细资料');
        }else{
            $('#personDetail').css({
                'height':'0px',
                'transition':'all 0.4s',
                'overflow':'hidden',
            })
            $('#personDetail').attr('flag','1');
            $('#detail').html('∨ 查看详细资料');
            
        }
    })

    //修改头像鼠标悬停
    $('#xg1').mouseover(function(){
        $('#xg').css({
            'opacity':'0.6',
            'transition':'all 0.4s',
        });
        $(this).css({
            'opacity':'1',
            'transition':'all 0.4s',
        })
    }).mouseout(function(){
        $('#xg').css({
            'opacity':'0',
            'transition':'all 0.4s',
        });
        $(this).css({
            'opacity':'0',
            'transition':'all 0.4s',
        })
    })

    //编辑按钮的鼠标移入样式
    $('.glyphicon-option-horizontal').mouseover(function(){
        $(this).css({
            'cursor':'pointer',
        });
    });

    //点击编辑按钮弹出列表框
    $('.glyphicon-option-horizontal').click(function(){

        $('#pd').attr('flag','false');

        if($(this).attr('flag') == 'true'){

            //更改下拉框的样式
            $(this).children('span:first-child').css({
                'opacity':'1',
                'transition':'all 0.5s',
                'height':'70px',
            });

            $(this).attr('flag','false');
        }else{

            //更改下拉框的样式
            $(this).children('span:first-child').css({
                'opacity':'0',
                'transition':'all 0.5s',
                'height':'0px',
                'overflow':'hidden',
            });

            $(this).attr('flag','true');
        }
            

    }); 
    $('.edit').click(function(){
        var href = $(this).attr('href');
        window.location.href = href;
    })

    //点击删除或者编辑
    $('.del').click(function(){

        var id = $(this).attr('id');
        if(confirm('是否确认删除')){

                // $(this).parent().parent().parent().parent().parent().parent().css({
                //     'position':'absolute',
                //     'left':''+num+'',
                // })

            $(this).parent().parent().parent().parent().parent().remove();
            
            $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

            $.ajax({
                url:'/question/destroy',
                type:'post',
                data:{id:id,_method:'delete'},
                success:function(result){
                    if(result == 'true'){
                        // layer.msg('删除成功');
                        alert('删除成功');
                    }
                }
            });
            var del = $(this).attr('del');

            $('#'+del+'').trigger('click');
        }else{
            var del = $(this).attr('del');
            $('#'+del+'').trigger('click');
        };
    })


    //关注用户
    $('#guanzhu').click(function(){
        if($('#login').attr('flag') == '2'){
            // alert('请先登录');
            layer.msg('请先登录');
            return false;
        }
        

        var user_id = $(this).attr('userid');

        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

        $.ajax({
            url:"{{action('FollowUserController@store',$user->id)}}",
            type:'get',
            success:function(mes){
                if(mes == '1'){
                    $('#guanzhu').css({
                        'background-color':'#C3CCD9',
                    })
                    $('#guanzhu').html('已关注');

                    guanzhu(1);
                }else{
                    $('#guanzhu').css({
                        'background-color':'#0F88EB',
                    });
                    $('#guanzhu').html('<span class="glyphicon glyphicon-plus"></span>  关注他');
                    guanzhu(2);
                }
            }
        })
    })


    $('.bguanzhu').click(function(){
        if($('#login').attr('flag') == '2'){
            // alert('请先登录');
            layer.msg('请先登录');
            return false;
        }
        

        var user_id = $(this).attr('userid');
        var tthis = $(this);
        $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

        $.ajax({
            url:"/follow/"+user_id+"/user",
            type:'get',
            success:function(mes){
                if(mes == '1'){
                    tthis.css({
                        'background-color':'#C3CCD9',
                    })
                    tthis.html('已关注');
                    var num = $('#guanzhule').text();
                    num++;
                    $('#guanzhule').html(''+num+'');
                    bguanzhu(1,tthis);
                }else{
                    tthis.css({
                        'background-color':'#0F88EB',
                    });
                    tthis.html('<span class="glyphicon glyphicon-plus" style="display:inline"></span>  关注他');

                     var num = $('#guanzhule').text();
                     num--;
                     $('#guanzhule').html(''+num+'');
                    bguanzhu(2,tthis);
                }
            }
        })
    })

 
    if($('#guanzhu').attr('flag') == '1'){
        $('#guanzhu').css({
            'background-color':'#C3CCD9',
        });
        $('#guanzhu').html('已关注');
        guanzhu(1);

    }else{
        guanzhu(2);
    }

    for(var a = 0;a<$('.bguanzhu').length;a++){
        if( $('.bguanzhu:eq('+a+')').attr('flag') == '1'){
             $('.bguanzhu:eq('+a+')').css({
                'background-color':'#C3CCD9',
            });
            $('.bguanzhu:eq('+a+')').html('已关注');
            bguanzhu(1,$('.bguanzhu:eq('+a+')'));

        }else{
            bguanzhu(2,$('.bguanzhu:eq('+a+')'));
        }
    }

    function bguanzhu(a,bt){
    if(a == 1){

        bt.mouseover(function(){

            $(this).css({
                'background-color':'#ABB6C5',
                'color':'white',
            });

            $(this).html('取消关注');
        }).mouseout(function(){
            $(this).css({
                'background-color':'#ABB6C5',
            });
            $(this).html('已关注');
        })
    }else{
        bt.mouseover(function(){
            $(this).css({
                'background-color':'#0F76C9',
                'color':'white',
            });
             $(this).html('<span class="glyphicon glyphicon-plus"  style="display:inline"></span>  关注他');
        }).mouseout(function(){
             $(this).html('<span class="glyphicon glyphicon-plus"  style="display:inline"></span>  关注他');
            $(this).css({
                'background-color':'#0F88EB',
                
            })
        })
    }
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
                 $('#guanzhu').html('<span class="glyphicon glyphicon-plus"></span>  关注他');
            }).mouseout(function(){
                 $('#guanzhu').html('<span class="glyphicon glyphicon-plus"></span>  关注他');
                $(this).css({
                    'background-color':'#0F88EB',
                    
                })
            })
        }
    }


    $('.bgz').click(function(){
         window.location.href = $(this).attr('href');
    })

    $('#up-img-touch').click(function(){
        if($(this).attr('flag') != '1'){
            return false;
        };
    })





      $('#doc-prompt-toggle').on('click', function() {
        if($('#login').attr('flag') == '2'){
            layer.msg('请登录');
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
            layer.msg('不能为空');
            return false;
        }

        $.ajax({
            url:'/message/store',
            type:'get',
            data:{to_user_id:toid,body:body},
            success:function(mes){
                if(mes == '1'){
                    layer.msg('私信发送成功');
                }
            }

        });
    })

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

        $('#tabs-3').mouseover(function(){
            $('#tabs-3').attr('flag','1');
        }).mouseout(function(){
            $('#tabs-3').attr('flag','2');
        });

    $('.user').mouseover(function(ent){


        var userid = $(this).attr('userid');
        var thiss = $(this);
        $(this).parent().next().css({
            'height':'170px',
            'opacity':'1',
            'overflow':'visible',
            'transition':'all 0.3s',
        })
          thiss.parent().next().append(`  
            <span id="foo" style="width:100px; height:200px; margin-left:90px;">

             </span>
        `);

        newload();

        $.ajax({
            url:'/user/getUser',
            data:{userid:userid},
            type:'get',
            success:function(mes){
                thiss.parent().next().empty();

                    if(mes['1']['id'] != $('#Auth').attr('Authid')){
                        var bt = '<span><button type="button" id="guanzhuA" flag="'+mes['0']+'" class="btn btn-default navbar-btn" userid="'+mes['1']['id']+'" style=""><span class="glyphicon glyphicon-plus" style="display:inline"></span>  关注他</button>';
                    }else{
                        var bt = '<div></div>';
                    }

                    thiss.parent().next().append(`  
                                <span style="height:50px;border-bottom:1px solid #E8E5E5">
                                    <a href="/user/index/`+mes['1']['id']+`"><img src="`+mes['1']['avatar']+`" width="50px;" style="border-radius:5px;position:absolute;top:-15px;left:20px;" alt=""></a>
                                    <span style="margin-left:105px;height:100%;">
                                        <span style="height:50%;line-height:35px;color:#1A1A1A">`+mes['1']['name']+`</span>
                                        <span style="height:50%;color:#1A1A1A">`+mes['1']['created_at']+`加入知乎</span>
                                    </span>
                                </span>

                                 <span style="height:50px;">
                                    <span style="width:50%;height:100%;float:left;">
                                        <span style="height:50%;width:100%;text-align:center;color:#8590A6;font-size:15px;padding-top:5px;padding-left:20px;">回答</span>
                                        <span style="height:50%;width:100%;text-align:center;font-size:18px;font-weight:bold;color:black;padding-left:20px;">`+mes['1']['answers_count']+`</span>
                                    </span>
                                    <span style="width:50%;height:100%;float:left;">
                                        <span style="height:50%;width:100%;text-align:center;color:#8590A6;font-size:15px;padding-top:5px;padding-right:20px;">关注者</span>
                                        <span style="height:50%;width:100%;text-align:center;font-size:18px;font-weight:bold;color:black;padding-right:20px;">`+mes['1']['followings_count']+`</span>
                                    </span>
                                    `+bt+`
                                </span>
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

$('#guanzhule').click(function(){
    $('#tabss-3').trigger('click');
})

$('#guanzhuzhe').click(function(){
    $('#tabss-4').trigger('click');
});

$('.answerQ').mouseover(function(){
    $(this).css({
        'text-decoration':'none',
        'color':'#175199',
    });
}).mouseout(function(){
    $(this).css({
        'color':'#1A1A1A',
    })
})

</script>
@endsection