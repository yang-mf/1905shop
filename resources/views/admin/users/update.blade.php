<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>

<form action="{{url('/users/update/'.$data->user_id)}}" method="post">
    @csrf
    用户名：<input type="text" placeholder="请输入用户名" name="name" value="{{$data->name}}">
    <b style="color: red">@php echo $errors->first('name'); @endphp</b><br>

    密码：<input type="text" placeholder="请输入密码" name="pwd" value="{{$data->pwd}}">
    <b style="color: red">@php echo $errors->first('pwd'); @endphp</b>
    <br>
    <input type="submit" value="修改">
</form>
</body>
</html>