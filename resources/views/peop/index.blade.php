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
<form>
    <input type="text" name='name' value="{{$name}}" placeholder='请输入用户名'>
    <input type="submit" value='搜索'>
</form>
<table class="table">
  <caption>上下文表格布局</caption>
  <thead>
    <tr>
      <th>id</th>
      <th>名字</th>
      <th>年龄</th>
      <th>身份证号</th>
      <th>居住地</th>
      <th>是否在湖北</th>
      <th>头像</th>
      <th>添加的时间</th>
      <th>操作</th>
      </tr>
  </thead>
  <tbody>
  @foreach($data as $k=>$v)
    <tr @if($k%2==0) class="active" @else class='success' @endif>
      <td>{{$v->id}}</td>
      <td>{{$v->name}}</td>
      <td>{{$v->age}}</td> 
      <td>{{$v->card}}</td>
      <td>{{$v->head}}</td>
      <td>{{($v->is_hubei==1?'√':'×')}}</td> 
      <td>@if($v->img)<img src="{{env('UPLOAD_URL')}}{{$v->img}}" width='66' height='66'>@endif</td> 
      <td>{{date('Y-m-d H:i:s',$v->add_time)}}</td>
      <td>  <a href="{{url('people/destroy'.$v->id)}}">删除</a> |
            <a href="{{url('people/edit'.$v->id)}}">编辑</a>
      </td> 
    </tr>
    @endforeach
    <tr><td colspan='7'>{{$data->appends(['name' =>$name])->links()}}</td></tr>
  </tbody>
</table>

</body>
</html>
<script>
    $(document).on('click','.pagination a',function(){
       var url=$(this).attr('href');
       if(!url){
         return;
       }
       $.get(url,function(res){
         $('tbody').html(res);
       })
       return false;
    })

</script>