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
					<input class="form-control" type="text" name="role_name" id="role_name"  value="{{$role['role_name']}}" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">权限字符：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="role_key" id="role_key" value="{{$role['role_key']}}" required>
					<span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 控制器中定义的权限字符，如：@RequiresRoles("")</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">显示顺序：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="role_sort" id="role_sort" value="{{$role['role_sort']}}" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">状态：</label>
				<div class="col-sm-8">
					<label class="toggle-switch switch-solid">
                        <input type="checkbox" id="status"  checked="{{$role['status']==0?true:false}}">
                        <span></span>
                    </label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">备注：</label>
				<div class="col-sm-8">
					<input id="remark" name="remark" class="form-control" type="text" value="{{$role['remark']}}">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">菜单权限</label>
				<div class="col-sm-8">
					<div id="menuTrees" class="ztree"></div>
				</div>
			</div>
		</form>
	</div>
    @include('admin.layouts.footer')
    <script src="/static/ajax/libs/jquery-ztree/3.5/js/jquery.ztree.all-3.5.js"></script>
	<script type="text/javascript">
	     $(function() {
			var url = "/system/menu/roleMenuTreeData?role_id=" + $("#role_id").val();
			var options = {
				id: "menuTrees",
		        url: url,
		        check: { enable: true },
		        expandLevel: 0
		    };
			$.tree.init(options);
		});

		$("#form-role-edit").validate({
			onkeyup: false,
			rules:{
				role_name:{
					remote: {
		                url: "/system/role/checkRoleNameUnique",
		                type: "post",
		                dataType: "json",
		                data: {
							"role_id": function() {
							    return $("#role_id").val();
							},
							"role_name": function() {
							    return $.common.trim($("#role_name").val());
							}
		                },
		                dataFilter: function(data, type) {
		                	return $.validate.unique(data);
		                }
		            }
				},
				role_key:{
					remote: {
		                url: "/system/role/checkRoleKeyUnique",
		                type: "post",
		                dataType: "json",
		                data: {
							"role_id": function() {
								return $("#role_id").val();
							},
							"role_key": function() {
							    return $.common.trim($("#role_key").val());
							}
		                },
		                dataFilter: function(data, type) {
		                	return $.validate.unique(data);
		                }
		            }
				},
				role_sort:{
					digits:true
				},
			},
			messages: {
		        "role_name": {
		            remote: "角色名称已经存在"
		        },
		        "role_key": {
		            remote: "角色权限已经存在"
		        }
		    },
		    focusCleanup: true
		});

		function edit() {
			var role_id = $("input[name='role_id']").val();
			var role_name = $("input[name='role_name']").val();
			var role_key = $("input[name='role_key']").val();
			var role_sort = $("input[name='role_sort']").val();
			var status = $("input[id='status']").is(':checked') == true ? 0 : 1;
			var remark = $("input[name='remark']").val();
			var menuIds = $.tree.getCheckedNodes();
			$.ajax({
				cache : true,
				type : "POST",
				url : "/system/role/update",
				data : {
					"role_id": role_id,
					"role_name": role_name,
					"role_key": role_key,
					"role_sort": role_sort,
					"status": status,
					"remark": remark,
					"menu_ids": menuIds
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

		function submitHandler() {
	        if ($.validate.form()) {
	        	edit();
	        }
	    }
	</script>
</body>
</html>
