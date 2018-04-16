@extends('layouts.app')
<link rel="stylesheet" href="{{asset('avatar/css/amazeui.min.css')}}">
<link rel="stylesheet" href="{{asset('avatar/css/amazeui.cropper.css')}}">
<link rel="stylesheet" href="{{asset('avatar/css/custom_up_img.css')}}">
<link rel="stylesheet" type="text/css" href="http://www.jq22.com/jquery/font-awesome.4.6.0.css">

@section('css')
    <style type="text/css">            
        .up-img-cover {width: 100px;height: 100px;}
        .up-img-cover img{width: 100%;}
        .up-img-txt label{font-weight: 100;margin-top: 50px;}
        
        #up-img-touch{
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
		.tou{
			border-bottom:1px solid #EBEEF5;height:100px;width:77%;float:right;
		}
        #save{
            background-color:#0F88EB;
            color:white;
        }
        #save:hover{
            background-color:#0F76C9;

        }

        #savegr{
            background-color:#0F88EB;
            color:white;
        }
        #savegr:hover{
            background-color:#0F76C9;

        }

        #savehy{
            background-color:#0F88EB;
            color:white;
        }
        #savehy:hover{
            background-color:#0F76C9;

        }

        #savehy{
            background-color:#0F88EB;
            color:white;
        }
        #savehy:hover{
            background-color:#0F76C9;

        }

        #savesex{
            background-color:#0F88EB;
            color:white;
        }
        #savesex:hover{
            background-color:#0F76C9;

        }
		.name{
			color:#333333;font-size:15px;font-weight:bold;width:12%;line-height:100px;float:left
		}
		.inp{
            width:88%;float:left;
        }
        #wordself{
            width:88%;height:100%;float:left;
        }
        #live{
			width:88%;float:left;
        }
        .change{
            width:88%;height:100%;float:left;
        }
        #cc:hover{
            cursor:pointer;
        }
        #cc{
            color:#333333;font-size:15px;color:#175199;

            display:none;
        }

        #hy:hover{
            cursor:pointer;
        }
        #hy{
            color:#333333;font-size:15px;color:#175199;

            display:none;
        }

        #ss{
             color:#333333;font-size:15px;color:#175199;
            float:left;
            margin-top:38px;
            margin-left:10px;
            display:none;
        }
        #ss:hover{
            cursor:pointer;            
        }
        #addlive:hover{
            cursor:pointer;
        }
        #changeLive:hover{
            /*background-color:#F7F8FA;*/
            cursor:pointer;
        }

        #addzy:hover{
            cursor:pointer;
        }
        #changezy:hover{
            /*background-color:#F7F8FA;*/
            cursor:pointer;
        }

        #addjy:hover{
            cursor:pointer;
        }
        #changejy:hover{
            /*background-color:#F7F8FA;*/
            cursor:pointer;
        }
        #gr:hover{
            cursor:pointer;
        }
        #gr{
            display:none;
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

                <div class="up-img-cover"  id="up-img-touch">
                    <div id="xg">
                    </div>
                    <div id="xg1">
                        <div style="font-size:40px;color:white;height:50%;text-align:center;padding-top:25%;">
                            <span class='glyphicon glyphicon-camera'></span>
                        </div>
                        <div style="height:50%;text-align:center;padding-top:10%;color:white">点击修改头像</div>
                    </div>
                    <img class="am-circle" src="{{$user->avatar}}"  width="168px" alt="" style="border-radius:10px;border:4px solid white">
                </div>
                
                <div style="padding-top:10px;">
                    <span style="margin-left:220px;font-size:30px;font-weight:bold;color:#666666;">{{$user->name}}</span>
                    <a href="/user/index/{{$user->id}}"><span style="float:right;margin-right:10px;"> < 点击返回主页</span></a>
                </div>

				<div style="height:auto;width:100%;float:left;background-color:white">
					<div class="tou" style="">
						<div class="name">性别</div>
						<div class="inp" id="sex" style="padding-top:38px;">
							<div style="color:#333333;font-size:15px;margin-right:10px;width:30px;float:left" class="pd">
                                @if($userdetails->sex == 0)
                                    女                                
                                @elseif($userdetails->sex == 1)
                                    男
                                @endif
                            </div>
							<div style="" id="cc" ><span class="glyphicon glyphicon-pencil" style="font-size:14px;"></span>编辑</div>
						</div>
						<div class="change" id="changesex" style="display:none">
                            <div style="margin-top:10px;">
							    <input type="radio" name="sex" class="sexc" value="1" 
                                    @if($userdetails->sex == 1)
                                        checked
                                    @endif
                                 style="margin-left:50px;">男
						        <input type="radio" name="sex" class="sexc" value="0"
                                    @if($userdetails->sex == 0)
                                        checked
                                    @endif
                                 style="margin-left:25px;">女
                            </div>
                            <div style="margin-left:30px;margin-top:10px;">
                                <button type="button" id="savesex" class="btn btn-default navbar-btn" style="margin-right:10px;">保存</button>
                                <button type="button" id="qx" class="btn btn-default navbar-btn" style="">取消</button>
                            </div>
						</div>
					</div>
					
					<div class="tou">
						<div class="name">一句话介绍</div>
                        <div class="inp" id="wordS">
                            <div style="margin-top:38px;color:black;font-size:15px;float:left;" class="pd">{{$userdetails->introduce}}</div>
                            <div style="" id="ss" ><span class="glyphicon glyphicon-pencil" style="font-size:14px;"></span>编辑</div>
                        </div>

						<div id="wordSelf" style="display:none">
						    <div class="input-group" style="margin-top:30px;width:80%;">
                              <input type="text" class="form-control" placeholder="一句话介绍你自己" name="introduce" value="{{$userdetails->introduce}}" maxlength="16">
                              <span class="input-group-btn">
                                <button class="btn btn-default" type="button" id="saveword" style="background-color:#0F88EB;color:white">保存</button>
                                <button class="btn btn-default" type="button" id="wordQx" >取消</button>
                              </span>
                            </div>
						</div>
					</div>

					<div class="tou" style="height:auto">
						<div class="name">居住地</div>
						<div class="inp">
                            <div style="margin-top:37px;color:#3E7AC2" id="addlive">
                                <span class="glyphicon glyphicon-plus-sign"></span> 编辑居住地
                            </div>
                        
                            <div id="live" style="display:none;margin-bottom:10px;float:left" >
                                <div class="input-group" style="margin-top:30px;width:80%;">
                                  <input type="text" class="form-control" placeholder="居住地" name="domicile" value="{{$userdetails->domicile}}" maxlength="26" >
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" id="savelive" style="background-color:#0F88EB;color:white">保存</button>
                                    <button class="btn btn-default" type="button" id="liveqx" >取消</button>
                                  </span>
                                </div>
                            </div>

                            <!-- @if($userdetails->domicile != '') -->
                                <div id="changeLive" style="margin-top:10px;margin-bottom:10px;height:35px;width:80%;border-radius:5px;float:left">
                                    <div style="height:100%;line-height:35px;margin-left:15px;width:90%;float:left" class="pd">{{$userdetails->domicile}}</div>
                                    <div style="float:right;width:5%;padding-top:8px;opacity:0" id="delLive" ><!-- <span class="glyphicon glyphicon-remove"></span> --></div>
                                </div>
                            <!-- @endif -->
						</div>
					</div>

					<div class="tou">
						<div class="name">所在行业</div>
 						<div class="inp" id="hangye" style="margin-top:37px;height:100px;">
							<div style="color:#333333;font-size:15px;margin-right:10px;float:left" class="pd">{{$userdetails->industry}}</div>
                            <div style="" id="hy" style="display:none"><span class="glyphicon glyphicon-pencil" style="font-size:14px;"></span>编辑</div>
						</div>
                        <div style="margin-top:35px;display:none;width:40%" id="hysel" >
                            <select data-am-selected="{maxHeight: 200}" id="hysel1" name="industry">
                              <option value="高新科技">高新科技</option>
                              <option value="互联网">互联网</option>
                              <option value="电子商务">电子商务</option>
                              <option value="电子游戏">电子游戏</option>
                              <option value="信息传媒">信息传媒</option>
                              <option value="计算机软件">计算机软件</option>
                              <option value="计算机软件">计算机软件</option>
                              <option value="计算机硬件">计算机硬件</option>
                              <option value="电影录音">电影录音</option>
                              <option value="广播电视">广播电视</option>
                              <option value="银行">银行</option>
                              <option value="通信">通信</option>
                              <option value="金融">金融</option>
                              <option value="金融">金融</option>
                              <option value="保险">保险</option>
                              <option value="财务">财务</option>
                              <option value="法律">法律</option>
                              <option value="信贷">信贷</option>
                              <option value="审计">审计</option>
                              <option value="餐饮">餐饮</option>
                              <option value="公关">公关</option>
                              <option value="酒店">酒店</option>
                              <option value="广告">广告</option>
                            </select>
                            <span class="input-group-btn" style="float:right">
                                    <button class="btn btn-default" type="button" id="savehy" style="background-color:#0F88EB;color:white">保存</button>
                                    <button class="btn btn-default" type="button" id="hyqx" >取消</button>
                            </span>
                        </div>
					</div>

					<div class="tou" style="height:auto">
						<div class="name">职业经历</div>
                        <div class="inp">
                            <div style="margin-top:37px;color:#3E7AC2" id="addzy">
                                <span class="glyphicon glyphicon-plus-sign"></span> 编辑就业信息
                            </div>

                            <div id="zy" style="display:none;margin-bottom:10px;float:left" >
                                <div class="input-group" style="margin-top:30px;width:80%;">
                                  <input type="text" class="form-control" placeholder="公司" name="career" value="{{$userdetails->career}}" maxlength="13">
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" id="savezy" style="background-color:#0F88EB;color:white">保存</button>
                                    <button class="btn btn-default" type="button" id="zyqx" >取消</button>
                                  </span>
                                </div>
                            </div>
                            <!-- @if($userdetails->career != '') -->
                            <div id="changezy" style="margin-top:10px;margin-bottom:10px;height:35px;width:80%;border-radius:5px;float:left">
                                <div style="height:100%;line-height:35px;margin-left:15px;width:90%;float:left" class="pd">{{$userdetails->career}}</div>
                                <div style="float:right;width:5%;padding-top:8px;opacity:0" id="delzy" ><span class="glyphicon glyphicon-remove"></span></div>
                            </div>
                            <!-- @endif -->
                        </div>
					</div>

					<div class="tou" style="height:auto">
						<div class="name">教育经历</div>
						<div class="inp">
							<div style="margin-top:37px;color:#3E7AC2" id="addjy">
                                <span class="glyphicon glyphicon-plus-sign"></span> 编辑教育经历
                            </div>

                            <div id="jy" style="display:none;margin-bottom:10px;float:left" >
                                <div class="input-group" style="margin-top:30px;width:80%;">
                                  <input type="text" class="form-control" placeholder="教育" value="{{$userdetails->experience}}" name="experience" >
                                  <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" id="savejy"  style="background-color:#0F88EB;color:white">保存</button>
                                    <button class="btn btn-default" type="button" id="jyqx" >取消</button>
                                  </span>
                                </div>
                            </div>
                            
                            <!-- @if($userdetails->experience != '') -->
                            <div id="changejy" style="margin-top:10px;margin-bottom:10px;height:35px;width:80%;border-radius:5px;float:left">
                                <div style="height:100%;line-height:35px;margin-left:15px;width:90%;float:left" class="pd">{{$userdetails->experience}}</div>
                                <div style="float:right;width:5%;padding-top:8px;opacity:0" id="deljy" ><span class="glyphicon glyphicon-remove"></span></div>
                            </div>
                            <!-- @endif -->
						</div>
					</div>

					<div class="tou" style="height:auto">
						<div class="name">个人简介</div>
						<div class="inp">
                            <div style="border:1px solid white;margin-top:38px;position:relative;" id="grjj">
    							<div style="height:auto;width:80%;word-wrap:break-word; overflow:hidden;margin-bottom:50px;" class="pd">{{$userdetails->individual}}</div>
                                <div style="color:#3E7AC2;float:right;height:30px;float:right;position:absolute;bottom:17px;left:0px;" id="gr"><span class="glyphicon glyphicon-pencil" style="font-size:14px;"></span>编辑</div>
                            </div>
                            <div style="width:80%;margin-top:10px;display:none" id="addgr">
                               <textarea class="form-control" rows="3" name="individual" value="{{$userdetails->individual}}"></textarea>
                                <div style="">
                                    <button type="button" id="savegr" class="btn btn-default navbar-btn" style="margin-right:10px;">保存</button>
                                    <button type="button" id="grqx" class="btn btn-default navbar-btn" style="">取消</button>
                                </div>
                            </div>
						</div>
					</div>


				</div>
            </div>
        </div>
    </div>   
