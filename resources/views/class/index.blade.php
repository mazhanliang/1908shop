<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
<form>
    <input type="text" name='name'  value="{{$name}}" placeholder='请输入学生姓名'>
    <select name="class">
        <option value="">--请选择班级--</option>
        <option value="一班" @if($class=='一班') selected @endif>一班</option>
        <option value="二班" @if($class=='二班') selected @endif>二班</option>
        <option value="三班" @if($class=='三班') selected @endif>三班</option>
    </select>
    
    <input type="submit" value='搜索'>
</form>
    <table border='1'>
        <tr>
            <td>id</td>
            <td>学生姓名</td>
            <td>学生性别</td>
            <td>班级</td>
            <td>成绩</td>
            <td>图片</td>
            <td>操作</td>
        </tr>
        @foreach($data as $k=>$v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->name}}</td>
            <td>{{($v->xingbie==1?'男':'女')}}</td>
            <td>{{$v->class}}</td>
            <td>{{$v->chengji}}</td>
            <td><img src='{{env('UPLOAD_URL')}}{{$v->imgs}}' width='66' height='50'></td>
            <td><a href="{{url('/destroy'.$v->id)}}">删除</a>
                <a href="{{url('/edit'.$v->id)}}">编辑</a></td>
        </tr>
        @endforeach    
    </table>
    {{$data->appends(['name' =>$name,'class'=>$class])->links()}}
</body>
</html>