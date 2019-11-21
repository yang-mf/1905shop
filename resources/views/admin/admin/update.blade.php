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

    <form action="{{url('/brand/update/'.$date->brand_id)}}" method="post" class="form-horizontal" role="form" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="firstname" class="col-sm-2 control-label">品牌</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" name="brand_name" placeholder="请输入品牌名称" value="{{$date->brand_name}}">
                <b style="color: red">@php echo $errors->first('brand_name'); @endphp</b>
            </div>
        </div>

        <div class="form-group">
            <label for="lastname" class="col-sm-2 control-label">LOGO</label>
            <div class="col-sm-10">
                <img src=" " width="50">
                <input type="file" name="brand_logo">
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-default">修改</button>
            </div>
        </div>
    </form>
    </body>
</html>
