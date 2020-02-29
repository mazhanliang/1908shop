<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Kuguanli;
class LoginController extends Controller
{
    public function logindo(Request $Request){
        $user= $Request->except('_token');
        $user['k_pwd']=md5(md5($user['k_pwd']));
        $admin=Kuguanli::where($user)->first();
        if($admin){
            session(['admin'=>$admin]);
            $Request->session()->save();
            return  redirect('ku/index1');
        }
        return redirect('/login1')->with('msg','没有此用户');
    }
}
