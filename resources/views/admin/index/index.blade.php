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
<form action="">
    <input type="text" name="word" value="{{$query['word']??''}}" placeholder="请输入商品名称关键字">
    <input type="submit" value="搜索">
</form>
<a href="{{url('index/create')}}">添加页</a>
<table border="1">
    <tr>
        <td>商品Id</td>
        <td>商品名称</td>
        <td>商品库存</td>
        <td>商品价格</td>
        <td>商品简介</td>
        <td>商品图片</td>
        <td>所属分类</td>
        <td>所属品牌</td>
        <td>状态</td>
    </tr>
    @foreach($data as $v)
    <tr>
        <td>{{$v->goods_id}}</td>
        <td>{{$v->goods_name}}</td>
        <td>{{$v->goods_num}}</td>
        <td>{{$v->goods_price}}</td>
        <td>{{$v->goods_desc}}</td>
        <td><img src="{{env('PHOTO_URL')}}{{$v->goods_img}}" width="80"></td>
        <td>{{$v->cate_name}}</td>
        <td>{{$v->brand_name}}</td>
        <td>
            <a href="{{url('/index/delete/'.$v->goods_id)}}">删除</a>||
            <a href="{{url('/index/edit/'.$v->goods_id)}}">修改</a>
        </td>
    </tr>
        @endforeach
</table>
{{$data->appends($query)->links()}}
</body>
</html>