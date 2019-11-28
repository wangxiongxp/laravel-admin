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
				<form id="logininfor-form">
					<div class="select-list">
						<ul>
							<li>
								<label>登录地址：</label><input type="text" name="ipaddr"/>
							</li>
							<li>
								<label>登录名称：</label><input type="text" name="login_name"/>
							</li>
							<li>
								<label>登录状态：</label>
                                <select name="status">
									<option value="">所有</option>
                                    @foreach ($dictService->getType('sys_common_status') as $dict)
                                        <option value="{{$dict['dict_value']}}">{{$dict['dict_label']}}</option>
                                    @endforeach
								</select>
							</li>
							<li class="select-time">
								<label>登录时间： </label>
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
				<a class="btn btn-danger multiple disabled" onclick="$.operate.removeAll()" shiro:hasPermission="monitor:logininfor:remove">
		            <i class="fa fa-remove"></i> 删除
		        </a>
		        <a class="btn btn-danger" onclick="$.operate.clean()" shiro:hasPermission="monitor:logininfor:remove">
	                <i class="fa fa-trash"></i> 清空
	            </a>
				<a class="btn btn-primary single disabled" onclick="unlock()" shiro:hasPermission="monitor:logininfor:unlock">
					<i class="fa fa-unlock"></i> 解锁
				</a>
	            <a class="btn btn-warning" onclick="$.table.exportExcel()" shiro:hasPermission="monitor:logininfor:export">
		            <i class="fa fa-download"></i> 导出
		        </a>
	        </div>

	        <div class="col-sm-12 select-table table-striped">
			    <table id="bootstrap-table"></table>
			</div>
		</div>
	</div>

    @include('admin.layouts.footer')
    <script type="text/javascript">
        var datas = @json($dictService->getType('sys_common_status'), JSON_PRETTY_PRINT) ;
		var prefix = "/monitor/loginInfo";

		$(function() {
		    var options = {
		        url: prefix + "/list",
		        cleanUrl: prefix + "/clean",
		        removeUrl: prefix + "/remove",
		        exportUrl: prefix + "/export",
		        sortName: "login_time",
		        sortOrder: "desc",
		        modalName: "登录日志",
		        escape: true,
		        showPageGo: true,
		        rememberSelected: true,
		        columns: [{
		        	field: 'state',
		            checkbox: true
		        },
		        {
		            field: 'info_id',
		            title: '访问编号'
		        },
		        {
		            field: 'login_name',
		            title: '登录名称',
		            sortable: true
		        },
		        {
		            field: 'ipaddr',
		            title: '登录地址'
		        },
		        {
		            field: 'login_location',
		            title: '登录地点'
		        },
		        {
		            field: 'browser',
		            title: '浏览器'
		        },
		        {
		            field: 'os',
		            title: '操作系统'
		        },
		        {
		            field: 'status',
		            title: '登录状态',
		            align: 'center',
		            formatter: function(value, row, index) {
		            	return $.table.selectDictLabel(datas, value);
		            }
		        },
		        {
		            field: 'msg',
		            title: '操作信息'
		        },
		        {
		            field: 'login_time',
		            title: '登录时间',
		            sortable: true
		        }]
		    };
		    $.table.init(options);
		});

		function unlock() {
            $.operate.post(prefix + "/unlock?login_name=" + $.table.selectColumns("login_name"));
        }
	</script>
</body>
</html>
