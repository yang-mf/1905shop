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
<form action="{{url('/class/update/'.$date->cate_id)}}" method="post">@csrf
    分类<input type="text" name="cate_name" value="{{$date->cate_name}}">
    <b style="color: red">@php echo $errors->first('cate_name'); @endphp</b><br>
    <select name="parent_id">
        <option value="0">--请选择分类--</option>
        @foreach($data as $v)
            <option value="{{$v->cate_id}}" {{$date->parent_id==$v->cate_id?'select':''}}>{{$v->cate_name}}</option>
        @endforeach
    </select><br>
    <input type="submit" value="添加">
</form>
</body>
</html>