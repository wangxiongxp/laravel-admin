@inject('dictService', 'App\Services\DictService')

<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
</head>
<body class="white-bg">
	<div class="wrapper wrapper-content animated fadeInRight ibox-content">
		<form class="form-horizontal m" id="form-dict-edit" >
			<input name="dict_code"  type="hidden" value="{{$dictData['dict_code']}}" />
			<div class="form-group">
				<label class="col-sm-3 control-label ">字典标签：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="dict_label" id="dict_label" value="{{$dictData['dict_label']}}" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label ">字典键值：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="dict_value" id="dict_value" value="{{$dictData['dict_value']}}" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">字典类型：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" readonly="true" value="{{$dictData['dict_type']}}" >
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">样式属性：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" id="css_class" name="css_class" value="{{$dictData['css_class']}}">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">字典排序：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="dict_sort" value="{{$dictData['dict_sort']}}" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">回显样式：</label>
				<div class="col-sm-8">
					<select name="list_class" class="form-control m-b">
					    <option value=""        @if(''==$dictData['list_class'])selected="selected" @endif>---请选择---</option>
	                    <option value="default" @if('default'==$dictData['list_class'])selected="selected" @endif>默认</option>
	                    <option value="primary" @if('primary'==$dictData['list_class'])selected="selected" @endif>主要</option>
	                    <option value="success" @if('success'==$dictData['list_class'])selected="selected" @endif>成功</option>
	                    <option value="info"    @if('info'==$dictData['list_class'])selected="selected" @endif>信息</option>
	                    <option value="warning" @if('warning'==$dictData['list_class'])selected="selected" @endif>警告</option>
	                    <option value="danger"  @if('danger'==$dictData['list_class'])selected="selected" @endif>危险</option>
	                </select>
	                <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> table表格字典列显示样式属性</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">系统默认：</label>
				<div class="col-sm-8">
                    @foreach ($dictService->getType('sys_yes_no') as $dict)
                        <div class="radio-box">
                            <input type="radio" id="{{$dict['dict_code']}}" name="is_default" value="{{$dict['dict_value']}}" @if($dict['dict_value']==$dictData['is_default'])checked="checked" @endif>
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
                            <input type="radio" id="{{$dict['dict_code']}}" name="status" value="{{$dict['dict_value']}}" @if($dict['dict_value']==$dictData['status'])checked="checked" @endif>
                            <label for="{{$dict['dict_code']}}">{{$dict['dict_label']}}</label>
                        </div>
                    @endforeach
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">备注：</label>
				<div class="col-sm-8">
					<textarea id="remark" name="remark" class="form-control">{{$dictData['remark']}}</textarea>
				</div>
			</div>
		</form>
	</div>
    @include('admin.layouts.footer')
    <script type="text/javascript">
		var prefix = "/system/dict/data";

		$("#form-dict-edit").validate({
			rules:{
				dict_sort:{
					digits:true
				},
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
