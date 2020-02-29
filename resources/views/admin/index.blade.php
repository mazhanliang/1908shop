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

<center><H1>管理员列表</H1></center>
<form>
    <input type="text" name='admin_name' value="{{$admin_name}}" placeholder='请输入账户'>
    <input type="submit" value='搜索'>
</form>
<table class="table">
 
  <thead>
    <tr>
      <th>id</th>
      <th>账户</th>
      <th>手机号</th>
      <th>邮箱</th>
      <th>头像</th>
      <th>操作</th>
      </tr>
  </thead>
  <tbody>
  @foreach($cate as $k=>$v)
    <tr>
      <td>{{$v->admin_id}}</td>
      <td>{{$v->admin_name}}</td>
      <td>{{$v->admin_tel}}</td> 
      <td>{{$v->admin_email}}</td>
      <td><img src="{{env('UPLOAD_URL')}}{{$v->admin_img}}" width='50' height='40'></td> 
      
      <td>  <a href="javascript:;" onclick="del({{$v->admin_id}})">删除</a> |
            <a href="{{url('admin/edit'.$v->admin_id)}}">编辑</a>
      </td> 
    </tr>
    @endforeach
     
  </tbody>
</table>
        <tr><td colspan='6'>{{$cate->appends(['admin_name'=>$admin_name])->links()}}</td></tr>
<script>
  function del(id){
    if(!id){
      return;
    }

    if(confirm('是否要删除此条记录')){
        $.get(
              '/admin/destroy'+id,
              function(res){
                 if(res.code=='00000'){
                   location.reload();
                 }
              },'json'
        )
    }
  }
</script>
</body>
</html>