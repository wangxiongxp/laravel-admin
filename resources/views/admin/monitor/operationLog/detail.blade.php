@inject('dictService', 'App\Services\DictService')

<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
    <link href="/static/ajax/libs/jsonview/jquery.jsonview.css" rel="stylesheet"/>
</head>
<body class="white-bg">
	<div class="wrapper wrapper-content animated fadeInRight ibox-content">
	<form class="form-horizontal m-t" id="signupForm">
		<div class="form-group">
			<label class="col-sm-2 control-label">操作模块：</label>
			<div class="form-control-static" >
                {{$operLog['title']}} / {{$dictService->getLabel('sys_oper_type',$operLog['business_type'])}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">登录信息：</label>
			<div class="form-control-static" >
                {{$operLog['oper_name']}} / {{$operLog['dept_name']}} / {{$operLog['oper_ip']}} / {{$operLog['oper_location']}}
            </div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">请求地址：</label>
			<div class="form-control-static">
                {{$operLog['oper_url']}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">请求方式：</label>
			<div class="form-control-static">
                {{$operLog['request_method']}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">操作方法：</label>
			<div class="form-control-static">
                {{$operLog['method']}}
			</div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">请求参数：</label>
			<div class="form-control-static"><pre id="operParam"></pre></div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">返回参数：</label>
			<div class="form-control-static"><pre id="jsonResult"></pre></div>
		</div>
		<div class="form-group">
			<label class="col-sm-2 control-label">状态：</label>
			<div class="form-control-static {{$operLog['status'] == 0 ? 'label label-primary':'label label-danger'}}" >
                {{$operLog['status'] == 0 ? '正常' : '异常'}}
			</div>
		</div>
		<div class="form-group" style="display: {{$operLog['status']==0?'none':'block'}}">
			<label class="col-sm-2 control-label">异常信息：</label>
			<div class="form-control-static">
                {{$operLog['error_msg']}}
			</div>
		</div>
	</form>
    </div>
    @include('admin.layouts.footer')
    <script src="/static/ajax/libs/jsonview/jquery.jsonview.js"></script>
    <script type="text/javascript">
	    $(function() {
	    	var operParam = '{{$operLog['oper_param']}}';
	    	if ($.common.isNotEmpty(operParam) && operParam.length < 2000) {
	    		$("#operParam").JSONView(operParam);
	    	} else {
	    		$("#operParam").text(operParam);
	    	}
	    	var jsonResult = '{{$operLog['json_result']}}';
	    	if ($.common.isNotEmpty(jsonResult) && jsonResult.length < 2000) {
	    		$("#jsonResult").JSONView(jsonResult);
	    	} else {
	    		$("#jsonResult").text(jsonResult);
	    	}
	    });
    </script>
</body>
</html>
