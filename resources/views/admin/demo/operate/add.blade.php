@inject('dictService', 'App\Services\DictService')

<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
</head>
<body class="white-bg">
	<div class="wrapper wrapper-content animated fadeInRight ibox-content">
		<form class="form-horizontal m" id="form-user-add">
			<div class="form-group">
				<label class="col-sm-3 control-label">用户编号：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="userCode" id="userCode" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label ">用户姓名：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="userName" id="userName" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">用户性别：</label>
                <div class="col-sm-8">
                    <div class="input-group" style="width: 100%">
                        <select name="userSex" class="form-control m-b">
                            @foreach ($dictService->getType('sys_user_sex') as $dict)
                                <option value="{{$dict['dict_value']}}" {{$dict['is_default'] == 'Y' ? 'selected' : ''}}>{{$dict['dict_label']}}</option>
                            @endforeach
			            </select>
                    </div>
                </div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">用户手机：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="userPhone" id="userPhone">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">用户邮箱：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="userEmail" id="userEmail">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">用户状态：</label>
				<div class="col-sm-8" >
                    @foreach ($dictService->getType('sys_normal_disable') as $dict)
                        <div class="radio-box">
                            <input type="radio" id="{{$dict['dict_code']}}" name="config_type" value="{{$dict['dict_value']}}" {{$dict['is_default'] == 'Y' ? 'checked' : ''}} >
                            <label for="{{$dict['dict_code']}}">{{$dict['dict_label']}}</label>
                        </div>
                    @endforeach
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
	        	$.operate.save(prefix + "/add", $('#form-user-add').serialize());
	        }
	    }
	</script>
</body>
</html>
