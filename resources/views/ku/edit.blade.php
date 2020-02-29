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
<center><H1>管理员编辑页面</H1></center>
<!-- @if($errors->any())
<div class='alert alert-danger'>
<ul>
@foreach($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul>
</div>
@endif -->
<form  action="{{url('/ku/update'.$res->k_id)}}" method='post' class="form-horizontal" role="form" enctype='multipart/form-data'>

@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">账户</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name='k_name' value='{{$res->k_name}}' id="firstname">
				   <b style='color:red'>{{$errors->first('admin_name')}}</b>
		</div>
	</div>
    

	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">用户身份</label>
		<div class="col-sm-8">
			<input type="radio" name='k_is' value='1'  @if($res->k_is=='1') checked @endif >库管员
			<input type="radio" name='k_is' value='2' @if($res->k_is=='2') checked @endif>库主管
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
<!-- <script>
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
 

 
 
</script> -->