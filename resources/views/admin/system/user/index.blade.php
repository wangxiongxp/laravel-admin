@inject('dictService', 'App\Services\DictService')

<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
    <link href="/static/ajax/libs/jquery-layout/jquery.layout-latest.css" rel="stylesheet"/>
    <link href="/static/ajax/libs/jquery-ztree/3.5/css/metro/zTreeStyle.css" rel="stylesheet"/>
</head>
<body class="gray-bg">
	<div class="ui-layout-west">
		<div class="box box-main">
			<div class="box-header">
				<div class="box-title">
					<i class="fa icon-grid"></i> 组织机构
				</div>
				<div class="box-tools pull-right">
				    <a type="button" class="btn btn-box-tool" href="#" onclick="dept()" title="管理部门"><i class="fa fa-edit"></i></a>
					<button type="button" class="btn btn-box-tool" id="btnExpand" title="展开" style="display:none;"><i class="fa fa-chevron-up"></i></button>
					<button type="button" class="btn btn-box-tool" id="btnCollapse" title="折叠"><i class="fa fa-chevron-down"></i></button>
					<button type="button" class="btn btn-box-tool" id="btnRefresh" title="刷新部门"><i class="fa fa-refresh"></i></button>
				</div>
			</div>
			<div class="ui-layout-content">
				<div id="tree" class="ztree"></div>
			</div>
		</div>
	</div>

	<div class="ui-layout-center">
		<div class="container-div">
			<div class="row">
				<div class="col-sm-12 search-collapse">
					<form id="user-form">
						<input type="hidden" id="dept_id" name="dept_id">
		                <input type="hidden" id="parent_id" name="parent_id">
						<div class="select-list">
							<ul>
								<li>
									登录名称：<input type="text" name="login_name"/>
								</li>
								<li>
									手机号码：<input type="text" name="phonenumber"/>
								</li>
								<li>
									用户状态：
                                    <select name="status">
										<option value="">所有</option>
                                        @foreach ($dictService->getType('sys_normal_disable') as $dict)
                                            <option value="{{$dict['dict_value']}}">{{$dict['dict_label']}}</option>
                                        @endforeach
									</select>
								</li>
								<li class="select-time">
									<label>创建时间： </label>
									<input type="text" class="time-input" id="start_time" placeholder="开始时间" name="start_time"/>
									<span>-</span>
									<input type="text" class="time-input" id="end_time" placeholder="结束时间" name="end_time"/>
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

                    @can('create', App\Models\SysUser::class)
                        <a class="btn btn-success" onclick="$.operate.addTab()">
                            <i class="fa fa-plus"></i> 新增
                        </a>
                    @endcan

                    @can('update', App\Models\SysUser::class)
                        <a class="btn btn-primary single disabled" onclick="$.operate.editTab()">
                            <i class="fa fa-edit"></i> 修改
                        </a>
                    @endcan

                    @can('delete', App\Models\SysUser::class)
                        <a class="btn btn-danger multiple disabled" onclick="$.operate.removeAll()">
                            <i class="fa fa-remove"></i> 删除
                        </a>
                    @endcan

                    @can('import', App\Models\SysUser::class)
                        <a class="btn btn-info" onclick="$.table.importExcel()">
                            <i class="fa fa-upload"></i> 导入
                        </a>
                    @endcan

                    @can('export', App\Models\SysUser::class)
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
	</div>

    @include('admin.layouts.footer')
    <script src="/static/ajax/libs/jquery-layout/jquery.layout-latest.js"></script>
    <script src="/static/ajax/libs/jquery-ztree/3.5/js/jquery.ztree.all-3.5.js"></script>
    <script type="text/javascript">
		var prefix = "/system/user";

		$(function() {
		    var panehHidden = false;
		    if ($(this).width() < 769) {
		        panehHidden = true;
		    }
		    $('body').layout({ initClosed: panehHidden, west__size: 185 });
		    queryUserList();
		    queryDeptTree();
		});

		function queryUserList() {
		    var options = {
		        url: prefix + "/list",
		        createUrl: prefix + "/add",
		        updateUrl: prefix + "/edit/{id}",
		        removeUrl: prefix + "/remove",
		        exportUrl: prefix + "/export",
		        importUrl: prefix + "/importData",
		        importTemplateUrl: prefix + "/importTemplate",
		        sortName: "create_time",
		        sortOrder: "desc",
		        modalName: "用户",
		        columns: [{
		            checkbox: true
		        },
		        {
		            field: 'user_id',
		            title: '用户ID'
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
		            field: 'dept.deptName',
		            title: '部门'
		        },
		        {
		            field: 'email',
		            title: '邮箱',
		            visible: false
		        },
		        {
		            field: 'phonenumber',
		            title: '手机'
		        },
		        {
		        	visible:
                        @can('update', App\Models\SysUser::class)
                            true
                        @else
                            false
                        @endcan ,
		        	title: '用户状态',
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

                        @can('update', App\Models\SysUser::class)
                            actions.push('<a class="btn btn-success btn-xs" href="javascript:void(0)" onclick="$.operate.editTab(\'' + row.user_id + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                        @endcan

                        @can('delete', App\Models\SysUser::class)
                            actions.push('<a class="btn btn-danger btn-xs" href="javascript:void(0)" onclick="$.operate.remove(\'' + row.user_id + '\')"><i class="fa fa-remove"></i>删除</a> ');
                        @endcan

                        @can('resetPwd', App\Models\SysUser::class)
                            actions.push('<a class="btn btn-info btn-xs" href="javascript:void(0)" onclick="resetPwd(\'' + row.user_id + '\')"><i class="fa fa-key"></i>重置</a>');
                        @endcan

		                return actions.join('');
		            }
		        }]
		    };
		    $.table.init(options);
		}

		function queryDeptTree()
		{
			var url = "/system/dept/treeData";
			var options = {
		        url: url,
		        expandLevel: 2,
		        onClick : zOnClick
		    };
			$.tree.init(options);

			function zOnClick(event, treeId, treeNode) {
				$("#dept_id").val(treeNode.id);
				$("#parent_id").val(treeNode.pId);
				$.table.search();
			}
		}

		$('#btnExpand').click(function() {
			$._tree.expandAll(true);
		    $(this).hide();
		    $('#btnCollapse').show();
		});

		$('#btnCollapse').click(function() {
			$._tree.expandAll(false);
		    $(this).hide();
		    $('#btnExpand').show();
		});

		$('#btnRefresh').click(function() {
			queryDeptTree();
		});

		/* 用户管理-部门 */
		function dept() {
			var url = ctx + "system/dept";
			$.modal.openTab("部门管理", url);
		}

		/* 用户管理-重置密码 */
		function resetPwd(user_id) {
		    var url = prefix + '/resetPwd/' + user_id;
		    $.modal.open("重置密码", url, '800', '300');
		}

		/* 用户状态显示 */
		function statusTools(row) {
		    if (row.status == 1) {
    			return '<i class=\"fa fa-toggle-off text-info fa-2x\" onclick="enable(\'' + row.user_id + '\')"></i> ';
    		} else {
    			return '<i class=\"fa fa-toggle-on text-info fa-2x\" onclick="disable(\'' + row.user_id + '\')"></i> ';
    		}
		}

		/* 用户管理-停用 */
		function disable(user_id) {
			$.modal.confirm("确认要停用用户吗？", function() {
				$.operate.post(prefix + "/changeStatus", { "user_id": user_id, "status": 1 });
		    })
		}

		/* 用户管理启用 */
		function enable(user_id) {
			$.modal.confirm("确认要启用用户吗？", function() {
				$.operate.post(prefix + "/changeStatus", { "user_id": user_id, "status": 0 });
		    })
		}
	</script>
</body>
<!-- 导入区域 -->
<script id="importTpl" type="text/template">
<form enctype="multipart/form-data" class="mt20 mb10">
	<div class="col-xs-offset-1">
		<input type="file" id="file" name="file"/>
		<div class="mt10 pt5">
			<input type="checkbox" id="updateSupport" name="updateSupport" title="如果登录账户已经存在，更新这条数据。"> 是否更新已经存在的用户数据
			 &nbsp;	<a onclick="$.table.importTemplate()" class="btn btn-default btn-xs"><i class="fa fa-file-excel-o"></i> 下载模板</a>
		</div>
		<font color="red" class="pull-left mt10">
			提示：仅允许导入“xls”或“xlsx”格式文件！
		</font>
	</div>
</form>
</script>
</html>
