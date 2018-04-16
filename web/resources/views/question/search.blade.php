@extends('layouts.app')

@section('css')
<!-- <link rel="stylesheet" href="{{asset('bootstrap-3.3.7-dist/css/bootstrap.min.css')}}"> -->
<style type="text/css">
	#moreUser:hover{
		cursor:pointer;
	}
	#moreTopic:hover{
		cursor:pointer;
	}
	.voteUp:hover{
	    cursor:pointer;
	}
	.voteDown:hover{
	    cursor:pointer;
	}

</style>
@endsection

@section('content')        

<div class="layui-tab layui-tab-brief" lay-filter="docDemoTabBrief" style="margin-top:-23px;">
  <ul class="layui-tab-title" style="background-color:#FFF;height:51px;text-align:center;color:black">
    <li style="height:100%;margin-top:10px;font-size:18px;" class="layui-this">综合</li>
    <li id="user" style="height:100%;margin-top:10px;font-size:18px;">用户</li>
    <li id="topic" style="height:100%;margin-top:10px;font-size:18px;">话题</li>
  </ul>
  <div class="layui-tab-content" style="height: auto;margin:0 auto;width:45%;background-color:#FFF;box-shadow:0px 0px 5px #EAEDED">
    <div class="layui-tab-item layui-show">
			@if($data[1] != 'no')
	    	<div style="border-bottom:1px solid #F0F2F7;height:135px">
	    		<div style="width:78px;height:100%;padding-top:20px;margin-left:10px;float:left">
	    		<a href="/user/index/{{$data[1][0]->id}}"><img src="{{$data[1][0]->avatar}}" width="75px;" style="border-radius:5px;" alt=""></a>
	    		</div>
				
	    		<div style="float:left;width:80%;height:80%;margin-left:10px;margin-top:20px;">
	    			<span style="font-size:18px;color:#1E1E1E;font-weight:bold;float:left;width:100%">{{$data[1][0]->name}}</span>
	    			<span style="float:left;width:100%;margin-top:3px;color:#1E1E1E">{{$data[1][0]->created_at}}加入知乎</span>
	    			<span style="float:left;width:100%;margin-top:3px;">{{$data[1][0]->questions_count}}个提问 · {{$data[1][0]->answers_count}}个回答 · {{$data[1][0]->followings_count}}关注者</span>
	    			<span  id="moreUser" style="float:left;width:100%;margin-top:3px;color:#175199">点击查看更多关于用户</span>
	    		</div>

	    	</div>
			@endif

			@if($data[2] != 'no')
	    	<div style="border-bottom:1px solid #F0F2F7;height:135px">
	    		<div style="width:78px;height:100%;padding-top:20px;margin-left:10px;float:left">
	    		<a href="/topic/detail/{{$data[2][0]->id}}"><img src="{{$data[2][0]->topic_pic}}" width="75px;" style="border-radius:5px;" alt=""></a>
	    		</div>
				
	    		<div style="float:left;width:80%;height:80%;margin-left:10px;margin-top:20px;">
	    			<a href="/topic/detail/{{$data[2][0]->id}}"><span style="font-size:18px;color:#1E1E1E;font-weight:bold;float:left;width:100%">{{$data[2][0]->name}}</span></a>
	    			<span style="float:left;width:100%;margin-top:3px;color:#1E1E1E">{{$data[2][0]->desc}}</span>
	    			<span style="float:left;width:100%;margin-top:3px;">{{$data[2][0]->questions_count}}个提问 · {{$data[2][0]->followers_count}}关注者</span>
	    			<span id="moreTopic" style="float:left;width:100%;margin-top:3px;color:#175199">点击查看更多话题结果</span>
	    		</div>

	    	</div>
			@endif


			@if($data[0] != 'no')
			@foreach($data[0] as $question)
			            <div class="panel panel-default"  style="margin-top:10px;border:1px none white">
			                


			                <div class="panel" style="box-shadow:0px 0px 0px white;margin-top:5px;margin-bottom:0px;padding-left:20px;">
			                    <a href="{{action('UserController@index',array('user_id'=>$question->user()->first()->id))}}"><img src="{{$question->user->avatar}}" width="30px" alt=""></a>
			                    <span style="margin-left:8px;font-weight:bold">{{$question->user()->first()->name}}</span>
			                    <span style="float:right;margin-right:20px;">发布于{{$question->created_at->diffForHumans()}}</span>
			                </div>
			                
			                <div class="panel" style="font-weight:bold;padding-left:15px;padding-top:10px;font-size:16px;margin-bottom:0px;box-shadow:0px 0px 0px white;color:black">
			                    <a id="qT" href="{{action('QuestionController@show',array('id'=>$question->id))}}">{{$question->title}}</a>
			                </div>

			                
			                <div class="panel-body pic sl" style="height:200px;">
			                    <div class="tp" style="height:200px;width:40%;overflow:hidden;float:left;">
			                        
			                    </div>    

			                    <div class="wz" style="float:left;margin-left:20px;width:55%;height:200px;overflow:hidden;text-indent:27px;">
			                        
			                    </div>
			                     @if($question->answers_count > 0)
			                    <div>
			                    {!! $question->answers[0]->body !!}
			                    </div>
			                    @endif
			                </div>

			                    @if($question->answers_count > 0)
			                    <div class="panel-body pic" style="height:0px;opacity:0;overflow:hidden">
			                    {!! $question->answers[0]->body !!}
			                    </div>
			                    @endif
			                
			                <div class="panel-foot votepd" style="position:relative;height:50px;" answerid="{{$question->answers[0]->id}}">
			                    <div class="voteUp" vote="1"
			                        
			                    @if($question->answers[0]->user_vote != null)

			                        @if($question->answers[0]->user_vote['vote'] === 1)
			                            flag='2'
			                            @else
			                            flag='1'
			                        @endif
			                    @else
			                    flag='1'
			                    @endif
			                     style="float:left;margin-left:10px;height:40px;padding:10px;border-radius:5px;background-color:#EBF3FB;color:#2D84CC;"><span class="glyphicon glyphicon-triangle-top" style="font-size:14px;margin-right:5px;"></span><span class="upvote">{{$question->answers[0]->votes_count}}</span></div>
			                        

			                    <div class="voteDown" vote="2" 
			                    
			                         @if($question->answers[0]->user_vote != null)
			                            @if($question->answers[0]->user_vote['vote'] === 2)
			                                flag='2'
			                                @else
			                                flag='1'
			                            @endif
			                        @else
			                        flag='1'
			                        @endif

			                     style="float:left;margin-left:10px;height:40px;padding-left:12px;padding-right:12px;border-radius:5px;background-color:#EBF3FB;color:#2D84CC;line-height:40px;text-align:center">
			                     <span class="glyphicon glyphicon-triangle-bottom" style="font-size:14px;"></span></div>
			                    
			                    <div style="float:right;margin-right:10px;" class="click" info="1">∨ 点击展开</div>
			                </div>
			            </div>
			    @endforeach

			@endif


    </div>
    <div class="layui-tab-item">
    	@if($data[1] != 'no')
    		@foreach($data[1] as $user)
	    	<div style="border-bottom:1px solid #F0F2F7;height:115px">
	    		<div style="width:78px;height:100%;padding-top:20px;margin-left:10px;float:left;">
	    		<a href="/user/index/{{$user->id}}"><img src="{{$user->avatar}}" width="75px;" style="border-radius:5px;" alt=""></a>
	    		</div>
				
	    		<div style="float:left;width:65%;height:80%;margin-left:10px;margin-top:20px;overflow:hidden;">
	    			<span style="font-size:18px;color:#1E1E1E;font-weight:bold;float:left;width:100%">{{$user->name}}</span>
	    			<span style="float:left;width:100%;margin-top:3px;color:#1E1E1E">{{$user->created_at}}加入知乎</span>
	    			<span style="float:left;width:100%;margin-top:3px;">{{$user->questions_count}}个提问 · {{$user->answers_count}}个回答 · {{$user->followings_count}}关注者</span>
	    		</div>
				<div style="float:left;width:20%;height:100%;text-align:center;line-height:115px">
					 <span style="padding-top:10px;">
                        <button type="button" flag="{{AUth::check()&&Auth::user()->followed_user($user->id)}}" userid = "{{$user->id}}"class="btn btn-default navbar-btn bguanzhu" style="background-color:#0F88EB;color:white"><span class="glyphicon glyphicon-plus" style="display:inline"></span>  关注他</button>
                    </span>
				</div>
	    	</div>
	    	@endforeach
	    	@else
	    	<div style="border-bottom:1px solid #F0F2F7;height:115px;font-size:60px;text-align:center;line-height:115px;">
	    		<span class="glyphicon glyphicon-bullhorn" style="margin-right:20px;"></span>暂无数据
	    	</div>
	    @endif
    </div>
    <div class="layui-tab-item">
    	@if($data[2] != 'no')
    		@foreach($data[2] as $topic)
	    	<div style="border-bottom:1px solid #F0F2F7;height:135px">
	    		<div style="width:78px;height:100%;padding-top:20px;margin-left:10px;float:left">
	    		<a href="/topic/detail/{{$topic->id}}"><img src="{{$topic->topic_pic}}" width="75px;" style="border-radius:5px;" alt=""></a>
	    		</div>
				
	    		<div style="float:left;width:80%;height:80%;margin-left:10px;margin-top:20px;">
	    			<a href="/topic/detail/{{$topic->id}}"><span style="font-size:18px;color:#1E1E1E;font-weight:bold;float:left;width:100%">{{$topic->name}}</span></a>
	    			<span style="float:left;width:100%;margin-top:3px;color:#1E1E1E">{{$topic->desc}}</span>
	    			<span style="float:left;width:100%;margin-top:3px;">{{$topic->questions_count}}个提问 · {{$topic->followers_count}}关注者</span>
	    		</div>

	    	</div>
	    	@endforeach
	    	@else
	    	<div style="border-bottom:1px solid #F0F2F7;height:115px;font-size:60px;text-align:center;line-height:115px;">
	    		<span class="glyphicon glyphicon-bullhorn" style="margin-right:20px;"></span>暂无数据
	    	</div>
			@endif
    </div>
  </div>
