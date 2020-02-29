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
<form>
<select name="fenlei">
                 <option value="">全部分类</option>
                <option value="手机促销" @if($fenlei=='手机促销') selected @endif>手机促销</option>
                <option value="3G咨询"  @if($fenlei=='3G咨询') selected @endif>3G咨询</option>
                <option value="站内快讯"  @if($fenlei=='站内快讯') selected @endif>站内快讯</option>
                <option value="站外快讯"  @if($fenlei=='站外快讯') selected @endif>站外快讯</option>
</select>
<input type="text" name='biaoti' value='{{$biaoti}}'>
<input type="submit" value='搜索'>
</form>
<table class="table">
 
  <thead>
    <tr>
      <th>id</th>
      <th>文章标题</th>
      <th>文章分类</th>
      <th>文章重要性</th>
      <th>是否显示</th>
      <th>添加日期</th>
      <th>操作</th>
      </tr>
  </thead>
  <tbody>
  @foreach($data as $k=>$v)
    <tr>
      <td>{{$v->w_id}}</td>
      <td>{{$v->biaoti}}</td>
      <td>{{$v->fenlei}}</td> 
      <td>{{($v->zhongyaoxing==1?'普通':'顶置')}}</td>
      <td>{{($v->shifou==1?'√':'×')}}</td>
      <td>{{date('Y-m-d H:i:s',$v->time)}}</td> 
      <td>@if($v->img)<img src="{{env('UPLOAD_URL')}}{{$v->img}}" width='50' height='40'>@endif</td> 
      <td>  <a href="javascript:void(0)" onclick="del({{$v->w_id}})">删除</a> |
            <a href="{{url('guanli/edit'.$v->w_id)}}">编辑</a>
      </td> 
    </tr>
    @endforeach
    <tr><td>{{$data->appends(['biaoti' =>$biaoti,'fenlei'=>$fenlei])->links()}}</td></tr>
  </tbody>
</table>
<script>
  function del(id){
  
    if(!id){
      return;
    }

    if(confirm('是否要删除此条记录')){
        $.get(
              '/guanli/destroy'+id,
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