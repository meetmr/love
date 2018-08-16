<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/index/css/pure-min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/index/css/grids-responsive-min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/index/css/global.css')}}">
    <script src="https://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <script src="{{asset('/layer/layer.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body class="page-index">

<div class="wraper-bg">

    <div class="header">
        <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed">

            <a class="logo-set pure-menu-heading" href="/">
                <img class="logo" src="/index/picture/logo.png">
            </a>

            <a class="title-set pure-menu-heading" href="/">
                <span class="big-text">爱心社</span>
                <span class="small-text">Love society</span>
                <span ></span>
                @if(session('user'))
                    <span class="small-text">欢迎萌新{{session('user.user_name')}}登陆</span>
                @endif
            </a>
            <ul class="home-menu-list pure-menu-list">

                <li class="pure-menu-item"><a href="words.jsp" class="pure-menu-link">留言板</a></li>
                @if(session('user'))

                @else
                    <li class="pure-menu-item"><a class="pure-menu-link" href="{{ url('register') }}">注册</a></li>
                    <li class="pure-menu-item"><a class="pure-menu-link" href="{{ url('login') }}">登陆</a></li>
                @endif
            </ul>
        </div>
    </div>
