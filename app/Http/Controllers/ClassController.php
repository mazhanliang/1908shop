<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Illuminate\Validation\Rule;
class Classcontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name=Request()->name??'';
        $class=Request()->class??'';
        $where=[];
        if($name){
            $where[]=['name','like',"%$name%"];
        }
        if($class){
            $where[]=['class','like',"%$class%"];
        }
        $pageSize=config('app.pageSize');
        $data=DB::table('class')->where($where)->paginate($pageSize);
        return view('class/index',['data'=>$data,'name'=>$name,'class'=>$class]);
        // $data=DB::table('people')->get();
        // return view('peop.index',['data'=>$data]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('class.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'=>'required|unique:class|regex:/^[\x{4e00}-\x{9fa5}[A-Za-z0-9_-]{2,12}$/u',
            'xingbie'=>'required|numeric|between:1,2',
            'chengji'=>'required|numeric|between:0,100',
        ],[
            'name.required'=>'学生姓名不能为空',
            'name.unique'=>'学生姓名已存在',
            'name.regex'=>'学生姓名为中文 数字 字母 下划线 为2-12位',
            'xingbie.required'=>'性别必填',
            'xingbie.numeric'=>'性别数据是数字',
            'xingbie.between'=>'性别数据出现错误',
            'chengji.required'=>'学生成绩不能为空',
            'chengji.between'=>'学生成绩出现错误',
            'chengji.numeric'=>'学生成绩必须为数字',
             
        ]);
        $data=$request->except('_token');
        if($request->hasFile('imgs')){
            $data['imgs']=upload('imgs');    
        }
        $res=DB::table('class')->insert($data);
        if($res){
            return redirect('/index');
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
        $res=DB::table('class')->where('id',$id)->first();
        return view('class.edit',['res'=>$res]);
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
        $request->validate([
            'name' => [
                'required',
                'regex:/^[\x{4e00}-\x{9fa5}[A-Za-z0-9_-]{2,12}$/u',
                Rule::unique('class')->ignore($id),
              
               
            ],
            // 'name'=>'required|unique:class|alpha_dash|between:2,3',
            'xingbie'=>'required|numeric|between:1,2',
            'chengji'=>'required|numeric|between:0,100',
        ],[
            'name.required'=>'学生姓名不能为空',
            'name.unique'=>'学生姓名已存在',
            'name.regex'=>'学生姓名为中文 数字 字母 下划线 为2-12位',
            'xingbie.required'=>'性别必填',
            'xingbie.numeric'=>'性别数据是数字',
            'xingbie.between'=>'性别数据出现错误',
            'chengji.required'=>'学生成绩不能为空',
            'chengji.between'=>'学生成绩出现错误',
            'chengji.numeric'=>'学生成绩必须为数字',
             
        ]);
         $data=$request->except('_token');
         if($request->hasFile('imgs')){
            $data['imgs']=upload('imgs');    
        }
       
        $res=DB::table('class')->where('id',$id)->update($data);
        if($res!==false){
            return redirect('/index');
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
        $res=DB::table('class')->where('id',$id)->delete();
        if($res){
            return redirect('/index');
        }
    }
}
