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
				<form id="config-form">
					<div class="select-list">
						<ul>
							<li>
								参数名称：<input type="text" name="config_name"/>
							</li>
							<li>
								参数键名：<input type="text" name="config_key"/>
							</li>
							<li>
								系统内置：
                                <select name="config_type">
									<option value="">所有</option>
                                    @foreach ($dictService->getType('sys_yes_no') as $dict)
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
                @can('create', App\Models\SysConfig::class)
                    <a class="btn btn-success" onclick="$.operate.add()">
                        <i class="fa fa-plus"></i> 新增
                    </a>
                @endcan

                @can('update', App\Models\SysConfig::class)
                    <a class="btn btn-primary single disabled" onclick="$.operate.edit()">
                        <i class="fa fa-edit"></i> 修改
                    </a>
                @endcan

                @can('delete', App\Models\SysConfig::class)
                    <a class="btn btn-danger multiple disabled" onclick="$.operate.removeAll()">
                        <i class="fa fa-remove"></i> 删除
                    </a>
                @endcan

                @can('export', App\Models\SysConfig::class)
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
        var datas = @json($dictService->getType('sys_yes_no'), JSON_PRETTY_PRINT) ;
        var prefix = "/system/config";

        $(function() {
            var options = {
                url: prefix + "/list",
                createUrl: prefix + "/add",
                updateUrl: prefix + "/edit/{id}",
                removeUrl: prefix + "/remove",
                exportUrl: prefix + "/export",
                sortName: "create_time",
		        sortOrder: "desc",
                modalName: "参数",
                columns: [{
                    checkbox: true
                },
                {
                    field: 'config_id',
                    title: '参数主键'
                },
                {
                    field: 'config_name',
                    title: '参数名称',
                    formatter: function(value, row, index) {
                    	return $.table.tooltip(value);
                    }
                },
                {
                    field: 'config_key',
                    title: '参数键名',
                    formatter: function(value, row, index) {
                    	return $.table.tooltip(value);
                    }
                },
                {
                    field: 'config_value',
                    title: '参数键值'
                },
                {
                    field: 'config_type',
                    title: '系统内置',
                    align: 'center',
                    formatter: function(value, row, index) {
                    	return $.table.selectDictLabel(datas, value);
                    }
                },
                {
                    field: 'remark',
                    title: '备注',
                    align: 'center',
                    formatter: function(value, row, index) {
                    	return $.table.tooltip(value, 10, "open");
                    }
                },
                {
                    field: 'create_time',
                    title: '创建时间'
                },
                {
                    title: '操作',
                    align: 'center',
                    formatter: function(value, row, index) {
                        var actions = [];
                        @can('update', App\Models\SysConfig::class)
                            actions.push('<a class="btn btn-success btn-xs" href="javascript:void(0)" onclick="$.operate.edit(\'' + row.config_id + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                        @endcan
                        @can('delete', App\Models\SysConfig::class)
                            actions.push('<a class="btn btn-danger btn-xs" href="javascript:void(0)" onclick="$.operate.remove(\'' + row.config_id + '\')"><i class="fa fa-remove"></i>删除</a>');
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
