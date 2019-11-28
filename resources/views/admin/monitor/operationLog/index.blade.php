@inject('dictService', 'App\Services\DictService')

<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
    <link href="/static/ajax/libs/bootstrap-select/bootstrap-select.css" rel="stylesheet"/>
</head>
<body class="gray-bg">
	<div class="container-div">
		<div class="row">
			<div class="col-sm-12 search-collapse">
				<form id="operlog-form">
					<div class="select-list">
						<ul>
							<li>
								<label>系统模块： </label><input type="text" name="title"/>
							</li>
							<li>
								<label>操作人员： </label><input type="text" name="oper_name"/>
							</li>
							<li class="select-selectpicker">
								<label>操作类型： </label>
                                <select id="businessTypes" class="selectpicker" data-none-selected-text="请选择" multiple>
                                    @foreach ($dictService->getType('sys_oper_type') as $dict)
                                        <option value="{{$dict['dict_value']}}">{{$dict['dict_label']}}</option>
                                    @endforeach
								</select>
							</li>
							<li>
								<label>操作状态：</label>
                                <select name="status">
									<option value="">所有</option>
                                    @foreach ($dictService->getType('sys_common_status') as $dict)
                                        <option value="{{$dict['dict_value']}}">{{$dict['dict_label']}}</option>
                                    @endforeach
								</select>
							</li>
							<li class="select-time">
								<label>操作时间： </label>
								<input type="text" class="time-input" id="start_time" placeholder="开始时间" name="start_time"/>
								<span>-</span>
								<input type="text" class="time-input" id="end_time" placeholder="结束时间" name="end_time"/>
							</li>
							<li>
								<a class="btn btn-primary btn-rounded btn-sm" onclick="searchPre()"><i class="fa fa-search"></i>&nbsp;搜索</a>
								<a class="btn btn-warning btn-rounded btn-sm" onclick="resetPre()"><i class="fa fa-refresh"></i>&nbsp;重置</a>
							</li>
						</ul>
					</div>
				</form>
			</div>

			<div class="btn-group-sm" id="toolbar" role="group">
				<a class="btn btn-danger multiple disabled" onclick="$.operate.removeAll()" shiro:hasPermission="monitor:operlog:remove">
		            <i class="fa fa-remove"></i> 删除
		        </a>
		        <a class="btn btn-danger" onclick="$.operate.clean()" shiro:hasPermission="monitor:operlog:remove">
	                <i class="fa fa-trash"></i> 清空
	            </a>
	            <a class="btn btn-warning" onclick="$.table.exportExcel()" shiro:hasPermission="monitor:operlog:export">
		            <i class="fa fa-download"></i> 导出
		        </a>
	        </div>

			<div class="col-sm-12 select-table table-striped">
				<table id="bootstrap-table"></table>
			</div>
		</div>
	</div>
    @include('admin.layouts.footer')
    <script src="/static/ajax/libs/bootstrap-select/bootstrap-select.js"></script>
    <script type="text/javascript">
		// var detailFlag = [[${@permission.hasPermi('monitor:operlog:detail')}]];
        var datas = @json($dictService->getType('sys_oper_type'), JSON_PRETTY_PRINT) ;
        var detailFlag = '';
		var prefix =  "/monitor/operationLog";

		$(function() {
		    var options = {
		        url: prefix + "/list",
		        cleanUrl: prefix + "/clean",
		        detailUrl: prefix + "/detail/{id}",
		        removeUrl: prefix + "/remove",
		        exportUrl: prefix + "/export",
		        sortName: "oper_time",
		        sortOrder: "desc",
		        modalName: "操作日志",
		        escape: true,
		        showPageGo: true,
		        rememberSelected: true,
		        columns: [{
		        	field: 'state',
		            checkbox: true
		        },
		        {
		            field: 'oper_id',
		            title: '日志编号'
		        },
		        {
		            field: 'title',
		            title: '系统模块'
		        },
		        {
		            field: 'business_type',
		            title: '操作类型',
		            align: 'center',
		            formatter: function(value, row, index) {
		            	return $.table.selectDictLabel(datas, value);
		            }
		        },
		        {
		            field: 'oper_name',
		            title: '操作人员',
		            sortable: true
		        },
		        {
		            field: 'dept_name',
		            title: '部门名称'
		        },
		        {
		            field: 'oper_ip',
		            title: '主机'
		        },
		        {
		            field: 'oper_location',
		            title: '操作地点'
		        },
		        {
		            field: 'status',
		            title: '操作状态',
		            align: 'center',
		            formatter: function(value, row, index) {
		                if (value == 0) {
		                    return '<span class="badge badge-primary">成功</span>';
		                } else if (value == 1) {
		                    return '<span class="badge badge-danger">失败</span>';
		                }
		            }
		        },
		        {
		            field: 'oper_time',
		            title: '操作时间',
		            sortable: true
		        },
		        {
		            title: '操作',
		            align: 'center',
		            formatter: function(value, row, index) {
		                var actions = [];
		                actions.push('<a class="btn btn-warning btn-xs ' + detailFlag + '" href="javascript:void(0)" onclick="$.operate.detail(\'' + row.oper_id + '\')"><i class="fa fa-search"></i>详细</a>');
		                return actions.join('');
		            }
		        }]
		    };
		    $.table.init(options);
		});

		function searchPre() {
		    var data = {};
		    data.businessTypes = $.common.join($('#businessTypes').selectpicker('val'));
		    $.table.search('operlog-form', 'bootstrap-table', data);
		}

		function resetPre() {
			$.form.reset();
			$("#businessTypes").selectpicker('refresh');
		}
	</script>
</body>
</html>
