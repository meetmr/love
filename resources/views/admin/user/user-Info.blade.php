@include('public.top')

<body>
<div class="x-nav">
      <span class="layui-breadcrumb">
        <a href="">首页</a>
        <a href="">成员管理</a>
        <a>
          <cite>成员列表</cite>
        </a>
      </span>
    <a class="layui-btn layui-btn-small" style="line-height:1.6em;margin-top:3px;float:right" href="javascript:location.replace(location.href);" title="刷新">
        <i class="layui-icon" style="line-height:30px">ဂ</i></a>
</div>

<div class="x-body" >
    <xblock>
        <button class="layui-btn layui-btn-danger" onclick="delAll()"><i class="layui-icon"></i>批量删除</button>&nbsp;&nbsp;&nbsp;&nbsp;
        <button class="layui-btn" onclick="x_admin_show('添加友链','{:url(\'admin/Link/add\')}',500,550)"><i class="layui-icon"></i>添加</button>
    </xblock>
    <div class="container-wrap">
        <div class="box-1">
            <table class="layui-table">
                <thead>
                <tr>
                    <th width="10" style="text-align: center">
                        <div class="layui-unselect header layui-form-checkbox" lay-skin="primary"><i class="layui-icon">&#xe605;</i></div>
                    </th>
                    <th style="text-align: center" width="80">学号</th>
                    <th style="text-align: center" width="100">姓名</th>
                    <th style="text-align: center" width="40">邮箱</th>
                    <th style="text-align: center" width="20">是否验证</th>
                    <th style="text-align: center" width="50" >密码</th>
                    <th style="text-align: center" width="50" >几届</th>
                    <th style="text-align: center" width="50">操作</th>
                </tr>
                </thead>
                <tbody>
                <tr  style="text-align: center">
                    <td>
                        <div class="layui-unselect layui-form-checkbox" lay-skin="primary" data-id=''><i class="layui-icon">&#xe605;</i></div>
                    </td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td>
                        <button class="layui-btn layui-btn-xs" onclick="update_status(this,'{$info.id}','{$info.status}')" >启用</button>
                        <button class="layui-btn layui-btn-primary layui-btn-xs" onclick="update_status(this,'{$info.id}','{$info.status}')">禁用</button>
                    </td>
                    <td class="td-manage" width="10">
                        <div class="layui-input-inline" >
                            <a class="layui-btn layui-btn-normal layui-btn-xs" lay-event="edit"  onclick="x_admin_show('修改友链','{:url(\'admin/link/edit\',[\'id\'=>$info.id])}',500,550)"><i class="layui-icon layui-icon-edit"></i>编辑</a>
                            <a class="layui-btn layui-btn-danger layui-btn-xs" lay-event="del" onclick="delete_link(this,'{$info.id}','{$info.logo}')" ><i class="layui-icon layui-icon-delete"></i>删除</a>
                        </div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
    <div class="page">
        {$linkInfo|raw}
    </div>
    <script>
        layui.use('laydate', function(){
            var laydate = layui.laydate;
            //执行一个laydate实例
            laydate.render({
                elem: '#start' //指定元素
            });

            //执行一个laydate实例
            laydate.render({
                elem: '#end' //指定元素
            });
        });
        //更改状态
        function update_status(obj,id,status) {
            layer.confirm('确定要更改状态吗？',function(index){
                $.ajax({
                    url:"{:url('admin/Link/updateStatus')}",
                    type:"POST",
                    dataType:"json",
                    data:{
                        id:id,  //id
                        status:status,   //状态
                        table:"link",
                        value:"status"
                    },
                    success:function (res) {
                        if (res === 1){
                            layer.alert("更新成功", {icon: 6},function () {
                                window.location.reload();  //刷新父级页面
                            });
                        }else {
                            layer.alert("更新失败", {icon: 5});
                        }
                    }
                });
            });

        }
        /*删除*/
        function delete_link(obj,id,logo){
            layer.confirm('确认要删除吗？',function(index){
                $.ajax({
                    url:"{:url('admin/Link/deleteLink')}",
                    type:"POST",
                    dataType:"json",
                    data:{
                        id:id,  //id
                        logo:logo
                    },
                    success:function (res) {
                        if (res === 1){
                            $(obj).parents("tr").remove();
                            layer.msg('已删除!',{icon:1,time:1000});
                        }else {
                            layer.alert("更新失败", {icon: 5});
                        }
                    }
                });
            });
        }

        function delAll (argument) {
            var data = tableCheck.getData();
            layer.confirm('确认要删除吗？',function(index){
                //捉到所有被选中的，发异步进行删除
                $.ajax({
                    url:"/index/index/delall",
                    type:"POST",
                    dataType:"json",
                    data:{
                        table:"hy_drawing_detial",  //表名
                        data:data   //数据
                    },
                    success:function (res) {
                        layer.msg(res.message, {icon: 1});
                        $(".layui-form-checked").not('.header').parents('tr').remove();
                    },
                });
            });
        }
    </script>
</body>
</html>