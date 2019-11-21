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
<form action="{{url('/class/store')}}" method="post">@csrf
    分类<input type="text" name="cate_name">
    <b style="color: red">@php echo $errors->first('cate_name'); @endphp</b><br>
    <select name="parent_id">
        <option value="0">--请选择分类--</option>
        @foreach($data as $v)
            <option value="{{$v->cate_id}}">@php echo str_repeat('&nbsp;&nbsp;',$v['level']*3)@endphp {{$v['cate_name']}}</option>
            {{--<option value="{{$v['child']->cate_id}}">{{ $v['child']->cate_name}}</option>--}}
        @endforeach
    </select><br>
    <input type="submit" value="添加">
</form>
</body>
</html>