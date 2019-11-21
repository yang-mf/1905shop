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

        <form action="">
            <input type="text" name="word" value="{{$query['word']??''}}" placeholder="请输入商品名称关键字">
            <input type="submit" value="搜索">
        </form>

        <table class="table">
            <thead>
            <tr>
                <th>品牌ID</th>
                <th>品牌LOGO</th>
                <th>品牌名称</th>
                <th>状态</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($data as $v)
            <tr>
                <td>{{$v->brand_id}}</td>
                <td><img src="{{env('PHOTO_URL')}}{{$v->brand_logo}}" width="70px"  ></td>
                <td>{{$v->brand_name}}</td>
                <td>
                    <a href="{{url('/brand/edit/'.$v->brand_id)}}">修改</a>
                    <a href="{{url('/brand/delete/'.$v->brand_id)}}">删除</a>
                </td>
            </tr>
            @endforeach
            </tbody>
        </table>
        {{$data->appends($query)->links()}}
    </div>
    </body>
</html>
