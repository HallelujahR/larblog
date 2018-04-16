<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- <link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"> -->
    <link rel="stylesheet" href="{{asset('bootstrap-3.3.7-dist/css/bootstrap.min.css')}}">
    <!-- <link href="{{asset('css/bootstrap.min.css')}}" rel="stylesheet"> -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{asset('layui/css/layui.css')}}"  media="all">
    <link rel="stylesheet" href="{{asset('lobibox/demo/demo.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('lobibox/css/default.css')}}">
    <link rel="stylesheet" href="{{asset('lobibox/dist/css/Lobibox.min.css')}}"/>

    <link rel="stylesheet" href="{{asset('jquery-tz/css/iziToast.min.css')}}">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!--<script type="text/javascript" src="{{asset('layui/layui.js')}}"></script>-->

    <style type="text/css">
        #hid::-webkit-scrollbar{
          display:none;
        }
        #messageBody::-webkit-scrollbar{
          display:none;
        }
        #sy:hover{
            /*font-size:20px;*/
            color:#2D84CC;
        }
        #sy{
            margin-left:10px;
            font-size:15px;
            color:#333333;
        }
        #search{
            margin-left:100px;
        }
        #tw{
            background-color:#0F88EB;
            color:white;
            height:35px;
            line-height:5px;
            margin-top:8px;
            margin-right:93px;
        }
        #redY{
            border:2px solid white;height:23px;width:23px;border-radius:20px;position:absolute;top:-10px;left:-12px;z-index:10000;background-color:#EA2000;font-size:13px;color:white;text-align:center;
        }
        #bell:hover{
            cursor:pointer;
        }
        #bellTip{
            /*height:350px;*/
            height:0px;
            overflow: hidden;
            width:340px;position:absolute;top:32px;left:-160px;
            background-color:white;
            box-shadow:rgb(234, 237, 237) 0px 0px 8px;
            border-radius:5px;
        }
        .clearGztip:hover{
            cursor:pointer;
        }

    </style>

@section('css')

