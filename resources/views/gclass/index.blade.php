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

<center><H1>管理列表</H1></center>
 
<table class="table">
 
  <thead>
    <tr>
      <th>id</th>
      <th>分类名称</th>
   
      <th>分类描述</th>
      <th>操作</th>
      </tr>
  </thead>
  <tbody>
  @foreach($cate as $k=>$v)
    <tr>
      <td>{{$v->c_id}}</td>
      <td>{{str_repeat('|---',$v->level)}}{{$v->c_name}}</td>
    
      <td>{{$v->c_text}}</td> 
      
      <td> <a href="javascript:void(0)" onclick="del({{$v->c_id}})">删除</a> |
            <a href="{{url('goods/edit'.$v->c_id)}}">编辑</a>
      </td> 
    </tr>
    @endforeach
    
  </tbody>
</table>
<script>
  function del(id){
  
    if(!id){
      return;
    }

    if(confirm('是否要删除此条记录')){
        $.get(
              '/goods/destroy'+id,
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