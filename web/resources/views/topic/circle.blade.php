@extends('layouts.app')
@section('css')
	<link rel="stylesheet" href="{{asset('bootstrap-3.3.7-dist/css/bootstrap.min.css')}}">
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
		.gzTop:hover{
			cursor:pointer;
		}
	</style>
@endsection
@section('content')

	<div class="container" >
		<div class="col-md-7 col-md-offset-1" style="padding:0px;">
			<div style="height:30px;border-bottom:1px solid #CCCCCC">
			 	<span style="float:left;color:#666666;font-weight:bold"><span class="glyphicon glyphicon-th" style="margin-right:5px;"></span>话题广场</span>
			</div>

			<div style="border-bottom:1px solid #CCCCCC;padding:15px 15px 15px 0px;">
				@foreach($topics as $topic)
				<a href="/topic/detail/{{$topic->id}}"><button type="button" class="btn btn-default navbar-btn topicBt" topicid="{{$topic->id}}" style="">{{$topic->name}}</button></a>
				@endforeach
			</div>

			
			@foreach($topics as $topic)
			<div style="height:100px;margin-top:10px;border-bottom:1px solid #EEEEEE;width:48%;float:left;padding-right:5px;">
				<img src="{{$topic->topic_pic}}" width="65px;" style="border-radius:5px;margin-top:10px;float:left" alt="">
				<div style="padding-left:10px;width:75%;float:left;margin-top:10px;padding-right:10px;">
					<a href="/topic/detail/{{$topic->id}}"><span style="color:#225599;font-size:15px;font-weight:bold;">{{$topic->name}}</span></a>
					
					@if($topic->user === null)
					
					<span style="float:right;color:#698EBF" class="gzTop" topid="{{$topic->id}}"><span class="glyphicon glyphicon-plus" style="font-size:4px;"></span>关注</span>
					
					@else
					
					<span style="float:right;color:#698EBF" class="gzTop" topid="{{$topic->id}}">取消关注</span>
					@endif

				</div>
				
				<div style="font-size:13px;float:left;width:75%;height:62px;overflow:hidden;margin-top:5px;padding-left:10px;word-wrap:break-word;"><p>{{$topic->desc}}</p></div>
			</div>
			@endforeach

		</div>

		<div class="col-md-3" style="margin-left:10px;padding:0px 0px 15px 0px;padding-left:15px;">
			<div style="color:#666666;font-weight:bold">热门话题</div>
			
			@foreach($hotTopic as $topic)
			<div style="height:100px;margin-top:10px;border-bottom:1px solid #EEEEEE;width:100%;float:left;padding-right:5px;">
				<a href="/topic/detail/{{$topic->id}}"><img src="{{$topic->topic_pic}}" width="65px;" style="border-radius:5px;margin-top:10px;float:left" alt=""></a>
				<div style="padding-left:10px;width:75%;float:left;margin-top:10px;padding-right:10px;">
					<a href="/topic/detail/{{$topic->id}}"><span style="color:#225599;font-size:15px;">{{$topic->name}}</span></a>
				</div>
				<div style="font-size:13px;float:left;width:75%;height:40px;overflow:hidden;margin-top:5px;padding-left:10px;word-wrap:break-word;"><p>{{$topic->followers_count}}人关注</p></div>

				<div style="font-size:13px;height:17px;width:100%;overflow:hidden;margin-top:5px;padding-left:10px;word-wrap:break-word;"><p>{{$topic->desc}}</p></div>
			</div>
			@endforeach
		</div>


	</div>
@endsection

@section('js')
	<script src="https://cdn.bootcss.com/jquery/3.1.1/jquery.js"></script>
	<script type="text/javascript">
	$(function(){

		$('.gzTop').click(function(){

			var topic_id = $(this).attr('topid');
			var thiss = $(this);
			$.ajax({
				url:'/topic/follow',
				data:{topic_id:topic_id},
				type:'get',
				success:function(mes){
					if(mes == '1'){
						thiss.html('取消关注');
					}else{
						thiss.html('<span class="glyphicon glyphicon-plus" style="font-size:4px;"></span>关注');
					}
				}
			})
		})

		$('.gzTop').mouseover(function(){
			$(this).css({
				'color':'#2255B3',
			})
		}).mouseout(function(){
			$(this).css({
				'color':'#698EBF',
			})
		})


		

		
	})
	</script>
@endsection