@show
</head>
<body>

    <div id="app">
        <nav class="navbar navbar-default navbar-static-top" style="box-shadow:2px 2px 2px #E8E8E8;">
            <div class="container">
                <div class="navbar-header">

                    <!-- Collapsed Hamburger -->
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse" aria-expanded="false">
                        <span class="sr-only">Toggle Navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>

                    <!-- Branding Image -->
                    <a class="navbar-brand" href="{{ url('/') }}">
                        {{ config('app.name', 'Laravel') }}
                    </a>
                </div>

              

                <div class="collapse navbar-collapse" id="app-navbar-collapse">

                    <!-- Left Side Of Navbar -->
                    <ul class="nav navbar-nav">
                        &nbsp;
                        <li><a id="sy" href="{{ url('/') }}" style="text-decoration:none;">首页</a></li>
                        <li><a id="sy" href="/topic" class="ht" style="text-decoration:none;">话题</a></li>
                        <li style="margin-left:40px;position:relative">
                            <form class="navbar-form navbar-left" action="/search" method="post" role="search">
                            {{ csrf_field() }}
                                 <div class="col-lg-6">
                                    <div class="input-group">
                                      <input type="text" autocomplete="off" autoconplete=' off' class="form-control" style="width:300px;" id="searchInput"placeholder="Search for..." name="title">
                                      <span class="input-group-btn">
                                        <button class="btn btn-default" type="submit" style="height:36px;background-color:#0F88EB;color:white;border:1px solid #0F88EB" id="sendSearch"><span class="glyphicon glyphicon-search"></span></button>
                                      </span>
                                    </div><!-- /input-group -->
                                  </div><!-- /.col-lg-6 -->
                            </form>
                            <div style="height:0px;overflow:hidden;opacity:0;width:440px;position:absolute;top:50px;left:30px;background-color:white;box-shadow:rgb(234, 237, 237) 0px 0px 8px;padding-top:10px;" id="searchResult">
                                <div id="searchQuestion">

                                </div>
                                <div id="searchUser">

                                </div>
                                <div id="searchTopic">

                                </div>
                            </div>
                        </li>
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="btn btn-default" id="tw" href="{{action('QuestionController@create')}}" role="button">提问</a></li>
                        <!-- Authentication Links -->
                        @guest
                            <li><a href="{{ route('login') }}">登录</a></li>
                            <li><a href="{{ route('register') }}">注册</a></li>
                        @else
                            <li style="margin-top:13px;margin-right:30px;position:relative">
                                <div id="redY" style="display:none"></div>
                                <span id="bell" info="1"  class="glyphicon glyphicon-bell" style="font-size:25px;color:#9FADC7"></span>
                                <div class="layui-tab layui-tab-brief" id="bellTip" lay-filter="docDemoTabBrief">
                                  <ul class="layui-tab-title">

                                    <li class="layui-this a" style="width:33%;padding-top:12px;position:relative">
                                        <div id="follow" style="background-color:red;height:5px;position:relative;width:5px;position:absolute;border-radius:5px;top:10px;left:62px;z-index:1000;display:none;"></div>
                                        <span class="glyphicon glyphicon-user"></span>
                                    </li>

                                    <li class="a"style="width:33%;padding-top:12px;position:relative">
                                        <div style="background-color:red;height:5px;width:5px;position:absolute;border-radius:5px;top:10px;left:62px;z-index:1000"></div>
                                        <span class="glyphicon glyphicon-list" ></span >
                                    </li>

                                    <li class="a"style="width:33%;padding-top:12px;">
                                        
                                        <span class="glyphicon glyphicon-heart"></span>
                                    </li>

                                  </ul>
                                  <div class="layui-tab-content" style="height: 100px;">
                                    <div class="layui-tab-item layui-show" id="hid" style="height:300px;overflow:scroll">
                                        @foreach(Auth::user()->notifications as $notification)
                                            @if(!$notification->read_at)
                                                @if($notification->type === 'App\Notifications\UserFollowNotification' )
                                                 <div style="border-bottom:1px solid #D3E0E9;height:45px;width:100%;" class="gzTip follow" >
                                                    <div style="height:100%;line-height:45px;float:left">
                                                    <a href="/user/index/{{$notification->data['id']}}">{{$notification->data['name']}}</a>关注了你
                                                    </div>
                                                    <div style="float:right;line-height:45px;padding-top:14px;margin-left:10px;" class="clearGztip" userid="{{Auth::check()? Auth::user()->id :'0'}}" id="{{$notification->id}}">
                                                        <span class="glyphicon glyphicon-remove"></span>
                                                    </div>
                                                    <div style="height:100%;float:right;line-height:45px;" >
                                                        {{$notification->created_at->diffForHumans()}}
                                                    </div>
                                                </div>
                                                @endif
                                            @endif
                                       @endforeach

                                    </div>
                                    <div class="layui-tab-item" id="message">
                                        <div style="border-bottom:1px solid #6C7171">最近私信</div>
                                        
                                        <div id="first">
                                            
                                        

                                          @foreach(Auth::user()->notifications as $notification)
                                            @if(!$notification->read_at)
                                                @if($notification->type === 'App\Notifications\UserMessageNotification' )
                                                 <div style="border-bottom:1px solid #D3E0E9;height:45px;width:100%;" class="gzTip" >
                                                    <div style="height:100%;line-height:45px;float:left">
                                                    <a href="/user/index/{{$notification->data['id']}}">{{$notification->data['name']}}</a>私信了你
                                                    </div>
                                                    <div style="float:right;line-height:45px;padding-top:14px;margin-left:10px;" class="clearGztip" userid="{{Auth::check()? Auth::user()->id :'0'}}" id="{{$notification->id}}">
                                                        <!-- <span class="glyphicon glyphicon-remove"></span> -->
                                                    </div>
                                                    <div style="height:100%;float:right;line-height:45px;" >
                                                        {{$notification->created_at->diffForHumans()}}
                                                        <a href="javascript:void(0);" class="mes" userid="{{$notification->data['id']}}"data-toggle="modal" data-target="#myModal">点击查看</a>
                                                    </div>
                                                </div>
                                                @endif
                                            @endif
                                       @endforeach
                                       </div>


                                    </div>
                                    <div class="layui-tab-item">内容3</div>

                                  </div>
                                </div> 
                            </li>
                            <li style="margin-top:10px;" >
                                <img src="{{Auth::user()->avatar}}" width="30px;" alt="">
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" aria-haspopup="true">
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>
                                
                                <ul class="dropdown-menu">
                                    <li>
                                        <a href="{{action('UserController@index',array('user_id'=>Auth::id()))}}">
                                            <span class='glyphicon glyphicon-user' style="margin-right:5px;color:#9FADC7"></span>
                                            <span >个人中心</span>
                                        </a>
                                        <a href="{{ route('logout') }}"
                                            onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                            <span class='glyphicon glyphicon-off' style="margin-right:5px;color:#9FADC7"></span>
                                            登出
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
         <div id="login" flag="{{Auth::check() ? '1' : '2'}}"></div>
         <div id="useridd" flag="{{Auth::check() ? Auth::id() :'2'}}"></div>
        <div class="container">
            <!-- @include('flash::message') -->
        </div>

