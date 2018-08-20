
<body class="page-index">
<div class="wraper-bg">

    <div class="header">
        <div class="home-menu pure-menu pure-menu-horizontal pure-menu-fixed" id="home">

            <a class="logo-set pure-menu-heading" href="/">
                <img class="logo" src="/index/picture/logo.png">
            </a>

            <a class="title-set pure-menu-heading" href="/">
                <span class="big-text">爱心社</span>
                <span class="small-text">Love society</span>
                <span ></span>
                @if(session('user'))
                    <span class="small-text" style="font-size: 14px;">欢迎萌新[ {{session('user.user_name')}} ]</span>
                @endif
            </a>
            <ul class="home-menu-list pure-menu-list">

                <li class="pure-menu-item"><a href="words.jsp" class="pure-menu-link">留言板</a></li>
                @if(session('user'))
                    <li class="pure-menu-item"><a href="{{ url('user/outlogin') }}" class="pure-menu-link">注销</a></li>

                @else
                    <li class="pure-menu-item"><a class="pure-menu-link" href="{{ url('register') }}">注册</a></li>
                    <li class="pure-menu-item"><a class="pure-menu-link" href="{{ url('login') }}">登陆</a></li>
                @endif
            </ul>
        </div>
    </div>
</div>