@extends('layouts.app')
@section('css')
    <!-- <link rel="stylesheet" href="{{asset('bootstrap-3.3.7-dist/css/bootstrap.min.css')}}"> -->
    <style type="text/css">
        .topicBt{
            border-radius:18px;
            background-color:#FFF;color:#0D6BC9;border:1px solid #0D6BC9;
            font-size:9px;padding-left:10px;padding-right:10px;padding-top:4px;
            padding-bottom:2px;margin-right:5px;
            border:1px solid #DAECF5;
        }
        .topicBt:hover{
            background-color:#0D6BC9;
            color:white;
        }
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
    </style>
@endsection
@section('content')

    <div class="container" >
        <div class="col-md-7 col-md-offset-1" style="padding:0px;" id="content">

            <div style="height:auto;margin-bottom:20px;background-color:white;box-shadow:0px 0px 3px #C1C1C1">
                <div style="height:130px;padding:15px;border-bottom:1px solid #E7EAF1">
                    <div style="height:100%;float:left;width:18%;">
                        <img src="{{$topics->topic_pic}}" width="100px;" style="border-radius:5px;" alt="">
                    </div>
                    <div style="height:100%;float:left;width:80%;">
                        <div style="font-weight:bold;color:#1A1A1A;font-size:23px;margin-top:10px;">
                            {{$topics->name}}
                        </div>
                        <div style="word-wrap:break-word; overflow:hidden;height:40%">
                            {{$topics->desc}}
                        </div>
                    </div>
                </div>
                <div style="height:60px;padding-left:20px;padding-top:5px;">
                    @if($topics->user === null)

                   <button type="button" class="btn btn-default navbar-btn gzTop"  topid="{{$topics->id}}" style="background-color:#0084FF;color:white" ><span class="glyphicon glyphicon-plus" style="display:inline"></span> 关注话题</button>
                    
                    @else
                    <button type="button" class="btn btn-default navbar-btn gzTop"  topid="{{$topics->id}}" style="background-color:#ABB6C5;color:white" ><span class="glyphicon glyphicon-plus"></span> 取消关注</button>
                    
                    @endif
                </div>

            </div>

            <div id="topicName" ></div>
            <div id="topicBody"></div>
            
                


        </div>

        <div class="col-md-3" style="margin-left:10px;padding:0px 0px 15px 0px;">
            <div style="height:125px;background-color:white;box-shadow:0px 0px 3px #C1C1C1">
            <div style="border-right:1px solid #E7EAF1;float:left;width:50%;height:30%;margin-top:30px;">
                <div style="text-align:center">
                    关注者
                </div>
                <div style="text-align:center;margin-top:5px;font-weight:bold;color:#262626;font-size:20px;" id="gzz">
                    {{$topics->followers_count}}
                </div>
            </div>
            <div style="float:left;width:50%;height:30%;margin-top:30px;">
                <div style="text-align:center">
                    问题数
                </div>
                <div style="text-align:center;margin-top:5px;font-weight:bold;color:#262626;font-size:20px;" id="gzz">
                    {{$topics->questions_count}}
                </div>
            </div>
            </div>
        </div>


    </div>
    <button type="button" topicid="{{$topics->id}}" class="btn btn-default navbar-btn topicBt" style="display:none"></button>
@endsection

@section('js')
    <script src="https://cdn.bootcss.com/jquery/3.1.1/jquery.js"></script>
    <script type="text/javascript">