<!-- 私信对话开始 -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"></h4>
      </div>
      <div class="modal-body" id="messageBody" style="height:600px;overflow:scroll;">

    
    


    
       

      </div>

      <div class="modal-footer">
        <div style="">
            <div class="col-lg-6" style="width:85%;margin-top:10px;margin-left:40px;">
                <div class="input-group" >
                  <input type="text" class="form-control" id="mesBody"  placeholder="Search for...">
                  <span class="input-group-btn">

                    <button class="btn btn-default"  touserid = '' id="sendMes" style="width:100px;background-color:#0F88EB;color:white;"type="button" >发送</button>
                  </span>
                </div><!-- /input-group -->
            </div><!-- /.col-lg-6 -->
        </div>
      </div>


    </div>
  </div>
</div>
<!-- 私信对话结束 -->


        @yield('content')
    </div>
    
    <!-- Scripts -->
    <script src="https://cdn.bootcss.com/jquery/3.1.1/jquery.js"></script>
    <!--<script src="{{asset('lobibox/dist/js/Lobibox.min.js')}}"></script>-->
    <script src="{{ asset('js/app.js') }}"></script>
    <script type="text/javascript" src="{{asset('layui/layui.js')}}"></script>
    <script src="https://cdn.bootcss.com/socket.io/2.0.4/socket.io.js"></script>
    
    <script src="{{asset('jquery-tz/js/iziToast.min.js')}}"></script>
<!-- <link rel='stylesheet' href='css/animate.min.css'> -->



    <script>



    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
        var email = $('#email').attr('email');
$(function(){

    var socket = io('127.0.0.1:3001');
        socket.on('message:{{Auth::check() ? Auth::user()->email : '1' }}',function(msg){

              iziToast.show({
                    class: 'test',
                    color: 'dark',
                    icon: 'icon-contacts',
                    title: '您有新的私信!',
                    message:  msg.name+'给您发送了一条私信',
                    position: 'bottomRight',
                    transitionIn: 'flipInX',
                    transitionOut: 'fadeOut',
                    progressBarColor: 'rgb(0, 255, 184)',
                    image: msg.avatar,
                    imageWidth: 70,
                    layout:2,
                    onClose: function(){
                        console.info('onClose');
                    },
                    iconColor: 'rgb(0, 255, 184)'
                });

            var user_id = msg.id;
            var user_name = msg.name;
            var avatar = msg.avatar;
            var body = msg.body;

            $('#first').prepend(`
                <div style="border-bottom:1px solid #D3E0E9;height:45px;width:100%;" class="gzTip" >
                    <div style="height:100%;line-height:45px;float:left">
                    <a href="/user/index/`+user_id+`">`+user_name+`</a>私信了你
                    </div>
                    <div style="float:right;line-height:45px;padding-top:14px;margin-left:10px;" class="clearGztip" userid="{{Auth::check()? Auth::user()->id :'0'}}" >
                    </div>
                    <div style="height:100%;float:right;line-height:45px;" >
                        刚刚
                        <a href="" class="mes" data-toggle="modal" data-target="#myModal" userid="`+user_id+`">点击查看</a>
                    </div>
                </div>`);
            
            if($('#redY').html() > 0){
                var num = $('#redY').html();
                num++;
                $('#redY').html(''+num+'');
            }else{
                $('#redY').html('1');
            }

            $('#messageBody').append(`
                <div style="width:100%;height:auto;margin-bottom:10px;float:left">

                    <div style="width:40px;height:40px;">
                        <img src="`+avatar+`" width="40px;" style="border-radius:20px;" alt="">
                    </div>

                    <div style="margin-left:55px;margin-top:-35px;width:50%;background-color:#FFFFFF;box-shadow:0px 0px 5px #E5E5E5;border-radius:5px;padding:15px;word-wrap:break-word">
                        `+body+`
                    </div>

                </div>
            `);



        });
})

    // $('#flash-overlay-modal').modal();


    //对话的ajax
    $('.mes').click(function(){
        $('#messageBody').empty();
        var userid = $(this).attr('userid');        

        var useridd = $('#useridd').attr('flag');
        $.ajax({
            url:'/message/mes',
            data:{user_id:userid},
            type:'get',
            success:function(mes){
                console.log(mes);
                $.each(mes,function(k,v){
                    if(v['to_user_id'] == useridd){
                        $('#myModalLabel').html('与'+v['user']['name']+'的对话');

                        $('#messageBody').append(`
                        <div style="width:100%;height:auto;margin-bottom:10px;float:left">

                            <div style="width:40px;height:40px;">
                                <img src="`+v['user']['avatar']+`" width="40px;" style="border-radius:20px;" alt="">
                            </div>

                            <div style="margin-left:55px;margin-top:-35px;width:50%;background-color:#FFFFFF;box-shadow:0px 0px 5px #E5E5E5;border-radius:5px;padding:15px;word-wrap:break-word">
                                `+v['body']+`
                            </div>

                        </div>
                        `);

                    }else{

                        $('#messageBody').append(`
                             <div style="width:100%;height:auto;margin-bottom:10px;float:right">
                                <div style="width:40px;height:40px;float:right;margin-left:15px;">
                                    <img src="`+v['user']['avatar']+`" width="40px;" style="border-radius:20px;" alt="">
                                </div>

                                <div style="margin-left:55px;width:50%;background-color:#58B63B;box-shadow:0px 0px 5px #E5E5E5;border-radius:5px;padding:15px;word-wrap:break-word;float:right;color:white">
                                   `+v['body']+`
                                </div>
                            </div>
                        `);
                    }
                })

            }

        })
            $('#sendMes').attr('touserid',userid);
    })

    
    //对话发送
     $('#sendMes').click(function(){
        var toid = $(this).attr('touserid');
        var body = $('#mesBody').val();
        $(this).val('');
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
                    
                    var avatar = "{{Auth::check() ? Auth::user()->avatar : '1'}}";                    
                     $('#messageBody').append(`
                             <div style="width:100%;height:auto;margin-bottom:10px;float:right">
                                <div style="width:40px;height:40px;float:right;margin-left:15px;">
                                    <img src="`+avatar+`" width="40px;" style="border-radius:20px;" alt="">
                                </div>

                                <div style="margin-left:55px;width:50%;background-color:#58B63B;box-shadow:0px 0px 5px #E5E5E5;border-radius:5px;padding:15px;word-wrap:break-word;float:right;color:white">
                                   `+body+`
                                </div>
                            </div>
                            `);

                }
            }

        });
    })

