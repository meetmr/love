@include('public.top')
<div class="x-body layui-anim layui-anim-up">
    <blockquote class="layui-elem-quote">欢迎管理员：
        <span class="x-red">Admin</span>！当前时间:2018-04-25 20:50:53</blockquote>
    <fieldset class="layui-elem-field">
        <legend>数据统计</legend>
        <div class="layui-field-box">
            <div class="layui-col-md12">
                <div class="layui-card">
                    <div class="layui-card-body">
                        <div class="layui-carousel x-admin-carousel x-admin-backlog" lay-anim="" lay-indicator="inside" lay-arrow="none" style="width: 100%; height: 90px;">
                            <div carousel-item="">
                                <ul class="layui-row layui-col-space10 layui-this">
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>成员总数</h3>
                                            <p><cite>12</cite></p></a>
                                    </li>
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>图纸总数</h3>
                                            <p><cite>66</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>合同总数</h3>
                                            <p><cite>67</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>任务总数</h3>
                                            <p><cite>99</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>订单总数</h3>
                                            <p><cite>67</cite></p>
                                        </a>
                                    </li>
                                    <li class="layui-col-xs2">
                                        <a href="javascript:;" class="x-admin-backlog-body">
                                            <h3>资料总数</h3>
                                            <p><cite>6766</cite></p></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </fieldset>
    <fieldset class="layui-elem-field">
        <legend>通知</legend>
        <div class="layui-field-box">
            <table class="layui-table" lay-skin="line">
                <tbody>
                <tr>
                    <td >
                        <a class="x-a" href="/" target="_blank">
                            为便于叶片审核数量，请在填写加工数量时按件分开填写。比如大端完整加工为0.6，接上班已填写0.4，本班先填写上班剩余0.2，再填写本班加工的数量。审核时如本班未完整加工，会暂时不审核，留下一班填写时参考。
                        </a>
                    </td>
                </tr>
                <tr>
                    <td >
                        <a class="x-a" href="/" target="_blank">
                            经检查，发现之前填写存在错填、多填、漏填。未避免错误，请加工后及时填写。填写时仔细选择。
                        </a>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </fieldset>
    <fieldset class="layui-elem-field">
        <legend>系统信息</legend>
        <div class="layui-field-box">
            <table class="layui-table">
                <tbody>
                <tr>
                    <th>xxx版本</th>
                    <td>1.0.180420</td></tr>
                <tr>
                    <th>服务器地址</th>
                    <td>x.xuebingsi.com</td></tr>
                <tr>
                    <th>操作系统</th>
                    <td>WINNT</td></tr>
                <tr>
                    <th>运行环境</th>
                    <td>Apache/2.4.23 (Win32) OpenSSL/1.0.2j mod_fcgid/2.3.9</td></tr>
                <tr>
                    <th>PHP版本</th>
                    <td>5.6.27</td></tr>
                <tr>
                    <th>PHP运行方式</th>
                    <td>cgi-fcgi</td></tr>
                <tr>
                    <th>MYSQL版本</th>
                    <td>5.5.53</td></tr>
                <tr>
                    <th>ThinkPHP</th>
                    <td>5.0.18</td></tr>
                <tr>
                    <th>上传附件限制</th>
                    <td>2M</td></tr>
                <tr>
                    <th>执行时间限制</th>
                    <td>30s</td></tr>
                <tr>
                    <th>剩余空间</th>
                    <td>86015.2M</td></tr>
                </tbody>
            </table>
        </div>
    </fieldset>
    <fieldset class="layui-elem-field">
        <legend>开发团队</legend>
        <div class="layui-field-box">
            <table class="layui-table">
                <tbody>
                <tr>
                    <th>版权所有</th>
                    <td>恒易</td>
                </tr>
                <tr>
                    <th>开发者</th>
                    <td>邓素川、唐玉琳、王恒兵</td></tr>
                </tbody>
            </table>
        </div>
    </fieldset>
</div>
