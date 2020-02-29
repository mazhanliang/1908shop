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
<center><H1>商品编辑页面</H1></center>
<!-- @if($errors->any())
<div class='alert alert-danger'>
<ul>
@foreach($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul>
</div>
@endif -->
<form  action="{{url('/goodss/update'.$res->goods_id)}}" method='post' class="form-horizontal" role="form" enctype='multipart/form-data'>

@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name='goods_name' value="{{$res->goods_name}}" id="firstname">
				   <b style='color:red'>{{$errors->first('goods_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品分类</label>
        <div class="col-sm-8">
			<select name="c_id" id="" class="form-control" >			 
			<option value="0">--请选择--</option>
			 @foreach($cate as $k=>$v)
			      <option value="{{$v->c_id}}" @if($res->c_id==$v->c_id) selected @endif>{{str_repeat('|---',$v->level)}}{{$v->c_name}}</option>
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
			      <option value="{{$v->id}}" @if($res->id==$v->id) selected @endif>{{$v->name}}</option>
			 @endforeach
			</select>  
				   <b style='color:red'>{{$errors->first('c_name')}}</b>
		</div>
	</div>
     
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name='goods_price' value="{{$res->goods_price}}" id="firstname">
				   <b style='color:red'>{{$errors->first('goods_price')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品缩略图</label>
		<div class="col-sm-8">
        <img src="{{env('UPLOAD_URL')}}{{$res->goods_img}}" width='50' height='40'>
			<input type="file" class="form-control" name='goods_img' id="firstname">
				  
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name='goods_number' value="{{$res->goods_number}}" id="firstname">
				   <b style='color:red'>{{$errors->first('goods_number')}}</b>
		</div>
	</div>

	
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-8">
			<input type="radio"  name='goods_jingpin' value='1' @if($res->goods_jingpin==1) checked @endif>是
			<input type="radio"   name='goods_jingpin' value='2' @if($res->goods_jingpin==2) checked @endif>否
				   
		</div>
	</div>
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否热销</label>
		<div class="col-sm-8">
		<input type="radio"  name='goods_rexiao' value='1'@if($res->goods_rexiao==1) checked @endif >是
			<input type="radio"   name='goods_rexiao' value='2' @if($res->goods_rexiao==2) checked @endif>否
			 
				    
		</div>
	</div>
    
     <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类描述</label>
		<div class="col-sm-8">
			 <textarea name="goods_desc" id="" cols="145" rows="5">{{$res->goods_desc}}</textarea>	  
			 <b style='color:red'>{{$errors->first('goods_desc')}}</b>
		</div>
	</div>   
 
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-8">

         @if($res->goods_imgs) 
        @php $photos=explode('|',$res->goods_imgs); @endphp
   
        @foreach($photos  as $vv)
            <img src="{{env('UPLOAD_URL')}}{{$vv}}" width='50' height='40'>
        @endforeach
        @endif
		<input type="file" name="goods_imgs[]" multiple='multiple'  class="form-control" />
			  
		</div>
	</div>   

	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
			<input type="submit" value='编辑'>
		</div>
	</div>
</form>

</body>
</html>
 