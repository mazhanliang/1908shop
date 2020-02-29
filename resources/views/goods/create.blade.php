<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>Bootstrap 实例 - 水平表单</title>
	<link rel="stylesheet" href="/static/css/bootstrap.min.css">  
	<script src="/static/js/jquery.min.js"></script>
	<script src="/static/js/bootstrap.min.js"></script>
</head>
<body>
<center><H1>商品添加页面</H1></center>
<!-- @if($errors->any())
<div class='alert alert-danger'>
<ul>
@foreach($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul>
</div>
@endif -->
<form  action="{{url('/goodss/store')}}" method='post' class="form-horizontal" role="form" enctype='multipart/form-data'>

@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name='goods_name' id="firstname">
				   <b style='color:red'>{{$errors->first('goods_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品分类</label>
        <div class="col-sm-8">
			<select name="c_id" id="" class="form-control" >			 
			<option value="0">--请选择--</option>
			 @foreach($cate as $k=>$v)
			      <option value="{{$v->c_id}}">{{str_repeat('|---',$v->level)}}{{$v->c_name}}</option>
			 @endforeach
			</select>  
        </div>
    </div>

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品品牌</label>
		<div class="col-sm-8">
		<select name="id" id="" class="form-control">			 
			<option value="0">--请选择--</option>
			 @foreach($pinpai as $k=>$v)
			      <option value="{{$v->id}}">{{$v->name}}</option>
			 @endforeach
			</select>  
				   <b style='color:red'>{{$errors->first('c_name')}}</b>
		</div>
	</div>
     
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name='goods_price' id="firstname">
				   <b style='color:red'>{{$errors->first('goods_price')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品缩略图</label>
		<div class="col-sm-8">
			<input type="file" class="form-control" name='goods_img' id="firstname">
				  
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name='goods_number' id="firstname">
				   <b style='color:red'>{{$errors->first('goods_number')}}</b>
		</div>
	</div>

	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-8">
			<input type="radio"  name='goods_jingpin' value='1' >是
			<input type="radio"   name='goods_jingpin' value='2' >否
				   
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否热销</label>
		<div class="col-sm-8">
		<input type="radio"  name='goods_rexiao' value='1' >是
			<input type="radio"   name='goods_rexiao' value='2' >否
			 
				    
		</div>
	</div>
    
     <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类描述</label>
		<div class="col-sm-8">
			 <textarea name="goods_desc" id="" cols="145" rows="5"></textarea>	  
			 <b style='color:red'>{{$errors->first('goods_desc')}}</b>
		</div>
	</div>   
 
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-8">
		<input type="file" name="goods_imgs[]" multiple='multiple'  class="form-control" />
			  
		</div>
	</div>   

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
			<input type="submit" value='添加'>
		</div>
	</div>
</form>

</body>
</html>
<script>
	$('input[type="button"]').click(function(){
		var titleflag=true;
		$('input[name="c_name"]').next().html('');
		 var c_name=$('input[name="c_name"]').val();
		var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
		if(!reg.test(c_name)){
			$('input[name="c_name"]').next().html('分类名称不能为空');
			return;
		} 
		if(!titleflag){
			return;
		}
	 
		 $('form').submit();

	})

	$('input[name="c_name"]').blur(function(){
		$(this).next().html('');
		 var name=$(this).val();
		 var reg=/^[\u4e00-\u9fa50-9A-Za-z_-]+$/;
		 if(!reg.test(name)){
			 $(this).next().html('分类名称不能为空')
			 return;
		 }
	})
 

 
 
</script>