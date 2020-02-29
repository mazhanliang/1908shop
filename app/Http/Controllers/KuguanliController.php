<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 // use DB;
use App\Kuguanli;
use App\Http\Requests\StorePeoplePost;
use Validator;
use Illuminate\Validation\Rule;
class KuguanliController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       
        $admin_name=request()->admin_name;
         
        $pageSize=config('app.pageSize');
        $cate=Kuguanli::orderby('k_id','desc')->paginate($pageSize);
        return view('ku.index',['cate'=>$cate]);
    }
    public function index1()
    {
        return view('ku.aaaa');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          
        return view('ku.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
 

    public function store(request $request)
    {
       // 第一种验证
        // $request->validate([
        //     'admin_name'=>'required|unique:admin',
        //     'admin_pwd'=>'required',
            
        // ],[
        //     'admin_name.required'=>'账号必填',
        //     'admin_name.unique'=>'账号已存在',
        //     'admin_pwd.required'=>'密码必填',
        // ]);
        $data=$request->except('_token');
        $data['k_pwd']=md5(md5($data['k_pwd']));
        
    
       $res=Kuguanli::create($data);
      
        if($res){
            return redirect('/ku/index');
        }
    }
     
    

       
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
      
        $res=Kuguanli::where('k_id',$id)->first();
 
      
        return view('ku.edit',['res'=>$res]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $data=$request->except('_token');
        // $request->validate([
        //     'admin_name'=>[
        //         'required',
        //         Rule::unique('admin')->ignore($id,'admin_id'),
        //     ],
            
            
        // ],[
        //     'admin_name.required'=>'账号必填',
        //     'admin_name.unique'=>'账号已存在',
           
        // ]);
         

        $res=Kuguanli::where('k_id',$id)->update($data);
        if($res!==false){
            return redirect('/ku/index');
        }
    }
   
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   
        $ss=session('admin');
        $res=Kuguanli::where('k_id',$id)->delete();
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'ok']);
        }
    }
}
