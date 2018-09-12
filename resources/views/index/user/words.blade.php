
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <title>{{ $title }}</title>
    <link rel="stylesheet" type="text/css" href="{{ asset('/index/css/pure-min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/index/css/grids-responsive-min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{ asset('/index/css/global.css')}}">
    <link rel="stylesheet" href="https://cdn.bootcss.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.bootcss.com/jquery/1.10.2/jquery.min.js"></script>
    <script src="{{asset('/layer/layer.js')}}"></script>
    <script src="{{asset('/ueditor/ueditor.config.js')}}"></script>
    <script src="{{asset('/ueditor/ueditor.all.min.js')}}"></script>
    <script src= "{{asset('/ueditor/lang/zh-cn/zh-cn.js')}}"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<style>
    textarea{ resize:none;}
</style>
<body class="page-words">

<div class="wraper-bg">

    @include('index.public.head')

    <div class="box-content-wraper"  style="padding-bottom:12em">
        <div class="box-content">
            <div class="content" style="padding-bottom: 1em" style=" background-color:rgba(255,0,15,0.2);}">
                <h3> 留言板 </h3>
                <p class="something">您好，您可以给我们社团提供一些建议，非常感谢!</p>
                @if(session('user'))
                <div class="nav pure-menu pure-menu-horizontal"  >
                    <form method="post">
                        <input type="hidden" value="save" name="method" />
                        <textarea rows="5" style="width:99%;border-radius: 1em;outline:none;background-color: rgba(0,0,255,0)" class="current" id="content" name="content"></textarea> <br />
                        <button type="button" onclick="sub()"  class="pure-button pure-button-primary">提交</button>
                    </form>
                </div>
                @else
                <a href="{{url('login')}}" class="pure-button pure-button-primary">登录后留言</a>
                @endif
                <br />
            </div>

            <div class="box-list">

                @foreach($words as $word)
                <div class="item" style=" background-color:rgba(255,225,227,0.2);}">
                    <img class="head-img mt" src="/index/images/user.jpg"  style="border-radius: 50% ;">
                    <div class="flexx"><div class="user-info">
                            <img class="head-img mi" src="/index/images/user.jpg" style="border-radius: 50%">
                            <span class="name">
                                {{ $word->name }}
                            </span>
                            <div class="message">{{ $word->content }}</div>
                            <div class="info"><span class="count">{{ getTime($word->time) }}</span>
                            </div>
                        </div>
                    </div>
                    <?php $info = getReplys($word->id) ?>
                    @foreach($info as $value)
                    <div class="item"  style=" background-color:rgba(255,225,227,0.15);border: 0">
                        <img class="head-img mt" src="/index/images/user.jpg"  style="border-radius: 50% ;">
                        <div class="flexx"><div class="user-info">
                                <img class="head-img mi" src="/index/images/user.jpg" style="border-radius: 50%">
                                <span class="name">
                                     <span style="color:red;font-size: 10px;">管理员</span>{{ $value->name }}
                            </span>
                                <div class="message">{{ $value->centent }}</div>
                                <div class="info"><span class="count">{{ getTime($value->time) }}</span>

                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
               @endforeach

                <div class="item ctrl">
                    {{ $words->links() }}

                </div>
            </div>
        </div>
    </div>
</div>

@include('index.public.footer')
</body>
</html>
<script>
    $(".huifu").click(function () {

    });
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    function sub() {
        var content = $("#content").val();
        if(content == ''){
            layer.msg('请输入点内容');
            return false;
        }
        if(content.length <= 5){
            layer.msg('内容不能低于5个字符');
            return false;
        }
        var url = "{{url('user/words')}}";
        var postData ={"content":content};
        $.post(url,postData,function (result) {
            if(result.error === 1 ){
                layer.alert(result.msg,function () {
                    location.href = "{{ url('words') }}";
                });
            }else {
                layer.msg(result.msg, {
                    icon: 5,
                    skin: 'layer-ext-moon',
                });

            }
        },"json")
    }
</script>