@inject('dictService', 'App\Services\DictService')

<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
</head>
<body class="white-bg">
	<div class="wrapper wrapper-content animated fadeInRight ibox-content">
		<form class="form-horizontal m" id="form-post-add">
			<div class="form-group">
				<label class="col-sm-3 control-label">岗位名称：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="post_name" id="post_name" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label ">岗位编码：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="post_code" id="post_code" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">显示顺序：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="post_sort" id="post_sort" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">岗位状态：</label>
				<div class="col-sm-8">
                    @foreach ($dictService->getType('sys_normal_disable') as $dict)
                        <div class="radio-box">
                            <input type="radio" id="{{$dict['dict_code']}}" name="status" value="{{$dict['dict_value']}}" {{$dict['is_default'] == 'Y' ? 'checked' : ''}}>
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
		var prefix =  "/system/post";

		$("#form-post-add").validate({
			onkeyup: false,
			rules:{
				post_name:{
					remote: {
		                url: prefix + "/checkPostNameUnique",
		                type: "post",
		                dataType: "json",
		                data: {
		                	"post_name" : function() {
		                        return $.common.trim($("#post_name").val());
		                    }
		                },
		                dataFilter: function(data, type) {
		                	return $.validate.unique(data);
		                }
		            }
				},
				post_code:{
					remote: {
		                url: prefix + "/checkPostCodeUnique",
		                type: "post",
		                dataType: "json",
		                data: {
		                	"post_code" : function() {
		                        return $.common.trim($("#post_code").val());
		                    }
		                },
		                dataFilter: function(data, type) {
		                	return $.validate.unique(data);
		                }
		            }
				},
				post_sort:{
					digits:true
				},
			},
			messages: {
		        "post_code": {
		            remote: "岗位编码已经存在"
		        },
		        "post_name": {
		            remote: "岗位名称已经存在"
		        }
		    },
		    focusCleanup: true
		});

		function submitHandler() {
	        if ($.validate.form()) {
	        	$.operate.save(prefix + "/save", $('#form-post-add').serialize());
	        }
	    }
	</script>
</body>
</html>
