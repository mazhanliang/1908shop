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
<center><H1>用户登录页面</H1></center>
<!-- @if($errors->any())
<div class='alert alert-danger'>
<ul>
@foreach($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul>
</div>
@endif -->
<form  action="{{url('/logindo1')}}" method='post' class="form-horizontal" role="form"  >
<center> <b style='color:red'>{{session('msg')}}</b></center>
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">用户名</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name='k_name' id="firstname" 
				   placeholder="请输入用户名">
				   <b style='color:red'>{{$errors->first('k_name')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">密码</label>
		<div class="col-sm-8">
			<input type="password" class="form-control" name='k_pwd' id="firstname" 
				   placeholder="请输入密码">
				   <b style='color:red'>{{$errors->first('k_pwd')}}</b>
		</div>
	</div>
    
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
			<input type="submit" value='登录'>
		</div>
	</div>
</form>

</body>
</html>