@inject('dictService', 'App\Services\DictService')

<!DOCTYPE html>
<html>
<head>
    @include('admin.layouts.header')
</head>
<body class="gray-bg">
	<div class="container-div">
		<div class="row">
			<div class="col-sm-12 search-collapse">
				<form id="role-form">
					<div class="select-list">
						<ul>
							<li>
								角色名称：<input type="text" name="role_name"/>
							</li>
							<li>
								权限字符：<input type="text" name="role_key"/>
							</li>
							<li>
								角色状态：
                                <select name="status">
									<option value="">所有</option>
                                    @foreach ($dictService->getType('sys_normal_disable') as $dict)
                                        <option value="{{$dict['dict_value']}}">{{$dict['dict_label']}}</option>
                                    @endforeach
								</select>
							</li>
							<li class="select-time">
								<label>创建时间： </label>
								<input type="text" class="time-input" id="startTime" placeholder="开始时间" name="startTime"/>
								<span>-</span>
								<input type="text" class="time-input" id="endTime" placeholder="结束时间" name="endTime"/>
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
                @can('create', App\Models\SysRole::class)
                    <a class="btn btn-success" onclick="$.operate.add()">
                        <i class="fa fa-plus"></i> 新增
                    </a>
                @endcan

                @can('update', App\Models\SysRole::class)
                    <a class="btn btn-primary single disabled" onclick="$.operate.edit()">
                        <i class="fa fa-edit"></i> 修改
                    </a>
                @endcan

                @can('delete', App\Models\SysRole::class)
                    <a class="btn btn-danger multiple disabled" onclick="$.operate.removeAll()">
                        <i class="fa fa-remove"></i> 删除
                    </a>
                @endcan

                @can('export', App\Models\SysRole::class)
                    <a class="btn btn-warning" onclick="$.table.exportExcel()">
                        <i class="fa fa-download"></i> 导出
                    </a>
                @endcan
	        </div>

	        <div class="col-sm-12 select-table table-striped">
			    <table id="bootstrap-table"></table>
			</div>
		</div>
	</div>
    @include('admin.layouts.footer')
    <script type="text/javascript">
		var prefix = "/system/role";

		$(function() {
		    var options = {
		        url: prefix + "/list",
		        createUrl: prefix + "/add",
		        updateUrl: prefix + "/edit/{id}",
		        removeUrl: prefix + "/remove",
		        exportUrl: prefix + "/export",
		        sortName: "role_sort",
		        modalName: "角色",
		        columns: [{
		            checkbox: true
		        },
		        {
		            field: 'role_id',
		            title: '角色编号'
		        },
		        {
		            field: 'role_name',
		            title: '角色名称',
		            sortable: true
		        },
		        {
		            field: 'role_key',
		            title: '权限字符',
		            sortable: true
		        },
		        {
		            field: 'role_sort',
		            title: '显示顺序',
		            sortable: true
		        },
		        {
		        	visible: @can('update', App\Models\SysRole::class)
                        true
                    @else
                        false
                    @endcan ,
		        	title: '角色状态',
		        	align: 'center',
		        	formatter: function (value, row, index) {
		        		return statusTools(row);
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
                        @can('update', App\Models\SysRole::class)
                            actions.push('<a class="btn btn-success btn-xs" href="javascript:void(0)" onclick="$.operate.edit(\'' + row.role_id + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                            actions.push('<a class="btn btn-primary btn-xs" href="javascript:void(0)" onclick="authDataScope(\'' + row.role_id + '\')"><i class="fa fa-check-square-o"></i>数据权限</a> ');
                            actions.push('<a class="btn btn-info btn-xs" href="javascript:void(0)" onclick="authUser(\'' + row.role_id + '\')"><i class="fa fa-user"></i>分配用户</a> ');
                        @endcan
                        @can('delete', App\Models\SysRole::class)
                            actions.push('<a class="btn btn-danger btn-xs" href="javascript:void(0)" onclick="$.operate.remove(\'' + row.role_id + '\')"><i class="fa fa-remove"></i>删除</a> ');
                        @endcan
		                return actions.join('');
		            }
		        }]
		    };
		    $.table.init(options);
		});

		/* 角色管理-分配数据权限 */
		function authDataScope(role_id) {
		    var url = prefix + '/authDataScope/' + role_id;
		    $.modal.open("分配数据权限", url);
		}

		/* 角色管理-分配用户 */
		function authUser(role_id) {
		    var url = prefix + '/authUser/' + role_id;
		    $.modal.openTab("分配用户", url);
		}

		/* 角色状态显示 */
		function statusTools(row) {
		    if (row.status == 1) {
    			return '<i class=\"fa fa-toggle-off text-info fa-2x\" onclick="enable(\'' + row.role_id + '\')"></i> ';
    		} else {
    			return '<i class=\"fa fa-toggle-on text-info fa-2x\" onclick="disable(\'' + row.role_id + '\')"></i> ';
    		}
		}

		/* 角色管理-停用 */
		function disable(role_id) {
			$.modal.confirm("确认要停用角色吗？", function() {
				$.operate.post(prefix + "/changeStatus", { "role_id": role_id, "status": 1 });
		    })
		}

		/* 角色管理启用 */
		function enable(role_id) {
			$.modal.confirm("确认要启用角色吗？", function() {
				$.operate.post(prefix + "/changeStatus", { "role_id": role_id, "status": 0 });
		    })
		}
	</script>
</body>
</html>
