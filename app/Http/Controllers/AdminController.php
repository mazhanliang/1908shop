<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 // use DB;
use App\Admin;
use App\Http\Requests\StorePeoplePost;
use Validator;
use Illuminate\Validation\Rule;
class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin_name=request()->admin_name;
        $where=[];
        if($admin_name){
            $where[]=['admin_name','like',"%$admin_name%"];
        }
        $pageSize=config('app.pageSize');
        $cate=Admin::where($where)->orderby('admin_id','desc')->paginate($pageSize);
        return view('admin.index',['cate'=>$cate,'admin_name'=>$admin_name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
         
        
        return view('admin.create');
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
        $request->validate([
            'admin_name'=>'required|unique:admin',
            'admin_pwd'=>'required',
            
        ],[
            'admin_name.required'=>'账号必填',
            'admin_name.unique'=>'账号已存在',
            'admin_pwd.required'=>'密码必填',
        ]);
        $data=$request->except('_token');
        $data['admin_pwd']=md5(md5($data['admin_pwd']));
        if($request->hasFile('admin_img')){
            $data['admin_img']=upload('admin_img');    
        }
    
       $res=Admin::create($data);
      
        if($res){
            return redirect('/admin/index');
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
      
        $res=Admin::where('admin_id',$id)->first();
 
      
        return view('admin.edit',['res'=>$res]);
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
        $request->validate([
            'admin_name'=>[
                'required',
                Rule::unique('admin')->ignore($id,'admin_id'),
            ],
            
            
        ],[
            'admin_name.required'=>'账号必填',
            'admin_name.unique'=>'账号已存在',
           
        ]);
        if($request->hasFile('admin_img')){
            $data['admin_img']=upload('admin_img');    
        }

        $res=Admin::where('admin_id',$id)->update($data);
        if($res!==false){
            return redirect('/admin/index');
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
        $res=Admin::where('admin_id',$id)->delete();
        if($res){
            echo json_encode(['code'=>'00000','msg'=>'ok']);
        }
    }
}
