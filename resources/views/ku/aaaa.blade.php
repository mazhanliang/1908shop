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

<center><H1>库管理</H1></center>
@php $aa=session('admin'); @endphp
 @if($aa['k_is']==2)
<center><a href="{{url('ku/index')}}">显示用户管理</a></center>
@endif
<center><a href="">货物管理</a></center>
<center><a href="">出入库记录管理</a></center>

 

</body>
</html>