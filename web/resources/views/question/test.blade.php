<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<link href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
	<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
	<script src="https://cdn.bootcss.com/jquery/3.1.1/jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
	@include('vendor.ueditor.assets')
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-md-offset-2">
				<div class="panel panel-default">
					<div class="panel-heading">发布问题</div>
					{!! Form::open(['url'=>action('QuestionController@store'),'method'=>'post']) !!}
						<div class="panel-body">
							<div class="form-group{{ $errors->has('title') ? ' has-error' : '' }}">
						        {!! Form::label('title','标题') !!}
						        {!! Form::text('title',null,['class'=>'form-control','placeholder'=>'请输入标题']) !!}

						        @if($errors->has('title'))
						            <span class="help-block">
						                <strong>{{ $errors->first('title') }}</strong>
						            </span>
						        @endif
					        </div>
								
						    <div class="form-group">
						        <label for="exampleInputEmail1">Email address</label>
						   		<select class=" form-control js-example-basic-multiple" name="states[]" multiple="multiple">
								  <option value="AL">Alabama</option>
								  <option value="WY">Wyoming</option>
								  <option value="a">ddsadsa</option>

								</select>
						    </div>
					       

					        <div class="form-group{{ $errors->has('body') ? ' has-error' : '' }}">
					            {!! Form::label('body','内容') !!}

					            <!-- 百度编辑器开始 -->
					            <script id="container" style="height:200px" name="body" type="text/plain">
					                {!! old('body') !!}
					            </script>
					            <!-- 百度编辑器结束 -->

					            @if($errors->has('body'))
					                <span class="help-block">
					                    <strong>{{ $errors->first('body') }}</strong>
					                </span>
					            @endif
					        </div>
							{!! Form::submit('发布问题',['class'=>'btn btn-success btn-block'])!!}
						</div>
					{!! Form::close() !!}
				</div>
			</div>
		</div>
	</div>	
		

	<script type="text/javascript">
		$(document).ready(function() {
		    $('.js-example-basic-multiple').select2();
		});
	</script>

	<script type="text/javascript">
        

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

    ue.ready(function(){

        ue.execCommand('serverparam','_token','{{csrf_token() }}');

    })

</script>
</body>
</html>