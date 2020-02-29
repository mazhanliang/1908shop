<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <table border='1'>
        <tr>
            <td>品牌名称</td>
            <td>品牌LOGO</td>
            <td>品牌网址</td>
            <td>品牌描述</td>
            <td>操作</td>
        </tr>
        @foreach($data as $k=>$v)
        <tr>
            <td>{{$v->id}}</td>
            <td>{{$v->name}}</td>
            <td><img src='{{env('UPLOAD_URL')}}{{$v->logo}}' width='66' height='50'></td>
            <td>{{$v->wangzhi}}</td>
            <td><a href="{{url('pinpai/destroy'.$v->id)}}">删除</a>
                <a href="{{url('pinpai/edit'.$v->id)}}">编辑</a></td>
        </tr>
        @endforeach
    </table>
</body>
</html>