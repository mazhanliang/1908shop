<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{url('/store')}}" method='post' enctype='multipart/form-data'>
    @csrf
        <table>
            <tr>
                <td>学生姓名</td>
                <td><input type="text" name='name'>
                <b style='color:red'>{{$errors->first('name')}}</b></td>
            </tr>
            <tr>
                <td>学生性别</td>
                <td><input type="radio" name='xingbie' value='1'>男
                    <input type="radio" name='xingbie' value='2'>女
                    <b style='color:red'>{{$errors->first('xingbie')}}</b>
                </td>
            </tr>
             
            <tr>
                <td>班级</td>
                <td>
                <select name="class">
                    <option value="">-请选择班级-</option>
                    <option value="一班">一班</option>
                    <option value="二班">二班</option>
                    <option value="三班">三班</option>
                </select></td>
            </tr>
            <tr>
                <td>成绩</td>
                <td><input type="text" name='chengji'>
                <b style='color:red'>{{$errors->first('chengji')}}</b></td>
            </tr>
            <tr>
                <td>图片</td>
                <td><input type="file" name='imgs'></td>
            </tr>
            <tr>
                <td><input type="submit" value='添加'></td>
                <td></td>
            </tr>
        </table>
    </form>
</body>
</html>