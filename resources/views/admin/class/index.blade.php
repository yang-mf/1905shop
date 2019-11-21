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
    <a href="{{url('class/create')}}">添加页面</a>
    <table class="table">
        <thead>
        <tr>
            <td>分类id</td>
            <td>分类名称</td>
            <td>父ID</td>
            <td>状态</td>
        </tr>
        </thead>
        <tbody>
        @foreach($data as $v)
            <tr>
                <td>{{$v->cate_id}}</td>
                <td>{{$v->cate_name}}</td>
                <td>{{$v->parent_id}}</td>
                <td>
                    <a href="{{url('/class/edit/'.$v->cate_id)}}">修改</a>
                    <a href="{{url('/class/delete/'.$v->cate_id)}}">删除</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
    {{$data->links()}}
</div>
</body>
</html>