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

{{--@if ($errors->any())--}}
{{--<div class="alert alert-danger">--}}
{{--<ul>--}}
{{--@foreach ($errors->all() as $error)--}}
{{--<li>{{ $error }}</li>--}}
{{--@endforeach--}}
{{--</ul>--}}
{{--</div>--}}
{{--@endif--}}

<form action="{{url('/index/update/'.$info->goods_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">商品名称</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="goods_name" placeholder="请输入商品名称" value="{{$info->goods_name}}">
            <b style="color: red">@php echo $errors->first('goods_name'); @endphp</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品价格</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="goods_price" placeholder="请输入商品价格" value="{{$info->goods_price}}">
            <b style="color: red">@php echo $errors->first('goods_price'); @endphp</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品库存</label>
        <div class="col-sm-10">
            <input type="text" class="form-control" name="goods_num" placeholder="请输入商品价格" value="{{$info->goods_num}}">
            <b style="color: red">@php echo $errors->first('goods_num'); @endphp</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品简介</label>
        <div class="col-sm-10">
            <textarea name="goods_desc" cols="30" rows="10" placeholder="请输入商品详情">{{$info->goods_desc}}</textarea>
            <b style="color: red">@php echo $errors->first('goods_desc'); @endphp</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品分类</label>
        <div class="col-sm-10">
            <select name="cate_id">
                <option value="0">--请选择分类--</option>
                @foreach($data as $v)
                    <option value="{{$v->cate_id}}">{{$v->cate_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品品牌</label>
        <div class="col-sm-10">
            <select name="brand_id">
                <option value="0">--请选择品牌--</option>
                @foreach($date as $v)
                    <option value="{{$v->brand_id}}">{{$v->brand_name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">商品图标</label>
        <div class="col-sm-10">
            <input type="file" name="goods_img">
        </div>
    </div>
    {{--<div class="form-group">--}}
    {{--<label for="lastname" class="col-sm-2 control-label">商品图集</label>--}}
    {{--<div class="col-sm-10">--}}
    {{--<input type="file" name="goods_files">--}}
    {{--</div>--}}
    {{--</div>--}}
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-default">修改</button>
        </div>
    </div>
</form>
</body>
</html>
