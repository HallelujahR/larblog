@if(!$notification->read_at)
<li class='list-group-item userfollow' id="{{$notification->id}}">
	<a href="/user/index/{{$notification->data['id']}}">{{$notification->data['name']}}</a>在{{$notification->created_at->diffForHumans()}}关注了你
</li>
@endif
@section('js')
	<script type="text/javascript">
		$('.userfollow').click(function(){
			$.ajax({
				url:'/api/follow',
				data:{user:{{Auth::user()->id}},id:'{{$notification->id}}'},
				type:'get',
				success:function(mes){
					li.fadeOut(500);
				}
			});
		});
	</script>
@endsection