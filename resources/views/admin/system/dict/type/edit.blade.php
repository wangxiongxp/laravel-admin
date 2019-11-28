@inject('dictService', 'App\Services\DictService')

<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
</head>
<body class="white-bg">
	<div class="wrapper wrapper-content animated fadeInRight ibox-content">
		<form class="form-horizontal m" id="form-dict-edit">
			<input id="dict_id" name="dict_id" type="hidden" value="{{$dict['dict_id']}}" />
			<div class="form-group">
				<label class="col-sm-3 control-label ">字典名称：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="dict_name" id="dict_name" value="{{$dict['dict_name']}}" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">字典类型：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="dict_type" id="dict_type" value="{{$dict['dict_type']}}" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">状态：</label>
				<div class="col-sm-8">
                    @foreach ($dictService->getType('sys_normal_disable') as $item)
                        <div class="radio-box">
                            <input type="radio" id="{{$item['dict_code']}}" name="status" value="{{$item['dict_value']}}" @if($item['dict_value']==$dict['status'])checked @endif>
                            <label for="{{$item['dict_code']}}">{{$item['dict_label']}}</label>
                        </div>
                    @endforeach
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">备注：</label>
				<div class="col-sm-8">
					<textarea id="remark" name="remark" class="form-control">{{$dict['remark']}}</textarea>
				</div>
			</div>
		</form>
	</div>
    @include('admin.layouts.footer')
    <script type="text/javascript">
		var prefix = "/system/dict";

		$("#form-dict-edit").validate({
			onkeyup: false,
			rules:{
				dict_type:{
					minlength: 5,
					remote: {
		                url: prefix + "/checkDictTypeUnique",
		                type: "post",
		                dataType: "json",
		                data: {
		                	dict_id : function() {
		                        return $("#dict_id").val();
		                    },
		                	dict_type : function() {
		                		return $.common.trim($("#dict_type").val());
		                    }
		                },
		                dataFilter: function(data, type) {
		                	return $.validate.unique(data);
		                }
		            }
				},
			},
			messages: {
		        "dict_type": {
		            remote: "该字典类型已经存在"
		        }
		    },
		    focusCleanup: true
		});

		function submitHandler() {
	        if ($.validate.form()) {
	        	$.operate.save(prefix + "/update", $('#form-dict-edit').serialize());
	        }
	    }
	</script>
</body>
</html>
