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
<center><H1>外来务工人员统计</H1></center>
<!-- @if($errors->any())
<div class='alert alert-danger'>
<ul>
@foreach($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul>
</div>
@endif -->
<form  action="{{url('/people/store')}}" method='post' class="form-horizontal" role="form" enctype="multipart/form-data">

@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">名字</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name='name' id="firstname" 
				   placeholder="请输入名字">
				   <b style='color:red'>{{$errors->first('name')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">年龄</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name='age' id="firstname" 
				   placeholder="请输入年龄">
				   <b style='color:red'>{{$errors->first('age')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">身份证号</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name='card' id="firstname" 
				   placeholder="请输入身份证号">
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">居住地</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name='head' id="firstname" 
				   placeholder="请输入居住地">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否在湖北</label>
 
		 
		<div class="col-sm-8">
            <input type="radio" name="is_hubei"   value="1" >是
            <input type="radio" name="is_hubei"   value="2">否
		</div>
	     
    </div>
        <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">头像</label>
		<div class="col-sm-8">
			<input type="file" class="form-control" name='img' >
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