$(function(){

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

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
                            'background-color':'#ABB6C5','color':'white'
                        })
                        $(this).html('<span class="glyphicon glyphicon-plus" style="display:inline"></span> 关注话题');
                    }else{
                        $(this).css({
                            'background-color':'#0084FF','color':'white',
                        })
                        $(this).html('<span class="glyphicon glyphicon-plus" style="display:inline"></span> 取消关注');
                    }
                }.bind($(this)),
            })
        })

        // $('.gzTop').mouseover(function(){
        //     $(this).css({
        //         'color':'#2255B3',
        //     })
        // }).mouseout(function(){
        //     $(this).css({
        //         'color':'#698EBF',
        //     })
        // })


    function newstyle(){
            for(var a = 0;a<$('.a').length;a++){
        $($('.a:eq('+a+')')).css({
            'padding-top':'0px',
        })
    }


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
    }



    $('.topicBt').click(function(){
        for(var Btnum = 0;Btnum<$('.topicBt').length;Btnum++){
            $('.topicBt:eq('+Btnum+')').css({
                'background-color':'#FFF',
                'color':'#0D6BC9',
            })    
        }

        $(this).css({
            'background-color':'#0D6BC9',
            'color':'white',
        })



        var topicid = $(this).attr('topicid');

       

        $.ajax({

            url:'/topic/userTopic',
            data:{topicid:topicid},
            type:'post',
            success:function(mes){
                $('#topicBody').empty();

        
                $.each(mes,function(k,v){

                    if(mes[k]['answers_count'] > 0){
                        var body = '<div>'+mes[k]['answers'][0]['body']+'</div>';
                        var nbody = '<div class="panel-body pic" style="height:0px;opacity:0;overflow:hidden">'+mes[k]['answers'][0]['body']+'</div>';
                    }


                    if(mes[k]['answers'][0]['user_vote'] != null){

                        if(mes[k]['answers'][0]['user_vote']['vote'] == 1){
                            var flag = 'flag="2"';
                        }else{
                            var flag = 'flag="1"';
                        }

                    }else{
                        var flag = 'flag ="1"';
                    }


                    if(mes[k]['answers'][0]['user_vote'] != null){

                        if(mes[k]['answers'][0]['user_vote']['vote'] ==2){
                            var flag1 = 'flag="2"';
                        }else{
                            var flag1 = 'flag="1"';
                        }

                    }else{
                        var flag1 = 'flag="1"';
                    }



                    $('#topicBody').append(`
                        <div class="contentson"  style="border-bottom:1px solid #CCCCCC;background-color:white;box-shadow:0px 0px 3px #C1C1C1">                
                            <div class="panel" style="font-weight:bold;padding-left:15px;padding-top:10px;font-size:16px;margin-bottom:0px;box-shadow:0px 0px 0px white;color:black">
                                <a id="qT" href="/question/`+mes[k]['id']+`">`+mes[k]['title']+`</a>
                            </div>
                            <div class="panel-body pic sl" style="height:200px;">
                                <div class="tp" style="height:200px;width:40%;overflow:hidden;float:left;">
                                    
                                </div>    

                                <div class="wz" style="float:left;margin-left:20px;width:55%;height:200px;overflow:hidden;text-indent:27px;">
                                    
                                </div>

                               `+body+`

                            </div>
                             
                             `+nbody+`
                            
                            <div class="panel-foot votepd" style="position:relative;height:50px;" answerid="`+mes[k]['answers'][0]['id']+`">
                                <div class="voteUp" vote="1" `+flag+` style="float:left;margin-left:10px;height:40px;padding:10px;border-radius:5px;background-color:#EBF3FB;color:#2D84CC;"><span class="glyphicon glyphicon-triangle-top" style="font-size:14px;margin-right:5px;"></span><span class="upvote">`+mes[k]['answers'][0]['votes_count']+`</span></div>

                                <div class="voteDown" vote="2" `+flag1+` style="float:left;margin-left:10px;height:40px;padding:12px;border-radius:5px;background-color:#EBF3FB;color:#2D84CC;">
                                 <span class="glyphicon glyphicon-triangle-bottom" style="font-size:14px;"></span></div>
                                
                                <div style="float:right;margin-right:10px;" class="click" info="1">∨ 点击展开</div>
                            </div>
                        </div>
                        `);

                })

                newstyle();
            }
        })
    })

    $('.topicBt:eq(0)').trigger('click');


})
    </script>
@endsection