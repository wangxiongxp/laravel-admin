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
				<form id="post-form">
					<div class="select-list">
						<ul>
							<li>
								岗位编码：<input type="text" name="post_code"/>
							</li>
							<li>
								岗位名称：<input type="text" name="post_name"/>
							</li>
							<li>
								岗位状态：
                                <select name="status">
									<option value="">所有</option>
                                    @foreach ($dictService->getType('sys_normal_disable') as $dict)
                                        <option value="{{$dict['dict_value']}}">{{$dict['dict_label']}}</option>
                                    @endforeach
								</select>
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
                @can('create', App\Models\SysPost::class)
                    <a class="btn btn-success" onclick="$.operate.add()">
                        <i class="fa fa-plus"></i> 新增
                    </a>
                @endcan

                @can('update', App\Models\SysPost::class)
                        <a class="btn btn-primary single disabled" onclick="$.operate.edit()">
                            <i class="fa fa-edit"></i> 修改
                        </a>
                @endcan

                @can('delete', App\Models\SysPost::class)
                        <a class="btn btn-danger multiple disabled" onclick="$.operate.removeAll()">
                            <i class="fa fa-remove"></i> 删除
                        </a>
                @endcan

                @can('export', App\Models\SysPost::class)
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
		var prefix = "/system/post";

		$(function() {
		    var options = {
		        url: prefix + "/list",
		        createUrl: prefix + "/add",
		        updateUrl: prefix + "/edit/{id}",
		        removeUrl: prefix + "/remove",
		        exportUrl: prefix + "/export",
		        sortName: "post_sort",
		        modalName: "岗位",
		        columns: [{
		            checkbox: true
		        },
		        {
		            field: 'post_id',
		            title: '岗位编号'
		        },
		        {
		            field: 'post_code',
		            title: '岗位编码',
		            sortable: true
		        },
		        {
		            field: 'post_name',
		            title: '岗位名称',
		            sortable: true
		        },
		        {
		            field: 'post_sort',
		            title: '显示顺序',
		            sortable: true
		        },
		        {
		            field: 'status',
		            title: '状态',
		            align: 'center',
		            formatter: function(value, row, index) {
		            	// return $.table.selectDictLabel(datas, value);
		            	return value;
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
                        @can('update', App\Models\SysPost::class)
                            actions.push('<a class="btn btn-success btn-xs" href="javascript:void(0)" onclick="$.operate.edit(\'' + row.post_id + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                        @endcan
                        @can('delete', App\Models\SysPost::class)
                            actions.push('<a class="btn btn-danger btn-xs" href="javascript:void(0)" onclick="$.operate.remove(\'' + row.post_id + '\')"><i class="fa fa-remove"></i>删除</a>');
                        @endcan
		                return actions.join('');
		            }
		        }]
		    };
		    $.table.init(options);
		});
	</script>
</body>
</html>
