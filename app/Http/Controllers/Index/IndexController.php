<?php

namespace App\Http\Controllers\Index;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cookie;
use App\Users;
use App\Goods;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Redis;

class IndexController extends Controller
{
  

    public function index(){
            echo 123123;
        //$data=cache('data'.'goods_id');
        $data=Redis::get('data'.'goods_id');
 
        if(!$data){
            $data=Goods::get();
            //cache(['data'.'goods_id'=>$data],60*60*24*30);
            $data=serialize($data);
            Redis::setex('data'.'goods_id',60,$data);
        }
        $data=unserialize($data);
        return view('index.index',['data'=>$data]);
    }
 

  
 //列表展示
 public function list(){
    //$data=cache('data'.'goods_id');
    $data=Redis::get('data'.'goods_id');
    if(!$data){
        $data=Goods::get();
        //cache(['data'.'goods_id'=>$data],60*60*24*30);
        $data=serialize($data);
        Redis::setex('data'.'goods_id',60,$data);
    }
    $data=unserialize($data);
     return view('index.prolist',['data'=>$data]);
}
//列表详情
public function proinfo($id){
    //$data=cache('data'.$id);
  $num=Redis::setnx('num_'.$id,1);
  if(!$num){
    $num=Redis::incr('num_'.$id);
 }
    $data=Redis::get('data'.$id,$num);
    dump($data);
    if(!$data){
        $data=Goods::where('goods_id',$id)->first();
        //cache(['data'.$id=>$data],60*60*24*30);
        $data=serialize($data);
        Redis::setex('data'.$id,60,$data);
    }
    $data=unserialize($data);
     return view('index.proinfo',['data'=>$data,'num'=>$num]);
}

//购物车
public function car($id){
    $data=Goods::where('goods_id',$id)->first();
    return view('index.car',['data'=>$data]);
}
public function pay(){
    return view('index.pay');
}
public function address(){
    return view('index.address');
}
public function success(){
    return view('index.success');
}



    // public function ajaxsend(){
    //     $moblie='15297645616';
    //     $code=rand(1000,9999);
    //     $res=$this->sendSms($moblie,$code);
    //     if($res['Code']=='OK'){
    //         session(['code'=>$code]);
    //         request()->session()->save();

    //         echo '发送成功';
    //     }
    // }
    


   


}
