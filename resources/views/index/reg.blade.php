@extends('layouts.add')
@section('title', '注册')
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>会员注册</h1>
      </div>
     </header>
     <div class="head-top">
      <img src="/static/index/images/head.jpg" />
     </div><!--head-top/-->
     <form action="{{url('/reg_do')}}" method="post" class="reg-login">
     @csrf
      <h3>已经有账号了？点此<a class="orange" href="{{url('/login')}}">登陆</a></h3>
      <div class="lrBox">
          @csrf
       <div class="lrList">
           <b style="color:red">{{$errors->first('u_tel')}}{{session('u_tel')}}</b>
           <input type="text" name="u_tel" class="account" placeholder="输入手机号码" />
       </div>
       <div class="lrList2">
           <b style="color:red">{{$errors->first('u_code')}}{{session('mag')}}</b>
           <div class="sms"><input type="text" name='u_code' placeholder="输入短信验证码" /> <button type="button">获取验证码</button></div>

       </div>
       <div class="lrList">
           <b style="color:red">{{session('msg')}}{{$errors->first('u_pwd')}}</b>
           <input type="password" name="u_pwd" class="pwd" placeholder="设置新密码（6-8位数字或字母）" />
       </div>
       <div class="lrList">
           <b style="color:red">{{session('msg')}}{{$errors->first('u_pwd2')}}</b>
           <input type="password" name="u_pwd2" class="pwds" placeholder="再次输入密码" />
       </div>
      </div><!--lrBox/-->
      <div class="lrSub">
       <input type="submit" value="立即注册" />
      </div>
     </form><!--reg-login/-->
     @endsection
     <script src="/static/js/jquery.min.js"></script>

    <script>
   
        //有验证码获取
        $(document).on('click','button',function(){
             
            var u_tel= $('input[name=u_tel]').val();
        
    
            if (u_tel==''){
            return  $('input[name=u_tel]').prev().text('账号必填');
            }
            var reg=/^\d{11}$/
            if(!reg.test(u_tel)){
                return  $('input[name=u_tel]').prev().text('账号是手机号');
            }

            $.ajax({
                type:'get',
                url:'/send',
                data:{u_tel:u_tel},
                dataType:'json',
                async:false,
                success:function(res){
    //                 return console.log(res)
                    alert(res.msg)
                }
            });
        })
    //账号验证
            
    </script>`