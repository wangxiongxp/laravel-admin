@inject('dictService', 'App\Services\DictService')

<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
</head>
<body class="white-bg">
	<div class="wrapper wrapper-content animated fadeInRight ibox-content">
		<form class="form-horizontal m" id="form-dict-add">
			<div class="form-group">
				<label class="col-sm-3 control-label ">字典标签：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="dict_label" id="dict_label" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label ">字典键值：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="dict_value" id="dict_value" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">字典类型：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" id="dict_type" name="dict_type" readonly="true" value="{{$dict_type}}">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">样式属性：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" id="css_class" name="css_class">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">字典排序：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="dict_sort" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">回显样式：</label>
				<div class="col-sm-8">
					<select name="list_class" class="form-control m-b">
					    <option value="">---请选择---</option>
	                    <option value="default">默认</option>
	                    <option value="primary">主要</option>
	                    <option value="success">成功</option>
	                    <option value="info">   信息</option>
	                    <option value="warning">警告</option>
	                    <option value="danger"> 危险</option>
	                </select>
	                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> table表格字典列显示样式属性</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">系统默认：</label>
				<div class="col-sm-8">
                    @foreach ($dictService->getType('sys_yes_no') as $dict)
                        <div class="radio-box">
                            <input type="radio" id="{{$dict['dict_code']}}" name="is_default" value="{{$dict['dict_value']}}" {{$dict['is_default'] == 'Y' ? 'checked' : ''}}>
                            <label for="{{$dict['dict_code']}}">{{$dict['dict_label']}}</label>
                        </div>
                    @endforeach
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">状态：</label>
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
		var prefix = "/system/dict/data";

		$("#form-dict-add").validate({
			rules:{
				dict_sort:{
					digits:true
				},
			},
			focusCleanup: true
		});

		function submitHandler() {
	        if ($.validate.form()) {
	        	$.operate.save(prefix + "/save", $('#form-dict-add').serialize());
	        }
	    }
	</script>
</body>
</html>
