@inject('dictService', 'App\Services\DictService')

<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
</head>
<body class="white-bg">
    <div class="wrapper wrapper-content animated fadeInRight ibox-content">
        <form class="form-horizontal m" id="form-config-add" name="form-config-add">
        <div class="form-group">
            <label class="col-sm-3 control-label">参数名称：</label>
            <div class="col-sm-8">
                <input id="config_name" name="config_name" class="form-control" type="text" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">参数键名：</label>
            <div class="col-sm-8">
                <input id="config_key" name="config_key" class="form-control" type="text" required>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-3 control-label">参数键值：</label>
            <div class="col-sm-8">
                <input id="config_value" name="config_value" class="form-control" type="text" required>
            </div>
        </div>
        <div class="form-group">
			<label class="col-sm-3 control-label">系统内置：</label>
			<div class="col-sm-8">
                @foreach ($dictService->getType('sys_yes_no') as $dict)
                    <div class="radio-box">
                        <input type="radio" id="{{$dict['dict_code']}}" name="config_type" value="{{$dict['dict_value']}}" {{$dict['is_default'] == 'Y' ? 'checked' : ''}} >
                        <label for="{{$dict['dict_code']}}">{{$dict['dict_label']}}</label>
                    </div>
                @endforeach
			</div>
		</div>
		<div class="form-group">
            <label class="col-sm-3 control-label">备注：</label>
            <div class="col-sm-8">
                <textarea id="remark" name="remark" class="form-control"></textarea>
            </div>
        </div>
    </form>
    </div>
    @include('admin.layouts.footer')
    <script type="text/javascript">
	    var prefix = "/system/config";

	    $("#form-config-add").validate({
	    	onkeyup: false,
	        rules: {
	            config_key: {
	                remote: {
	                    url: prefix + "/checkConfigKeyUnique",
	                    type: "post",
	                    dataType: "json",
	                    data: {
	                        "config_key": function() {
	                            return $.common.trim($("#config_key").val());
	                        }
	                    },
	                    dataFilter: function(data, type) {
	                        return $.validate.unique(data);
	                    }
	                }
	            },
	        },
	        messages: {
	            "config_key": {
	                remote: "参数键名已经存在"
	            }
	        },
	        focusCleanup: true
	    });

	    function submitHandler() {
	        if ($.validate.form()) {
	            $.operate.save(prefix + "/save", $('#form-config-add').serialize());
	        }
	    }
    </script>
</body>
</html>
