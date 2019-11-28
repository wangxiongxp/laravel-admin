@inject('dictService', 'App\Services\DictService')

<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
</head>
<body class="gray-bg">
	<div class="container-div">
		<div class="row">
			<div class="col-sm-12 search-collapse">
				<form id="role-form">
				    <input type="hidden" id="role_id" name="role_id" value="{{$role['role_id']}}">
					<div class="select-list">
						<ul>
							<li>
								登录名称：<input type="text" name="login_name"/>
							</li>
							<li>
								手机号码：<input type="text" name="phonenumber"/>
							</li>
							<li>
								<a class="btn btn-primary btn-rounded btn-sm" onclick="$.table.search()"><i class="fa fa-search"></i>&nbsp;搜索</a>
							    <a class="btn btn-warning btn-rounded btn-sm" onclick="$.form.reset()"><i class="fa fa-refresh"></i>&nbsp;重置</a>
							</li>
						</ul>
					</div>
				</form>
			</div>

	        <div class="btn-group-sm" id="toolbar" role="group">
				<a class="btn btn-success" onclick="selectUser()" shiro:hasPermission="system:role:add">
	                <i class="fa fa-plus"></i> 添加用户
	            </a>
				<a class="btn btn-danger multiple disabled" onclick="cancelAuthUserAll()" shiro:hasPermission="system:role:remove">
		            <i class="fa fa-remove"></i> 批量取消授权
		        </a>
		        <a class="btn btn-warning" onclick="closeItem()">
		            <i class="fa fa-reply-all"></i> 关闭
		        </a>
	        </div>

	        <div class="col-sm-12 select-table table-striped">
			    <table id="bootstrap-table"></table>
			</div>
		</div>
	</div>
    @include('admin.layouts.footer')
    <script type="text/javascript">
		// var removeFlag = [[${@permission.hasPermi('system:role:remove')}]];
		var removeFlag = '';
		var datas = @json($dictService->getType('sys_normal_disable'), JSON_PRETTY_PRINT) ;
		var prefix = "/system/role/authUser";

		$(function() {
			var options = {
		        url: prefix + "/allocatedList",
		        createUrl: prefix + "/add",
		        updateUrl: prefix + "/edit/{id}",
		        removeUrl: prefix + "/remove",
		        exportUrl: prefix + "/export",
		        importUrl: prefix + "/importData",
		        importTemplateUrl: prefix + "/importTemplate",
		        queryParams: queryParams,
		        sortName: "create_time",
		        sortOrder: "desc",
		        modalName: "用户",
		        columns: [{
		            checkbox: true
		        },
		        {
		            field: 'user_id',
		            title: '用户ID',
		            visible: false
		        },
		        {
		            field: 'login_name',
		            title: '登录名称',
		            sortable: true
		        },
		        {
		            field: 'user_name',
		            title: '用户名称'
		        },
		        {
		            field: 'email',
		            title: '邮箱'
		        },
		        {
		            field: 'phonenumber',
		            title: '手机'
		        },
		        {
		        	field: 'status',
		        	title: '用户状态',
		        	align: 'center',
		        	formatter: function (value, row, index) {
		        		return $.table.selectDictLabel(datas, value);
		        	}
		        },
		        {
		            field: 'create_time',
		            title: '创建时间',
		            sortable: true
		        },
		        {
		            title: '操作',
		            align: 'center',
		            formatter: function(value, row, index) {
		                var actions = [];
		                actions.push('<a class="btn btn-danger btn-xs ' + removeFlag + '" href="javascript:void(0)" onclick="cancelAuthUser(\'' + row.user_id + '\')"><i class="fa fa-remove"></i>取消授权</a> ');
		                return actions.join('');
		            }
		        }]
		    };
		    $.table.init(options);
		});

		function queryParams(params) {
			var search = $.table.queryParams(params);
			search.role_id = $("#role_id").val();
			return search;
		}

		/* 分配用户-选择用户 */
		function selectUser() {
			var url = prefix + '/selectUser/' + $("#role_id").val();
		    $.modal.open("选择用户", url);
		}

		/* 分配用户-批量取消授权 */
		function cancelAuthUserAll(user_id) {
		    var rows = $.table.selectFirstColumns();
       		if (rows.length == 0) {
       			$.modal.alertWarning("请至少选择一条记录");
       			return;
       		}
       		$.modal.confirm("确认要删除选中的" + rows.length + "条数据吗?", function() {
    			var data = { "role_id": $("#role_id").val(), "user_ids": rows.join() };
    			$.operate.submit(prefix + "/cancelAuthUserAll", "post", "json", data);
    		});
		}

		/* 分配用户-取消授权 */
		function cancelAuthUser(user_id) {
			$.modal.confirm("确认要取消该用户角色吗？", function() {
				$.operate.post(prefix + "/cancelAuthUser", { "role_id": $("#role_id").val(), "user_id": user_id });
		    })
		}
	</script>
</body>
</html>
