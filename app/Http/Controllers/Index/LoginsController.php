<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Users;
use App\Goods;
use Illuminate\Support\Facades\Validator;

use AlibabaCloud\Client\AlibabaCloud;
use AlibabaCloud\Client\Exception\ClientException;
use AlibabaCloud\Client\Exception\ServerException;

//邮箱
use App\Mail\SendCode;
use Illuminate\Support\Facades\Mail;
class LoginsController extends Controller
{

    function sendemail(){
        //发送邮件
        $email='2652592612@qq.com';
        Mail::to($email)->send(new SendCode());
    }

    public function reg(){
        return view('index.reg');
    }

      /**点击获取验证码*/
      public function ajaxsend(){
        $u_tel = request()->u_tel;
       $code=rand(1000,9999);
       $res=$this->sendSms($u_tel,$code);
       if($res['Code']=='OK'){
           session(['code'=>$code,'u_tel'=>$u_tel,'add_time'=>time()]);
           request()->session()->save();
           echo json_encode(['code'=>'1','msg'=>'ok']);die;
       }
       echo json_encode(['code'=>'2','msg'=>'短信发送失败']);die;
    }

    public function reg_do(){

        $data=request()->except('_token','u_pwd2');
           
        //  //获取session中的账号验证码
        
        //  //验证账号
        //          if($data['u_tel']!=session(['u_tel'])){
        //              return redirect('/reg')->with('u_tel','账号有误！');
        //          }
        //  //验证码验证
        //          if($data['u_code']!=session(['code'])){
        //              return redirect('/reg')->with('mag','验证码有误！');
        //          }
        //  //验证时间
        //          if((time()-session(['time']))>60*2){
        //              return redirect('/reg')->with('mag','验证码已超时2分钟内有效！');
        //          }
        //  //验证密码
        //        if($data['u_pwd']!==$data['u_pwd2']){
        //               return redirect('/reg')->with('msg','两次密码不一致');
        //        }
        //  unset($data['u_pwd2']);
        //  unset($data['u_code']);
        // $data['u_pwd']=md5(md5['u_pwd']);
         $data['add_time']=time();
        
         $res=Users::create($data);
         if($res){
             return redirect('/login')->with('success','注册成功请登录吧！');
         }
         return redirect('/reg')->with('error','注册失败请重试');
     }
        
        
    

    public function logindo(){
        $data=request()->except('_token');
        $admin=Users::where($data)->first();
        if($admin){
            return redirect('/');
        }
    }


    

    


    function sendSms($u_tel,$code){

        AlibabaCloud::accessKeyClient('LTAI4FvMaWpg24zs59a7WNWZ','DFhJARhWYDHs7kAFZLESOUj4KPmTIF')
                                ->regionId('cn-hangzhou')
                                ->asDefaultClient();
    
        try {
            $result = AlibabaCloud::rpc()
                                  ->product('Dysmsapi')
                                  // ->scheme('https') // https | http
                                  ->version('2017-05-25')
                                  ->action('SendSms')
                                  ->method('POST')
                                  ->host('dysmsapi.aliyuncs.com')
                                  ->options([
                                                'query' => [
                                                  'RegionId' => "cn-hangzhou",
                                                  'PhoneNumbers' => $u_tel,
                                                  'SignName' => "幸运的马良",
                                                  'TemplateCode' => "SMS_184105154",
                                                  'TemplateParam' => "{code:$code}",
                                                ],
                                            ])
                                  ->request();
            return $result->toArray();
        } catch (ClientException $e) {
            return $e->getErrorMessage();
        } catch (ServerException $e) {
            return $e->getErrorMessage();
        }
    }
}
