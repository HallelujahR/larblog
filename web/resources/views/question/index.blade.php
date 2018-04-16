@extends('layouts.app')
<link rel="stylesheet" href="{{asset('avatar/css/amazeui.min.css')}}">
<link rel="stylesheet" href="{{asset('avatar/css/amazeui.cropper.css')}}">
@section('css')
    <style type="text/css">
        #qT{
            color:#1E1E1E;
        }
        #qT:hover{
            color:#175199;
            text-decoration:none;
        }
        .voteUp:hover{
            cursor:pointer;
        }
        .voteDown:hover{
            cursor:pointer;
        }
        #guanzhu{
            width:125px;
            background-color:#0F88EB;
            color:white;
            margin-left:35px;
        }

    </style>
@endsection
@section('content')
<div class="container">
    @foreach($questions as $question)
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default"  style="box-shadow:0px 0px 5px #EAEDED">
                
                <div class="panel-heading" style="color:#8590A6">
                    来自:   
                    
                    @foreach($question->topics as $topic)
                        <a href="/topic/detail/{{$topic->id}}">{{$topic->name}}</a>
                    @endforeach

                </div>
                
                <div class="panel" style="box-shadow:0px 0px 0px white;margin-top:5px;margin-bottom:0px;padding-left:20px;position:relative">
                    <a href="{{action('UserController@index',array('user_id'=>$question->user()->first()->id))}}"  class="userA" >
                        <img class="user" src="{{$question->user->avatar}}" flag="1" width="30px"userid="{{$question->user()->first()->id}}" alt="">
                    </a>
                    
                    <div class="userB" style="background-color:white;height:0px;overflow:hidden;opacity:0;width:350px;position:absolute;box-shadow:0px 0px 5px #EAEDED;border-radius:5px;top:50px;">
                     
                    </div>

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

                     style="float:left;margin-left:10px;height:40px;padding:12px;border-radius:5px;background-color:#EBF3FB;color:#2D84CC;line-height:40px;text-align:center">
                     <span class="glyphicon glyphicon-triangle-bottom" style="font-size:14px;"></span></div>
                    
                    <div style="float:right;margin-right:10px;" class="click" info="1">∨ 点击展开</div>
                </div>
            </div>
        </div>
    </div>
    @endforeach
</div>
<!-- 鼠标移入头像 -->

<!-- 鼠标移入头像 -->
@endsection
 <div id="login" flag="{{Auth::check() ? '1' : '2'}}"></div>
<!-- laravel-lamp -->
    
<script src="https://cdn.bootcss.com/jquery/3.1.1/jquery.js"></script>
<script src="https://cdn.bootcss.com/amazeui/2.7.2/js/amazeui.min.js" charset="utf-8"></script>
<script type="text/javascript" src="{{asset('spin.min.js')}}"></script>
<script type="text/javascript">
window.onload = function(){

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
                                <div style="height:60px;border-bottom:1px solid #E8E5E5">
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
                                    <div style="">
                                         <button type="button" id="guanzhu" flag="`+mes['0']+`" class="btn btn-default navbar-btn" userid="`+mes['1']['id']+`" style=""><span class="glyphicon glyphicon-plus"></span>  关注他</button>
                                         
                                    </div>
                                </div>
                            `);
                      
                    gzA();
                    if($('#guanzhu').attr('flag') == 'true'){
                       $('#guanzhu').css({
                            'background-color':'#C3CCD9',
                        });
                        $('#guanzhu').html('已关注');
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

    $('#guanzhu').click(function(){
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



}
</script>
