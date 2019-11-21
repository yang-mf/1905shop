<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>
    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
    <link rel="stylesheet" href="/static/admin/css/bootstrap.min.css">
    <!-- Styles -->
</head>
<body>
<div class="table-responsive">

    {{--<form action="">--}}
        {{--<input type="text" name="word" value="{{$query['word']??''}}" placeholder="请输入商品名称关键字">--}}
        {{--<input type="submit" value="搜索">--}}
    {{--</form>--}}
    <a href="{{url('users/create')}}">添加页</a>

    <table class="table">
        <thead>
        <tr>
            <th>用户ID</th>
            <th>用户名</th>
            <th>密码</th>
            <th>状态</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($data as $v)
            <tr>
                <td>{{$v->user_id}}</td>
                <td>{{$v->name}}</td>
                <td>{{$v->pwd}}</td>
                <td>
                    <a href="{{url('/users/edit/'.$v->user_id)}}">修改</a>
                    <a href="{{url('/users/delete/'.$v->user_id)}}">删除</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{--{{$data->appends($query)->links()}}--}}
</div>
</body>
</html>
