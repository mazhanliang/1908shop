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
<center><H1>文章管理编辑</H1></center>
<!-- @if($errors->any())
<div class='alert alert-danger'>
<ul>
@foreach($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul>
</div>
@endif -->
<form  action="{{url('/guanli/update'.$res->w_id)}}" method='post' class="form-horizontal" role="form" enctype="multipart/form-data">

@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章标题</label>
		<div class="col-sm-8">
		<input type="text" class="form-control" name='biaoti' value='{{$res->biaoti}}' id="firstname">
				   <b style='color:red'>{{$errors->first('biaoti')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章分类</label>
		<div class="col-sm-8">
			 <select name="fenlei" id="">
                 <option value="">请选择...</option>
                <option value="手机促销" @if($res->fenlei=='手机促销') selected @endif>手机促销</option>
                <option value="3G咨询" @if($res->fenlei=='3G咨询') selected @endif>3G咨询</option>
                <option value="站内快讯" @if($res->fenlei=='站内快讯') selected @endif>站内快讯</option>
                <option value="站外快讯" @if($res->fenlei=='站外快讯') selected @endif>站外快讯</option>
             </select>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章重要性</label>
        <div class="col-sm-8">
            <input type="radio" name="zhongyaoxing"   value="1" @if($res->zhongyaoxing==1) checked @endif>普通
            <input type="radio" name="zhongyaoxing"   value="2" @if($res->zhongyaoxing==2) checked @endif>顶置
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否显示</label>
        <div class="col-sm-8">
            <input type="radio" name="shifou"   value="1" @if($res->zhongyaoxing==1) checked @endif>是
            <input type="radio" name="shifou"   value="2" @if($res->zhongyaoxing==2) checked @endif>否
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章作者</label>
        <div class="col-sm-8">
		 <input type="text" class="form-control" id="firstname"  value='{{$res->name}}' name='name'>
        </div>
    </div>
        <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label"> 作者email</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name='email' value='{{$res->email}}' id="firstname" 
				   >
		</div>
	</div>

     <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">关键字 </label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name='guanjianzi' value='{{$res->guanjianzi}}' id="firstname" 
				    >
		</div>
	</div>

     <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">网页描述</label>
		<div class="col-sm-8">
			 <textarea name="miaoshu" id="" cols="20" rows="10">{{$res->miaoshu}}</textarea>
				  
		</div>
	</div>   

    </div>
        <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">上传文件</label>

		<div class="col-sm-8">
		<img src="{{env('UPLOAD_URL')}}{{$res->img}}" width='50' height='40'>
			<input type="file" class="form-control" name='img' >
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
<script>
	var id={{$res->w_id}};
	$('input[type="button"]').click(function(){
		var titleflag=true;
		$('input[name="biaoti"]').next().html('');
		 var biaoti=$('input[name="biaoti"]').val();
		var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
		if(!reg.test(biaoti)){
			$('input[name="biaoti"]').next().html('标题由 中文 字母 数字 下划线组成 不能为空');
			return;
		}

		//验证唯一性
		$.ajax({
			type:'get',
			url:'/guanli/weiyi',
			data:{biaoti:biaoti,id:id},
			dataType:'json',
			success:function(result){
				if(result.count>0){
					$('input[name="biaoti"]').next().html('标题已存在');
					titleflag=false;
				}
				
			}
		})
		if(!titleflag){
			return;
		}

		$('input[name="name"]').next().html('');
		 var name=$('input[name="name"]').val();
		 var reg=/^[\u4e00-\u9fa50-9A-Za-z_]{2,8}$/;
		 if(!reg.test(name)){
			$('input[name="name"]').next().html('文章作者 由中文 字母 数字 下划线组成 有2-8位')
			 return;
		 }
		 $('form').submit();

	})

	$('input[name="name"]').blur(function(){
		$(this).next().html('');
		 var name=$(this).val();
		 var reg=/^[\u4e00-\u9fa50-9A-Za-z_]{2,8}$/;
		 if(!reg.test(name)){
			 $(this).next().html('文章作者 由中文 字母 数字 下划线组成 有2-8位')
			 return;
		 }
	})

	$('input[name="biaoti"]').blur(function(){
		$(this).next().html('');
		 var biaoti=$(this).val();
		var reg=/^[\u4e00-\u9fa50-9A-Za-z_]+$/;
		if(!reg.test(biaoti)){
			$(this).next().html('标题由 中文 字母 数字 下划线组成 不能为空');
			return;
		}

		//验证唯一性
		$.ajax({
			type:'get',
			url:'/guanli/weiyi',
			data:{biaoti:biaoti,id:id},
			dataType:'json',
			success:function(result){
				if(result.count>0){
					$('input[name="biaoti"]').next().html('标题已存在');
				}
				
			}
		})
	})
</script>