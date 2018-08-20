@include('index.public.top')
<body class="page-action"  id="wraper-bg">

<div id="wraper-bg" class="wraper-bg">
    @include('index.public.head')
    <div class="detail box-content-wraper">
        <div class="box-content">
            <div class="banner">
                <span class="title">{{ $activity['activity_name'] }}</span>
            </div>
            <div class="content">
                <p class="message"><span class="trans">“</span>{{ $activity['activity_name'] }}
                    10月12日上午<span class="trans">”</span></p>
                <form class="pure-form pure-form-aligned" action="/ActivityServlet" method="post">
                    <fieldset>
                        <legend>活动信息</legend>
                        <div class="pure-control-group">
                            <label for="name">详细内容</label>
                            <span class="pure-form-message-inline">{{ $activity['activity_content'] }}</span>
                        </div>

                        <div class="pure-control-group">
                            <label for="name">活动类型</label>
                            <span class="pure-form-message-inline">{{ $activity['activity_type'] }}</span>
                        </div>

                        <div class="pure-control-group">
                            <label for="name">时间安排</label>
                            <span class="pure-form-message-inline">{{ $activity['start_time'] }}</span>
                        </div>

                        <div class="pure-control-group">
                            <label for="name">人数安排</label>
                            <span class="pure-form-message-inline">{{ $activity['number'] }}</span>
                        </div>

                        <div class="pure-control-group">
                            <label for="name">参与者</label>
                            <span class="pure-form-message-inline">{{ $activity['participant'] }}</span>
                        </div>

                        <div class="pure-control-group">
                            <label for="name">地点安排</label>
                            <span class="pure-form-message-inline">{{ $activity['place'] }}</span>
                        </div>
                        <div class="pure-control-group">
                            <label for="name">已报人数</label>
                            <span class="pure-form-message-inline">  {{ countCheenroll($activity['id']) }}</span>
                        </div>

                        <div class="pure-controls">
                            @if( is_cheenroll($activity['id']))
                                <a  disabled  class="pure-button pure-button-">已报名</a>
                            @else
                                @if(session('user'))
                                    @if( countCheenroll($activity['id']) == $activity['number'])
                                        <a  disabled  class="pure-button pure-button-">人数已满</a>
                                    @else
                                        <a href="/user/enroll/{{$activity['id']}}" class="pure-button pure-button-primary">报名</a>

                                    @endif
                                @else
                                    <a href="{{url('login')}}" class="pure-button pure-button-primary">登录后报名</a>
                                @endif
                            @endif


                        </div>
                    </fieldset>
                </form>
            </div>
        </div>
    </div>
</div>
@include('index.public.footer')


</body>
</html>