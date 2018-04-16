
// init
// 获取父容器的宽度
var ucw = $('.upload-container').width();

	// pc展示的宽度
	var display_width = ucw;
	var display_height = 240;

	// mobile展示的宽度
	var mobile_width = 600;
	var mobile_height = 240;

	// canvas
	var convasObj;
	var canvas_start_y; // 点击canvas开始Y位置
	var beyondHeight = 0; // 溢出的高度

	// 必要的 mousemove事件
	var before = 0; 

	// 对应元素获取
	var pic_inp = document.getElementsByName('pic')[0];
	var upload_btn = document.getElementById('#fm');
	var container = document.getElementsByClassName('upload-container')[0];
	var convasContainer = container.querySelector('.canvasContainer');
	var upc = document.getElementsByClassName('upload-control')[0];
	var canvasObj;

	// 编辑背景图片按钮
	upload_btn.onclick = function(){
		pic_inp.click(); // 触发文件选择框点击事件
	}

	// input框绑定内容改变事件
	pic_inp.addEventListener('change', function(){
		
		if(this.files[0]){

			// 获取选中的文件
			var selected_file = this.files[0];


			if( selected_file.type != 'image/png' && selected_file.type != 'image/jpeg' ){
				layer.msg('图片格式不允许', function(){});
				return false;
			}

			upc.style.display = 'block';
			
			// 将上传的图片转换为base64
			var fr = new FileReader();
			fr.readAsDataURL(selected_file);
			fr.onload = function(){
		
				// 创建img元素
				var imgs = new Image();
				imgs.src = this.result; // dataURL
				imgs.width = display_width; // Images 的指定宽度
				
				imgs.onload = function(){
					
					// 获取縮放计算后的高度
					document.body.appendChild(imgs);
					var computed_height = parseInt(getComputedStyle(imgs).height);
					var width = imgs.width;
					document.body.removeChild(imgs);
					
					// 创建canvas
					canvasObj = create_canvas_ele(display_width, computed_height );
					canvasObj.canvasEle.style.cssText = 'position: absolute; left: 0px; top: 0px;';
					
					// 载入图像
					canvasObj.ctx.drawImage(this, 0, 0, width, computed_height);
				
					// 绑定鼠标移动事件
					canvasObj.canvasEle.addEventListener('mousedown', function(e){
						
						// 点击的Y坐标
						canvas_start_y = e.clientY;
						
						// 溢出的y高度
						beyondHeight = canvasObj.canvasEle.height - display_height;
						document.body.style.cssText += 'cursor: pointer';
						
						// 绑定移动事件
						document.addEventListener('mousemove', moveEvent);
						
					});
					
					// 绑定鼠标抬起事件
					document.addEventListener('mouseup', function(e){
						document.removeEventListener('mousemove', moveEvent);
						before = 0;
						document.body.style.cssText += 'cursor: default';
					});
					
					// 创建左侧与右侧的遮罩层
					var mDiv = create_over_fllow();
					convasContainer.appendChild(canvasObj.canvasEle);
					convasContainer.appendChild(mDiv);
					
				}
				
			}
		}
	});

	function moveEvent(e){
		
		// 获取本次距离点击点移动的相对距离 减去上一次移动距离点击点的相对距离
		var moveY = e.clientY - canvas_start_y - before;
		
		var origin = parseInt(canvasObj.canvasEle.style.top);
		
		// 溢出距离
		var bottomBeyond = origin + moveY + canvasObj.canvasEle.height - display_height;
		
		// 碰撞检测
		if( Math.abs(origin+moveY) <= beyondHeight && bottomBeyond <= beyondHeight ){
			canvasObj.canvasEle.style.top = origin + moveY + 'px';
		}
		
		// 本次移动触发事件结束后记录 相对点击点移动的距离
		before = e.clientY - canvas_start_y;
	}

	// canvas元素的创建 并返回context2d
	function create_canvas_ele(width, height){
		var canvasEle = document.createElement('canvas');
		canvasEle.width = width;
		canvasEle.height = height;
		return {
			canvasEle: canvasEle,
			ctx: canvasEle.getContext('2d')
		};
	}


	// 遮罩层的创建
	function create_over_fllow(){
		
		var newDiv = document.createElement('div');
		newDiv.style.cssText += 'width: 100%; height: 100%; position:absolute; left:0px; top: 0px; pointer-events:none;';
		
		var mDiv = document.createElement('div');
		mDiv.style.cssText += 'width:' + mobile_width + 'px; height:' + mobile_height + 'px; position: absolute; left:calc( (100% - ' + mobile_width + 'px) / 2 );'
		
		newDiv.appendChild(mDiv);
		var leftOver = document.createElement('div');
		
		leftOver.style.cssText += 'height: ' + mobile_height + 'px; position: absolute; width: calc( (100% - ' + mobile_width + 'px) / 2 );background-color:rgba(255, 255, 255, 0.4);';

		var rightOver = leftOver.cloneNode();
		
		rightOver.style.right = '0px';
		leftOver.style.left = '0px';
		leftOver.style.borderRight = "2px solid #fff";
		rightOver.style.borderLeft = "2px solid #fff";
		
		newDiv.appendChild(leftOver);
		newDiv.appendChild(rightOver);
		
		return newDiv;
	}

	function allow_upload(){
		
		var cropped_canvas = convasContainer.querySelector('canvas');
		
		// 获取top值
		var cropped_start_top = Math.abs(parseInt(cropped_canvas.style.top));
		
		// 裁剪PC端图片
		var pc_dataUrl = cropper_image(canvasObj.ctx, 0, cropped_start_top, display_width, display_height);
		
		// 裁剪Mobile端图片
		var startX = (display_width - mobile_width) / 2;
		var width = mobile_width;
		var startY = cropped_start_top;
		var height = display_height;
		
		var mobile_dataUrl = cropper_image(canvasObj.ctx, startX, startY, width, height);
		
		cropper_successly({
			'pc_dataUrl': pc_dataUrl,
			'mobile_dataUrl': mobile_dataUrl,
			'mobile':{
				'm_startX': startY,
				'm_width': width,
				'm_startY': startY,
				'm_height': height
			}
		});

	}

	function init(){
		convasContainer.removeChild(convasContainer.querySelector('canvas'));
		convasContainer.removeChild(convasContainer.querySelector('div'));
		upc.style.display = 'none';
	}

	function cropper_image(origin_canvas_context, startX, startY, width, height){
		
		var imgData = origin_canvas_context.getImageData(startX, startY, width, height);
		
		var newCanvasObj = create_canvas_ele();
		newCanvasObj.canvasEle.width = imgData.width;
		newCanvasObj.canvasEle.height = imgData.height;
		newCanvasObj.canvasEle.id = 'tmp_canvas';
		document.body.appendChild(newCanvasObj.canvasEle);
		
		newCanvasObj.ctx.putImageData(imgData, 0, 0);
		newCanvasObj.canvasEle.style.display = 'none';
		var dataURL = newCanvasObj.canvasEle.toDataURL();
		document.body.removeChild( newCanvasObj.canvasEle );
		
		return dataURL;
		
	}

