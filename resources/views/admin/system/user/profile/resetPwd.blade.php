<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
</head>
<body class="white-bg">
	<div class="wrapper wrapper-content animated fadeInRight ibox-content">
		<form class="form-horizontal m" id="form-user-resetPwd">
			<input name="user_id"  type="hidden" value="{{$user['user_id']}}" />
			<div class="form-group">
				<label class="col-sm-3 control-label ">登录名称：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" readonly="true" name="login_name" value="{{$user['login_name']}}"/>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">旧密码：</label>
				<div class="col-sm-8">
					<input class="form-control" type="password" name="old_password" id="old_password">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">新密码：</label>
				<div class="col-sm-8">
					<input class="form-control" type="password" name="new_password" id="new_password">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">再次确认：</label>
				<div class="col-sm-8">
					<input class="form-control" type="password" name="confirm" id="confirm">
					<span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 请再次输入您的密码</span>
				</div>
			</div>
		</form>
	</div>
    @include('admin.layouts.footer')
	<script>
		$("#form-user-resetPwd").validate({
			rules:{
				old_password:{
					required:true,
					remote: {
	                    url: "/system/user/profile/checkPassword",
	                    type: "get",
	                    dataType: "json",
	                    data: {
	                        password: function() {
	                            return $("input[name='old_password']").val();
	                        }
	                    }
	                }
				},
				new_password: {
	                required: true,
	                minlength: 5,
	    			maxlength: 20
	            },
	            confirm: {
	                required: true,
	                equalTo: "#new_password"
	            }
			},
			messages: {
	            old_password: {
	                required: "请输入原密码",
	                remote: "原密码错误"
	            },
	            new_password: {
	                required: "请输入新密码",
	                minlength: "密码不能小于6个字符",
	                maxlength: "密码不能大于20个字符"
	            },
	            confirm: {
	                required: "请再次输入新密码",
	                equalTo: "两次密码输入不一致"
	            }

	        },
	        focusCleanup: true
		});

		function submitHandler() {
	        if ($.validate.form()) {
	        	$.operate.save( "/system/user/profile/resetPwdSave", $('#form-user-resetPwd').serialize());
	        }
	    }
	</script>
</body>

</html>
