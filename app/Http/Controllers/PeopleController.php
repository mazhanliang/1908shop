<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
  use DB;
 use App\People;
use App\Http\Requests\StorePeoplePost;
use Validator;
use Illuminate\Support\Facades\Redis;
class Peoplecontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $name=Request()->name??'';
        $where=[];
        if($name){
            $where[]=['name','like',"%$name%"];
        }
        $page=request()->page??1;
       // $data=cache('data_'.$page.'_'.$name);
        $data=Redis::get('data_'.$page.'_'.$name);
        //dump($data);
        if(!$data){
             
            $pageSize=config('app.pageSize');
            $data=People::where($where)->orderby('id','desc')->paginate($pageSize);
           // cache(['data_'.$page.'_'.$name=>$data],60*5);
           $data=serialize($data);
           Redis::setex('data_'.$page.'_'.$name,20,$data);
        }
        $data=unserialize($data);
        //$data=DB::table('people')->get();
       if(request()->ajax()){
            return view('peop.ajaxPage',['data'=>$data,'name'=>$name]);
       }

        return view('peop.index',['data'=>$data,'name'=>$name]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('peop.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(request $request)
    {
        //第一种验证
        // $request->validate([
        // 'name' => 'required|unique:people|max:12|min:2',
        // 'age' => 'required|integer|min:1|max:999',
        // ],[ 
        //     'name.required'=>'名字不能为空',
        //     'name.unique'=>'名字已存在',
        //     'name.max'=>'名字长度不能超过12位',
        //     'name.min'=>'名字长度不能小于2位',
        //     'age.required'=>'年龄不能为空',
        //     'age.integer'=>'年龄必须为数字',
        //     'age.max'=>'年龄长度不能超过3位',
        //     'age.min'=>'名字长度不能小于1位',
        // ]);


        $data=$request->except('_token');

        $validator = Validator::make($data,
        [
           
             'name' => 'required|unique:people|max:12|min:2',
             'age' => 'required|integer|between:1,130',
        ],[
                'name.required'=>'名字不能为空',
                'name.unique'=>'名字已存在',
                'name.max'=>'名字长度不能超过12位',
                'name.min'=>'名字长度不能小于2位',
                'age.required'=>'年龄不能为空',
                'age.integer'=>'年龄必须为数字',
                'age.between'=>'年龄数据不合法',  
            ]);
        
        if ($validator->fails()) {
            return redirect('people/create')
            ->withErrors($validator)
            ->withInput();
            }

        $data['add_time']=time();
        if($request->hasFile('img')){
            $data['img']=$this->upload('img');    
        }
        //$res=DB::table('people')->insert($data);
       $res=People::create($data);
      
        if($res){
            return redirect('/people/index');
        }
    }
    //上传文件
    public function upload($filename){
        //判断上传过程是否有错误
        if(request()->file($filename)->isvalid()){
            //接受值
            $photo = request()->file($filename);
            //上传
            $store_result=$photo->store('uploads');
            return $store_result;
        }
        exit('上传文件出现错误或没有上传文件');
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
        $res=People::where('id',$id)->first();
        return view('peop.edit',['res'=>$res]);
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
         if($request->hasFile('img')){
            $data['img']=$this->upload('img');    
        }
     
        $res=DB::table('people')->where('id',$id)->update($data);
        if($res!==false){
            return redirect('/people/index');
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
        $res=DB::table('people')->where('id',$id)->delete();
        if($res){
            return redirect('/people/index');
        }
    }
}
