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
<center><H1>文章管理</H1></center>
<!-- @if($errors->any())
<div class='alert alert-danger'>
<ul>
@foreach($errors->all() as $error)
<li>{{$error}}</li>
@endforeach
</ul>
</div>
@endif -->
<form  action="{{url('/guanli/store')}}" method='post' class="form-horizontal" role="form" enctype="multipart/form-data">

@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章标题</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name='biaoti' id="firstname">
				   <b style='color:red'>{{$errors->first('biaoti')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章分类</label>
		<div class="col-sm-8">
			 <select name="fenlei" id="">
                 <option value="">请选择...</option>
                <option value="手机促销">手机促销</option>
                <option value="3G咨询">3G咨询</option>
                <option value="站内快讯">站内快讯</option>
                <option value="站外快讯">站外快讯</option>
             </select>
			 <b style='color:red'>{{$errors->first('fenlei')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章重要性</label>
        <div class="col-sm-8">
            <input type="radio" name="zhongyaoxing"   value="1" >普通
            <input type="radio" name="zhongyaoxing"   value="2">顶置
			<b style='color:red'>{{$errors->first('zhongyaoxing')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">是否显示</label>
        <div class="col-sm-8">
            <input type="radio" name="shifou"   value="1" >是
            <input type="radio" name="shifou"   value="2">否
			<b style='color:red'>{{$errors->first('shifou')}}</b>
		</div>
	</div>

	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章作者</label>
        <div class="col-sm-8">
		 <input type="text" class="form-control" id="firstname"  name='name'>
		 <b style='color:red'>{{$errors->first('name')}}</b>
        </div>
    </div>
        <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label"> 作者email</label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name='email' id="firstname">
				  
		</div>
	</div>

     <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">关键字 </label>
		<div class="col-sm-8">
			<input type="text" class="form-control" name='guanjianzi' id="firstname" 
				    >
		</div>
	</div>

     <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">网页描述</label>
		<div class="col-sm-8">
			 <textarea name="miaoshu" id="" cols="20" rows="10"></textarea>
				  
		</div>
	</div>   

    </div>
        <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">上传文件</label>
		<div class="col-sm-8">
			<input type="file" class="form-control" name='img' >
		</div>
	    </div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-8">
			<input type="button" value='添加'>
		</div>
	</div>
</form>

</body>
</html>
<script>
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
			data:{biaoti:biaoti},
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
			data:{biaoti:biaoti},
			dataType:'json',
			success:function(result){
				if(result.count>0){
					$('input[name="biaoti"]').next().html('标题已存在');
				}
				
			}
		})
	})
</script>