@inject('dictService', 'App\Services\DictService')

<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
</head>
<body class="white-bg">
	<div class="wrapper wrapper-content animated fadeInRight ibox-content">
		<form class="form-horizontal m" id="form-user-edit">
			<div class="form-group">
				<label class="col-sm-3 control-label">用户编号：</label>
                <div class="col-sm-8">
				    <div class="form-control-static" >{{$user['userCode']}}</div>
                </div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label ">用户姓名：</label>
				<div class="col-sm-8">
				    <div class="form-control-static" >{{$user['userName']}}</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">用户性别：</label>
                <div class="col-sm-8">
                    <div class="form-control-static" >{{$dictService->getLabel('sys_user_sex',$user['userSex'])}}</div>
                </div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">用户手机：</label>
				<div class="col-sm-8">
				    <div class="form-control-static" >{{$user['userPhone']}}</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">用户邮箱：</label>
				<div class="col-sm-8">
				    <div class="form-control-static" >{{$user['userEmail']}}</div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">用户状态：</label>
				<div class="col-sm-8">
				    <div class="form-control-static" >{{$dictService->getLabel('sys_normal_disable',$user['status'])}}</div>
				</div>
			</div>
		</form>
	</div>
    @include('admin.layouts.footer')
	<script type="text/javascript">
		var prefix = "/demo/operate";

		$("#form-user-add").validate({
			onkeyup: false,
			rules:{
				userPhone:{
					isPhone:true
				},
				userEmail:{
					email:true
				},
			},
		    focusCleanup: true
		});

		function submitHandler() {
	        if ($.validate.form()) {
	        	$.operate.save(prefix + "/edit", $('#form-user-edit').serialize());
	        }
	    }
	</script>
</body>
</html>
