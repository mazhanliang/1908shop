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

<table class="table">
 
  <thead>
    <tr>
      <th>id</th>
      <th>账户</th>
      <th>用户身份</th>
      <th>操作</th>
      </tr>
  </thead>
  <tbody>
  @foreach($cate as $k=>$v)
    <tr>
      <td>{{$v->k_id}}</td>
      <td>{{$v->k_name}}</td>
      <td>{{($v->k_is==1?'库管理':'库主管')}}</td> 
      
      <td>  <a href="javascript:;" onclick="del({{$v->k_id}})">删除</a> |
            <a href="{{url('ku/edit'.$v->k_id)}}">编辑</a>
      </td> 
    </tr>
    @endforeach
     
  </tbody>
</table>
        <tr><td colspan='6'>{{$cate->links()}}</td></tr>
<script>
  function del(id){
    if(!id){
      return;
    }

    if(confirm('是否要删除此条记录')){
        $.get(
              '/ku/destroy'+id,
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