</div>
<!-- 修改头像-->

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

    <!-- 用来判断是否收起列表框 -->
    <div id="pd" flag="true"></div>
    <!-- 用来判断是否收起列表框 -->

@endsection
<!-- laravel-lamp -->

@section('js')
<script src="https://cdn.bootcss.com/jquery/3.1.1/jquery.js"></script>
<script type="text/javascript" src="{{asset('layer/layer.js')}}"></script>
<!-- <script src="http://www.jq22.com/jquery/jquery-1.10.2.js"></script> -->
<script src="https://cdn.bootcss.com/amazeui/2.7.2/js/amazeui.min.js" charset="utf-8"></script>
<script src="{{asset('avatar/js/cropper.min.js')}}" charset="utf-8"></script>
<script src="{{asset('avatar/js/custom_up_img.js')}}" charset="utf-8"></script>
<script type="text/javascript">
window.onload = function(){ 

    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

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

    $('#sex').mouseover(function(){

        $('#cc').css({
            'display':'block',
        });

    }).mouseout(function(){
        
        if($(this).find('div:eq(0)').text() != ''){
            $('#cc').css({
                'display':'none',
            })
        }
    });
    //关于本页修改js特效开始
    $('#cc').click(function(){
        $('#changesex').css({
            'display':'block',
        });
        $('#cc').css({
            'display':'none',
        });
        $('#sex').css({
            'display':'none',
        });
    });

    $('#qx').click(function(){
        $('#changesex').css({
            'display':'none',
        });
        $('#cc').css({
            'display':'block',
        });
        $('#sex').css({
            'display':'block',
        });
    });

    $('#wordS').mouseover(function(){
        $('#ss').css({
            'display':'block',
        });

    }).mouseout(function(){
        if($(this).find('div:eq(0)').text() != ''){
            $('#ss').css({
                'display':'none',
            })
        }
    });

    $('#ss').click(function(){
        $('#wordSelf').css({
            'display':'block',
        })
        $('#wordS').css({
            'display':'none',
        })
    });

    $('#wordQx').click(function(){
       $('#wordSelf').css({
            'display':'none',
        })
        $('#wordS').css({
            'display':'block',
        }) 
    })

    //居住地
    $('#addlive').click(function(){
        $(this).css({
            'display':'none',
        })
        $('#live').css({
            'display':'block',
        })
    })

    $('#liveqx').click(function(){
         $('#live').css({
            'display':'none',
        })
        $('#addlive').css({
            'display':'block',
        })
    })
    $('#changeLive').mouseover(function(){
        $(this).css({
            'background-color':'#F7F8FA',
            'transition':'all 0.2s',
        })

        $('#delLive').css({
            'opacity':'1',
            'transition':'all 0.2s',
        })
    }).mouseout(function(){
        $(this).css({
            'background-color':'white',
            'transition':'all 0.2s',
        })
        $('#delLive').css({
            'opacity':'0',
            'transition':'all 0.2s',
        })
    })

    //行业
    $('#hy').click(function(){
        $('#hangye').css({
            'display':'none',
        })
        $('#hysel').css({
            'display':'block',
        })
    })

    $('#hyqx').click(function(){
        $('#hangye').css({
            'display':'block',
        })
        $('#hysel').css({
            'display':'none',
        })
    })


    $('#hangye').mouseover(function(){
        $('#hy').css({
            'display':'block',
        });

    }).mouseout(function(){
        if($(this).find('div:eq(0)').text() !=''){
            $('#hy').css({
                'display':'none',
            })
        }
    });

    //职业经历
        $('#addzy').click(function(){
        $(this).css({
            'display':'none',
        })
        $('#zy').css({
            'display':'block',
        })
    })

    $('#zyqx').click(function(){
         $('#zy').css({
            'display':'none',
        })
        $('#addzy').css({
            'display':'block',
        })
    })
    $('#changezy').mouseover(function(){
        $(this).css({
            'background-color':'#F7F8FA',
            'transition':'all 0.2s',
        })

        $('#delzy').css({
            'opacity':'1',
            'transition':'all 0.2s',
        })
    }).mouseout(function(){
        $(this).css({
            'background-color':'white',
            'transition':'all 0.2s',
        })
        $('#delzy').css({
            'opacity':'0',
            'transition':'all 0.2s',
        })
    })


    //教育经历
    $('#addjy').click(function(){
        $(this).css({
            'display':'none',
        })
        $('#jy').css({
            'display':'block',
        })
    })

    $('#jyqx').click(function(){
         $('#jy').css({
            'display':'none',
        })
        $('#addjy').css({
            'display':'block',
        })
    })
    $('#changejy').mouseover(function(){
        $(this).css({
            'background-color':'#F7F8FA',
            'transition':'all 0.2s',
        })

        $('#deljy').css({
            'opacity':'1',
            'transition':'all 0.2s',
        })
    }).mouseout(function(){
        $(this).css({
            'background-color':'white',
            'transition':'all 0.2s',
        })
        $('#deljy').css({
            'opacity':'0',
            'transition':'all 0.2s',
        })
    })

    //个人
    $('#grjj').mouseover(function(){
        $('#gr').css({
            'display':'block',
        })
    }).mouseout(function(){
        if($(this).find('div:eq(0)').text() != ''){
            $('#gr').css({
                'display':'none',
            })
        }
    })

    $('#gr').click(function(){
        $('#grjj').css({
            'display':'none',
        })
        $('#addgr').css({
            'display':'block',
        })
    })
    $('#grqx').click(function(){
         $('#grjj').css({
            'display':'block',
        })
        $('#addgr').css({
            'display':'none',
        })
    })

    for(var a = 0;a<$('.pd').length;a++){
        if($('.pd:eq('+a+')').text() == '' ){
            $('.pd:eq('+a+')').next().css({
                'display':'block',
            })
        }
    }

    //关于本页修改js特效结束

    //用ajax传递值修改
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

        //性别更改
        var sex = null;
        $('.sexc').click(function(){
            sex = $(this).val();
        });
        $('#savesex').click(function(){

            $.ajax({
                url:"/user/updateDetail",
                data:{sex:sex},
                type:'post',
                success:function(mes){
                    if(mes == '1'){
                        var sexx
                        if(sex == '1'){
                            sexx = '男';
                        }else{
                            sexx = '女';
                        }
                        $('.pd:eq(0)').html(''+sexx+'');
                        $('#changesex').css({
                            'display':'none',
                        })
                        $('#sex').css({
                            'display':'block',
                        })
                        layer.msg('修改成功');

                    }
                }
            })
        })

        //一句话介绍自己
        $('#saveword').click(function(){
            var introduce = $('input[name="introduce"]').val();
            if(introduce == ''){
                return false;
            }
            $.ajax({
                url:"/user/updateDetail",
                data:{introduce:introduce},
                type:'post',
                success:function(mes){
                    if(mes == '1'){
                        $('.pd:eq(1)').html(''+introduce+'');
                        $('input[name="introduce"]').attr('value',introduce);
                        $('#wordS').css({
                            'display':'block',
                        })
                        $('#wordSelf').css({
                            'display':'none',
                        })
                        layer.msg('修改成功');
                    }
                }
            })
        })

        //修改居住地
        $('#savelive').click(function(){
            var domicile = $('input[name="domicile"]').val();
            $('input[name="domicile"]').attr('value',domicile);
            if(domicile == ''){
                return false;
            }
            $.ajax({
                url:"/user/updateDetail",
                data:{domicile:domicile},
                type:'post',
                success:function(mes){
                    if(mes == '1'){
                        $('#changelive').css({
                            'display':'block',
                        })
                        $('#live').css({
                            'display':'none',
                        })
                        $('#addlive').css({
                            'display':'block',
                        })
                        $('.pd:eq(2)').html(''+domicile+'');
                        layer.msg('修改成功');
                    }
                }
            })
        })

        //修改所在行业
        var industry = null;
        $('select[name="industry"]').change(function(){
            industry = $(this).val();
        })

        $('#savehy').click(function(){
             $.ajax({
                url:"/user/updateDetail",
                data:{industry:industry},
                type:'post',
                success:function(mes){
                    if(mes == '1'){
                      $('.pd:eq(3)').html(''+industry+'');
                      $('#hysel').css({
                        'display':'none',
                      })
                      $('#hangye').css({
                        'display':'block',
                      })
                      layer.msg('修改成功');
                    }
                }
            })
        })

        //职业经历修改
        $('#savezy').click(function(){
            var career = $('input[name="career"]').val();
            if(career == ''){
                return false;
            }
            $.ajax({
                url:"/user/updateDetail",
                data:{career:career},
                type:'post',
                success:function(mes){
                    if(mes == '1'){
                        $('.pd:eq(4)').html(''+career+'');
                        $('input[name="career"]').attr('value',career);
                        $('#changezy').css({
                            'display':'block',
                        })
                        $('#zy').css({
                            'display':'none',
                        })
                        $('#addzy').css({
                            'display':'block',
                        })
                        layer.msg('修改成功');
                    }
                }
            })
        })

        //教育经历修改
        $('#savejy').click(function(){
            var experience = $('input[name="experience"]').val();
            if(experience == ''){
                return false;
            }
            $.ajax({
                url:"/user/updateDetail",
                data:{experience:experience},
                type:'post',
                success:function(mes){
                    if(mes == '1'){
                        $('.pd:eq(5)').html(''+experience+'');
                        $('input[name="experience"]').attr('value',experience);
                        $('#changejy').css({
                            'display':'block',
                        })
                        $('#jy').css({
                            'display':'none',
                        })
                        $('#addjy').css({
                            'display':'block',
                        })
                        layer.msg('修改成功');
                    }
                }
            })
        })

        //个人简介修改
        $('#savegr').click(function(){
            var individual = $('textarea[name="individual"]').val();
            console.log(individual);
            if(individual == ''){
                return false;
            }

            $.ajax({
                url:"/user/updateDetail",
                data:{individual:individual},
                type:'post',
                success:function(mes){
                    if(mes == '1'){
                        $('.pd:eq(6)').html(''+individual+'');
                        $('textarea[name="individual"]').attr('value',individual);
                        $('#addgr').css({
                            'display':'none',
                        })
                        $('#grjj').css({
                            'display':'block',
                        })
                        layer.msg('修改成功');
                    }
                }
            })

        })




}
</script>
@endsection