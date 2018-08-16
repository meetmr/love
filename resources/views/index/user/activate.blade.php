
@include('index.public.head')

    <div class="login-panel">
        <div class="login pure-g">
            <div class="box login pure-u-1 pure-u-md-13-24" style="margin: 0 auto">
                <form class="pure-form pure-form-stacked" >
                    <input type="hidden" name="method" value="login" />
                    <fieldset>
                        <legend>填写个人信息</legend>
                        <label for="school_number">学号</label>
                        <input class="pure-input-1"  disabled value="{{ $userInfo['school_number'] }}"  type="text">
                        <label for="department">系部</label>
                        <input class="pure-input-1" name="department" id="department" type="text" value="">
                        <label for="class">班级</label>
                        <input class="pure-input-1" name="class" id="class" type="text" value="">
                        <label for="user_name">姓名</label>
                        <input class="pure-input-1" name="user_name" id="user_name" type="text" value="">
                        <input class="pure-input-1" name="user_id" id="user_id" type="hidden" value="{{ $userInfo['id'] }}">
                    </fieldset>
                    <fieldset>
                        <button type="button" onclick="activate()" class="pure-button pure-input-1 pure-button-primary">完&nbsp;&nbsp;成</button>
                    </fieldset>
                </form>
            </div>
    </div>

</div>

@include('index.public.footer')
<script>
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
    function activate() {

        var  department = $("#department").val();
        var  class1 = $("#class").val();
        var  user_name = $("#user_name").val();
        if(department === ''){
            layer.msg('请填写系部');
            return;
        }
        if(class1 === ''){
            layer.msg('请填写班级');
            return;
        }
        if(user_name === ''){
            layer.msg('请填写姓名');
            return;
        }
        var url = "{{url('user/activate')}}";
        var postData ={"department":department,"class1":class1,'user_name':user_name};
        $.post(url,postData,function (result) {
            if(result.error === 1 ){
                layer.alert(result.msg,function () {
                  location.href = "{{ url('/') }}";
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