layui.use('element', function(){
  var $ = layui.jquery
  ,element = layui.element; //Tab的切换功能，切换事件监听等，需要依赖element模块
  
  //触发事件
  var active = {
    tabAdd: function(){
      //新增一个Tab项
      element.tabAdd('demo', {
        title: '新选项'+ (Math.random()*1000|0) //用于演示
        ,content: '内容'+ (Math.random()*1000|0)
        ,id: new Date().getTime() //实际使用一般是规定好的id，这里以时间戳模拟下
      })
    }
    ,tabDelete: function(othis){
      //删除指定Tab项
      element.tabDelete('demo', '44'); //删除：“商品管理”
      
      
      othis.addClass('layui-btn-disabled');
    }
    ,tabChange: function(){
      //切换到指定Tab项
      element.tabChange('demo', '22'); //切换到：用户管理
    }
  };
  
  $('.site-demo-active').on('click', function(){
    var othis = $(this), type = othis.data('type');
    active[type] ? active[type].call(this, othis) : '';
  });

  
});
    

//关注提示--------------------------------
    function gzTip(){
        if($('.gzTip').length > 0){
            $('#redY').css({
                'display':'block',
            })
            $('#redY').html(''+$('.gzTip').length+'');
        }else{
            $('#redY').css({
                'display':'none',
            });
            $('#redY').html(''+$('.gzTip').length+'');
        }
   }

   gzTip();

   function foll(){
       if($('.follow').length > 0){
            $('#follow').css({'display':'block'})
       }else{
            $('#follow').css({'display':'none'})
       }
   }
   foll();

   $('#bell').click(function(){
        if($(this).attr('info') == '1'){
            $('#bellTip').css({
                'height':'350px',
                'transition':'all 0.4s',
            });
            $(this).attr('info','2');
        }else{
            $('#bellTip').css({
                'height':'0',
                'overflow':'hidden',
                'transition':'all 0.4s',
            });
            $(this).attr('info','1');
        }
   })

   $('.clearGztip').click(function(){

        $(this).parent().css({
            'width':'0px',
            'transition':'all 0.4s',
            'overflow':'hidden',
        });

        var id = $(this).attr('id');
        var userid = $(this).attr('userid');
        var tthis = $(this);

        

        $.ajax({
        url:'/api/follow',
        data:{user:userid,id:id},
        type:'get',
        success:function(mes){
            console.log(mes);
            console.log(tthis);
            tthis.parent().remove();
            gzTip();
            foll();
        }
    });
   })

   $('#searchInput').focus(function(){

        $(this).css({
            'width':'400px',
            'transition':'all 0.4s',
        })
        // $('#searchResult').css({
        //     'opacity':'1',
        //     'height':'auto',
        //     'overflow':'hidden',
        //     'transition':'all 0.4s',
        // })
   }).blur(function(){

        $(this).css({
            'width':'350px',
            'transition':'all 0.4s',
        })

        
   });

   $('body').click(function(){
         $('#searchResult').css({
            'opacity':'0',
            'height':'0px',
            'overflow':'hidden',
            'transition':'all 0.4s',
        })
      
   })

   $('#searchInput').on('input',function(){
    $('#searchUser').html('');
    $('#searchQuestion').html('');
    $('#searchTopic').html('');

    var nr = $(this).val();
        $.ajax({
            url:'/question/search',
            data:{title:nr},
            type:'post',
            success:function(mes){

       
                if(mes[0] != null){
                    for(var a = 0;a<mes[0].length;a++){
                        $('#searchQuestion').append(`
                            <div style="height:35px;height:auto;color:#262626;word-wrap:break-word;padding-left:10px;padding-right:10px;padding-top:10px;padding-bottom:10px;" questionid="`+mes[0][a]['id']+`" class="resultQuestion color">
                                    `+mes[0][a]['title']+`<span style="color:#8590A6">`+mes[0][a]['answers_count']+`个回答</span>
                                </div>
                                `);
                    }

                    $('.resultQuestion').click(function(){
                        window.location.href="/question/"+$(this).attr('questionid');
                        return false;
                    })
                }

                if(mes[1] != null ){
                    if(mes[1].length>0){
                    $('#searchUser').append(`
                        <div style="border-bottom:1px solid #EBEEF5;margin-top:15px;padding-bottom:5px;padding-right:10px;color:#8590A6;width:95%;margin-left:13px;" class="color">
                            用户
                        </div>
                        `);
                    }
                    for(var a = 0;a<mes[1].length;a++){
                        $('#searchUser').append(`
                            <div style="height:60px;padding:10px;" class="color">
                                <a href="/user/index/`+mes[1][a]['id']+`"><img src="`+mes[1][a]['avatar']+`" alt="" width="40px;" style="float:left;margin-right:10px;"></a>
                                <div>
                                    <div style="color:#262626">`+mes[1][a]['name']+`</div>
                                    <div>`+mes[1][a]['created_at']+`加入知乎</div>
                                </div>
                            </div>
                            `);
                    }
                }

                if(mes[2] != null){
                    if(mes[2].length>0){

                    $('#searchTopic').append(`
                         <div style="border-bottom:1px solid #EBEEF5;margin-top:15px;padding-bottom:5px;padding-right:10px;color:#8590A6;width:95%;margin-left:13px;">
                                话题
                         </div>
                        `);
                    }
                    for(var a = 0;a<mes[2].length;a++){
                        $('#searchTopic').append(`
                            <div style="height:35px;height:auto;color:#262626;word-wrap:break-word;padding-left:10px;padding-right:10px;padding-top:10px;padding-bottom:10px;" class="color">
                                    <img src="`+mes[2][a]['topic_pic']+`"  width="30px;" style="margin-right:10px;">`+mes[2][a]['name']+`
                            </div>
                            `);
                    }
                }

                if((mes[0] || mes[1] || mes[2]) != null){
                     $('#searchResult').css({
                        'opacity':'1',
                        'height':'auto',
                        'overflow':'hidden',
                        'transition':'all 0.4s',
                    })
                }

                $('.color').mouseover(function(){
                    $(this).css({
                        'cursor':'pointer',
                        'background-color':'#F4F8FB',
                    })
                }).mouseout(function(){
                    $(this).css({
                        'background-color':'white',
                    })
                })




            }
        })





   });

       $('#sendSearch').click(function(){
            if($('#searchInput').val() == ''){
                return false;
            }

        })

       $('.ht:eq(0)').click(function(){
            if($('#login').attr('flag') == '2'){
                window.location.href='/login';
                return false;
            }
       })

    </script>

    @section('js')

    @show
     
</body>
</html>