</div> 
@endsection

@section('js')
<script src="https://cdn.bootcss.com/jquery/3.1.1/jquery.js"></script>
<!-- <script src="{{ asset('js/app.js') }}"></script> -->
<!-- <script type="text/javascript" src="{{asset('layer/layer.js')}}"></script> -->


<script type="text/javascript">
	
	window.onload = function(){
$.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    //点赞
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
    

    //结束点赞
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
            $('.sl:eq('+a+') img:eq(0)').css({'height':'200px'});
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

    $('.click').mouseover(function(){

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


    $('.click').click(function(){

        if($(this).attr('info') == '1'){

           $(this).parent().prev().prev().css({
                'height':'0px',
                'opacity':'0',
                'overflow':'hidden',
           });

            $(this).parent().prev().css({
                // 'display':'block',
                'height':'auto',
                'transition':'all 0.3s',
                'opacity':'1',
            });

            $(this).attr('info','0');
            $(this).text('∧ 点击收起');

        }else{

            $(this).parent().prev().prev().css({
                'height':'200px',
                'overflow':'hidden',
                'opacity':'1',
            });

            $(this).parent().prev().css({
                'height':'0px',
                // 'display':'none',
                'overflow':'hidden',
                'opacity':'0',
            });

            $(this).attr('info','1');
            $(this).text('∨ 点击展开');

        }
 

    })

    $('#moreUser').click(function(){
    	$('#user').trigger('click');
    })
    $('#moreTopic').click(function(){
    	$('#topic').trigger('click');
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
                    // 111111111111111111111111111111111111111111
                     var num = $('#guanzhule').text();
                     num--;
                     $('#guanzhule').html(''+num+'');
                    bguanzhu(2,tthis);
                }
            }
        })
    })

        for(var a = 0;a<$('.bguanzhu').length;a++){
        if( $('.bguanzhu:eq('+a+')').attr('flag') == '1'){
             $('.bguanzhu:eq('+a+')').css({
                'background-color':'#C3CCD9',
                'width':'86px',
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
}

</script>
@endsection