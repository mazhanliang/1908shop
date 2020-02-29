<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('pinpai/store')}}" method='post' enctype='multipart/form-data'>
    @csrf
        <table>
            <tr>
                <td>品牌名称</td>
                <td><input type="text" name='name'></td>
            </tr>
            <tr>
                <td>品牌网址</td>
                <td><input type="text" name='wangzhi'></td>
            </tr>
             
            <tr>
                <td>品牌描述</td>
                <td><textarea name="text"   cols="22" rows="5"></textarea></td>
            </tr>
            <tr>
                <td>品牌LOGO</td>
                <td><input type="file" name='logo'></td>
            </tr>
            <tr>
                <td><input type="submit" value='添加'></td>
                <td></td>
            </tr>
        </table>
    </form>
</body>
</html>