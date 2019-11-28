<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>jQuery Validate 简介</h5>
                    </div>
                    <div class="ibox-content">
                        <p>jquery.validate.js 是一款优秀的jQuery表单验证插件。它具有如下特点：</p>
                        <ul>
                            <li>安装简单</li>
                            <li>内置超过20种数据验证方法</li>
                            <li>直列错误提示信息</li>
                            <li>可扩展的数据验证方法</li>
                            <li>使用内置的元数据或插件选项来指定您的验证规则</li>
                            <li>优雅的交互设计</li>
                        </ul>
                        <p>官网：<a href="http://jqueryvalidation.org/" target="_blank">http://jqueryvalidation.org/</a>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>简单示例</h5>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" id="commentForm">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">姓名：</label>
                                <div class="col-sm-8">
                                    <input id="cname" name="name" minlength="2" type="text" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">E-mail：</label>
                                <div class="col-sm-8">
                                    <input id="cemail" type="email" class="form-control" name="email" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">网站：</label>
                                <div class="col-sm-8">
                                    <input id="curl" type="url" class="form-control" name="url">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">说明：</label>
                                <div class="col-sm-8">
                                    <textarea id="ccomment" name="comment" class="form-control" required></textarea>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-4 col-sm-offset-3">
                                    <button class="btn btn-primary" type="submit">提交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <p class="m-t">更多示例请访问官方示例页面：<a href="http://jqueryvalidation.org/files/demo/" target="_blank">查看</a>
                        </p>
                        <p>中文API可参考：<a href="http://doc.ruoyi.vip/ruoyi/document/zjwd.html#jquery-validate" target="_blank">http://doc.ruoyi.vip/ruoyi/document/zjwd.html#jquery-validate</a>
                        </p>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>完整验证表单</h5>
                    </div>
                    <div class="ibox-content">
                        <form class="form-horizontal m-t" id="signupForm">
                            <div class="form-group">
                                <label class="col-sm-3 control-label">姓氏：</label>
                                <div class="col-sm-8">
                                    <input id="firstname" name="firstname" class="form-control" type="text">
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 这里写点提示的内容</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">名字：</label>
                                <div class="col-sm-8">
                                    <input id="lastname" name="lastname" class="form-control" type="text" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">用户名：</label>
                                <div class="col-sm-8">
                                    <input id="username" name="username" class="form-control" type="text" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">密码：</label>
                                <div class="col-sm-8">
                                    <input id="password" name="password" class="form-control" type="password">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">确认密码：</label>
                                <div class="col-sm-8">
                                    <input id="confirm_password" name="confirm_password" class="form-control" type="password">
                                    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 请再次输入您的密码</span>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="col-sm-3 control-label">E-mail：</label>
                                <div class="col-sm-8">
                                    <input id="email" name="email" class="form-control" type="email">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-8 col-sm-offset-3">
                                    <button class="btn btn-primary" type="submit">提交</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('admin.layouts.footer')
    <script type="text/javascript">
    $(function(){
        $("#commentForm").validate();
        var icon = "<i class='fa fa-times-circle'></i> ";
        $("#signupForm").validate({
            rules: {
                firstname: "required",
                lastname: "required",
                username: {
                    required: true,
                    minlength: 2
                },
                password: {
                    required: true,
                    minlength: 5
                },
                confirm_password: {
                    required: true,
                    minlength: 5,
                    equalTo: "#password"
                },
                email: {
                    required: true,
                    email: true
                }
            },
            messages: {
                firstname: icon + "请输入你的姓",
                lastname: icon + "请输入您的名字",
                username: {
                    required: icon + "请输入您的用户名",
                    minlength: icon + "用户名必须两个字符以上"
                },
                password: {
                    required: icon + "请输入您的密码",
                    minlength: icon + "密码必须5个字符以上"
                },
                confirm_password: {
                    required: icon + "请再次输入密码",
                    minlength: icon + "密码必须5个字符以上",
                    equalTo: icon + "两次输入的密码不一致"
                },
                email: icon + "请输入您的E-mail"
            }
        });

        $("#username").focus(function () {
            var firstname = $("#firstname").val();
            var lastname = $("#lastname").val();
            if (firstname && lastname && !this.value) {
                this.value = firstname + "." + lastname;
            }
        });
    });
    </script>
</body>
</html>
