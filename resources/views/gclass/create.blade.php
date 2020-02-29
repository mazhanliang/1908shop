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
<center><H1>商品分类添加页面</H1></center>
<!-- @if($errors->any())
<div class='alert alert-danger'>
<ul>
@foreach($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul>
</div>
@endif -->
<form  action="{{url('/goods/store')}}" method='post' class="form-horizontal" role="form">

@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name='c_name' id="firstname">
				   <b style='color:red'>{{$errors->first('c_name')}}</b>
		</div>
	</div>
    
    

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">父级分类</label>
        <div class="col-sm-8">
			<select name="parent_id" id="">
			 
			<option value="0">--请选择--</option>
			 @foreach($cate as $k=>$v)
			      <option value="{{$v->c_id}}">{{str_repeat('|---',$v->level)}}{{$v->c_name}}</option>
			 @endforeach
			</select>
		 
		  
        </div>
    </div>
         

     
     <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类描述</label>
		<div class="col-sm-8">
			 <textarea name="c_text" id="" cols="145" rows="5"></textarea>	  
			 <b style='color:red'>{{$errors->first('c_text')}}</b>
		</div>
	</div>   
 
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
			<input type="button" value='添加'>
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