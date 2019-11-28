<?php $configService = app('App\Services\ConfigService'); ?>

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
				<label class="col-sm-3 control-label">输入密码：</label>
				<div class="col-sm-8">
					<input class="form-control" type="password" name="password" id="password" value="{{$configService->getKey('sys.user.initPassword')}}">
				</div>
			</div>
		</form>
	</div>
    @include('admin.layouts.footer')
	<script type="text/javascript">
		$("#form-user-resetPwd").validate({
			rules:{
				password:{
					required:true,
					minlength: 5,
					maxlength: 20
				},
			},
			focusCleanup: true
		});

		function submitHandler() {
	        if ($.validate.form()) {
	        	$.operate.save(ctx + "system/user/resetPwdSave", $('#form-user-resetPwd').serialize());
	        }
	    }
	</script>
</body>

</html>
