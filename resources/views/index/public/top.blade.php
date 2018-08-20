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