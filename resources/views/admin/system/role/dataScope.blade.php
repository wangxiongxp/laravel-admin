<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
    <link href="/static/ajax/libs/jquery-ztree/3.5/css/metro/zTreeStyle.css" rel="stylesheet"/>
</head>
<body class="white-bg">
	<div class="wrapper wrapper-content animated fadeInRight ibox-content">
		<form class="form-horizontal m" id="form-role-edit" >
			<input id="role_id" name="role_id" type="hidden" value="{{$role['role_id']}}"/>
			<div class="form-group">
				<label class="col-sm-3 control-label ">角色名称：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="role_name" id="role_name" value="{{$role['role_name']}}" readonly />
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">权限字符：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="role_key" id="role_key" value="{{$role['role_key']}}" readonly >
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">数据范围：</label>
				<div class="col-sm-8">
					<select id="dataScope" name="dataScope" class="form-control m-b">
						<option value="1" th:field="*{dataScope}">全部数据权限</option>
						<option value="2" th:field="*{dataScope}">自定数据权限</option>
						<option value="3" th:field="*{dataScope}">本部门数据权限</option>
						<option value="4" th:field="*{dataScope}">本部门及以下数据权限</option>
						<option value="5" th:field="*{dataScope}">仅本人数据权限</option>
					</select>
					<span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 特殊情况下，设置为“自定数据权限”</span>
				</div>
			</div>
			<div class="form-group" id="authDataScope" th:style="'display:' + @{(*{dataScope=='2'} ? 'block' : 'none')} + ''">
				<label class="col-sm-3 control-label">数据权限</label>
				<div class="col-sm-8">
					<div id="deptTrees" class="ztree"></div>
				</div>
			</div>
		</form>
	</div>
    @include('admin.layouts.footer')
    <script src="/static/ajax/libs/jquery-ztree/3.5/js/jquery.ztree.all-3.5.js"></script>
    <script type="text/javascript">

	    $(function() {
			var url = "/system/dept/roleDeptTreeData?role_id=" + $("#role_id").val();
			var options = {
				id: "deptTrees",
		        url: url,
		        check: { enable: true, nocheckInherit: true, chkboxType: { "Y": "ps", "N": "ps" } },
		        expandLevel: 2
		    };
			$.tree.init(options);
	    });

		function submitHandler() {
	        if ($.validate.form()) {
	        	edit();
	        }
	    }

		function edit() {
			var role_id = $("input[name='role_id']").val();
			var role_name = $("input[name='role_name']").val();
			var role_key = $("input[name='role_key']").val();
			var dataScope = $("#dataScope").val();
            var deptIds = $.tree.getCheckedNodes();
			$.ajax({
				cache : true,
				type : "POST",
				url : "/system/role/authDataScopeSave",
				data : {
					"role_id": role_id,
					"role_name": role_name,
					"role_key": role_key,
					"data_scope": dataScope,
			        "dept_ids": deptIds
				},
				async : false,
				error : function(request) {
					$.modal.alertError("系统错误");
				},
				success : function(data) {
					$.operate.successCallback(data);
				}
			});
		}

		$("#dataScope").change(function(event){
        	var dataScope = $(event.target).val();
        	dataScopeVisible(dataScope);
        });

		function dataScopeVisible(dataScope) {
			if (dataScope == 2) {
	    		$("#authDataScope").show();
	    	} else {
	    		$._tree.checkAllNodes(false);
	    		$("#authDataScope").hide();
	    	}
		}
	</script>
</body>
</html>
