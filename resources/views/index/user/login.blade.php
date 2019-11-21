@extends('layouts.app')
@section('title', '登录')
@section('content')
<div class="maincont">
    <header>
        <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
        <div class="head-mid">
            <h1>会员注册</h1>
        </div>
    </header>
    <div class="head-top">
        <img src={{asset('/static/index/images/head.jpg')}} />
    </div><!--head-top/-->
    <form action="{{url('logindo')}}" method="get" class="reg-login">
        <h3>还没有三级分销账号？点此<a class="orange" href="{{url('/reg')}}">注册</a></h3>
        <div class="lrBox">
            <div class="lrList"><input type="text" name="email" placeholder="输入手机号码或者邮箱号" /></div>
            <div class="lrList"><input type="text" name="pwd" placeholder="输入证码" /></div>
        </div><!--lrBox/-->
        <div class="lrSub">
            <input type="submit" value="立即登录" />
        </div>
    </form><!--reg-login/-->
    <div class="height1"></div>
    @include('index.public.footer');
</div><!--maincont-->
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src={{asset('/static/index/js/jquery.min.js')}}></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src={{asset('/static/index/js/bootstrap.min.js')}}></script>
<script src={{asset('/static/index/js/style.js')}}></script>
@endsection
