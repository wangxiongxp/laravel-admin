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
				<form id="dept-form">
					<div class="select-list">
						<ul>
							<li>
								部门名称：<input type="text" name="dept_name"/>
							</li>
							<li>
								部门状态：
                                <select name="status">
									<option value="">所有</option>
                                    @foreach ($dictService->getType('sys_normal_disable') as $dict)
                                        <option value="{{$dict['dict_value']}}">{{$dict['dict_label']}}</option>
                                    @endforeach
								</select>
							</li>
							<li>
								<a class="btn btn-primary btn-rounded btn-sm" onclick="$.treeTable.search()"><i class="fa fa-search"></i>&nbsp;搜索</a>
								<a class="btn btn-warning btn-rounded btn-sm" onclick="$.form.reset()"><i class="fa fa-refresh"></i>&nbsp;重置</a>
							</li>
						</ul>
					</div>
				</form>
			</div>

            <div class="btn-group-sm" id="toolbar" role="group">
                @can('create', App\Models\SysDept::class)
                    <a class="btn btn-success" onclick="$.operate.add(100)">
                        <i class="fa fa-plus"></i> 新增
                    </a>
                @endcan

                @can('update', App\Models\SysDept::class)
                    <a class="btn btn-primary" onclick="$.operate.edit()">
                        <i class="fa fa-edit"></i> 修改
                    </a>
                @endcan

                <a class="btn btn-info" id="expandAllBtn">
                    <i class="fa fa-exchange"></i> 展开/折叠
                </a>
	        </div>
       		 <div class="col-sm-12 select-table table-striped">
	            <table id="bootstrap-tree-table"></table>
	        </div>
	    </div>
	</div>
    @include('admin.layouts.footer')
    <script type="text/javascript">
        var datas = @json($dictService->getType('sys_normal_disable'), JSON_PRETTY_PRINT) ;
		var prefix = "/system/dept"

		$(function() {
		    var options = {
		        code: "dept_id",
		        parentCode: "parent_id",
		        uniqueId: "dept_id",
		        url: prefix + "/list",
		        createUrl: prefix + "/add/{id}",
		        updateUrl: prefix + "/edit/{id}",
		        removeUrl: prefix + "/remove/{id}",
		        modalName: "部门",
		        columns: [{
                    field: 'selectItem',
                    radio: true
                 },
                 {
		            field: 'dept_name',
		            title: '部门名称',
		            align: "left"
		        },
		        {
		            field: 'order_num',
		            title: '排序',
		            align: "left"
		        },
		        {
		            field: 'status',
		            title: '状态',
		            align: "left",
		            formatter: function(value, item, index) {
		            	return $.table.selectDictLabel(datas, item.status);
		            }
		        },
		        {
		            field: 'create_time',
		            title: '创建时间',
		            align: "left"
		        },
		        {
		            title: '操作',
		            align: 'left',
		            formatter: function(value, row, index) {
		                if (row.parent_id != 0) {
		                    var actions = [];
                            @can('update', App\Models\SysDept::class)
                                actions.push('<a class="btn btn-success btn-xs ' + editFlag + '" href="javascript:void(0)" onclick="$.operate.edit(\'' + row.dept_id + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                            @endcan
                            @can('create', App\Models\SysDept::class)
                                actions.push('<a class="btn btn-info  btn-xs ' + addFlag + '" href="javascript:void(0)" onclick="$.operate.add(\'' + row.dept_id + '\')"><i class="fa fa-plus"></i>新增</a> ');
                            @endcan
                            @can('delete', App\Models\SysDept::class)
                                actions.push('<a class="btn btn-danger btn-xs ' + removeFlag + '" href="javascript:void(0)" onclick="$.operate.remove(\'' + row.dept_id + '\')"><i class="fa fa-trash"></i>删除</a>');
                            @endcan
		                    return actions.join('');
		                } else {
		                    return "";
		                }
		            }
		        }]
		    };
		    $.treeTable.init(options);
		});
	</script>
</body>
</html>
