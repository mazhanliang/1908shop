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

<center><H1>商品管理列表</H1></center>
 
<table class="table">
 
  <thead>
    <tr>
      <th>id</th>
      <th>商品名称</th>
      <th>商品分类</th>
      <th>商品品牌</th>
      <th>商品缩略图</th>
      <th>是否精品</th>
      <th>是否热销</th>
      <th>商品描述</th>
      <th>商品相册</th>
      <th>操作</th>
      </tr>
  </thead>
  <tbody>
  @foreach($cate as $k=>$v)
    <tr>
      <td>{{$v->goods_id}}</td>
      <td>{{$v->goods_name}}</td>
      <td>{{$v->c_name}}</td> 
      <td>{{$v->name}}</td>
      <td><img src="{{env('UPLOAD_URL')}}{{$v->goods_img}}" width='50' height='40'></td> 
      <td>{{($v->goods_jingpin==1?'是':'否')}}</td>
      <td>{{($v->goods_rexiao==1?'是':'否')}}</td>
      <td>{{$v->goods_desc}}</td>
      <td>
      @if($v->goods_imgs) 
        @php $photos=explode('|',$v->goods_imgs); @endphp
   
        @foreach($photos  as $vv)
            <img src="{{env('UPLOAD_URL')}}{{$vv}}" width='50' height='40'>
        @endforeach
        @endif
      </td>
       
      <td>  <a href="javascript:;" onclick="del({{$v->goods_id}})">删除</a> |
            <a href="{{url('goodss/edit'.$v->goods_id)}}">编辑</a>
      </td> 
    </tr>
    @endforeach
     
  </tbody>
</table>
        <tr><td colspan='10'>{{$cate->links()}}</td></tr>
<script>
  function del(id){
    if(!id){
      return;
    }

    if(confirm('是否要删除此条记录')){
        $.get(
              '/goodss/destroy'+id,
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