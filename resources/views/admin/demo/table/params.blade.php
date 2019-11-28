@inject('dictService', 'App\Services\DictService')

<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
</head>
<body class="gray-bg">
     <div class="container-div">
		<div class="row">
			<div class="col-sm-12 select-table table-striped">
				<p class="select-title">通过queryParams方法设置</p>
				<table id="bootstrap-table"></table>
			</div>
			<div class="col-sm-12 search-collapse">
				<form id="post-form">
					<div class="select-list">
						<ul>
							<li>
								用户姓名：<input type="text" name="userName" value="测试6"/>
							</li>
						</ul>
					</div>
				</form>
			</div>
			<div class="col-sm-12 select-table table-striped">
				<p class="select-title">通过form自动填充</p>
				<table id="bootstrap-table-form"></table>
			</div>
		</div>
	</div>
     @include('admin.layouts.footer')
    <script type="text/javascript">
        var prefix = "/demo/table";
        var datas = @json($dictService->getType('sys_normal_disable'), JSON_PRETTY_PRINT) ;

        $(function() {
            var options = {
                url: prefix + "/list",
		        showSearch: false,
		        showRefresh: false,
		        showToggle: false,
		        showColumns: false,
		        queryParams: queryParams,
                columns: [{
		            checkbox: true
		        },
				{
					field : 'userId',
					title : '用户ID'
				},
				{
					field : 'userCode',
					title : '用户编号'
				},
				{
					field : 'userName',
					title : '用户姓名'
				},
				{
					field : 'userPhone',
					title : '用户手机'
				},
				{
					field : 'userEmail',
					title : '用户邮箱'
				},
				{
				    field : 'userBalance',
				    title : '用户余额'
				},
				{
                    field: 'status',
                    title: '用户状态',
                    align: 'center',
                    formatter: function(value, row, index) {
                    	return $.table.selectDictLabel(datas, value);
                    }
                },
		        {
		            title: '操作',
		            align: 'center',
		            formatter: function(value, row, index) {
		            	var actions = [];
		            	actions.push('<a class="btn btn-success btn-xs" href="#"><i class="fa fa-edit"></i>编辑</a> ');
                        actions.push('<a class="btn btn-danger btn-xs" href="#"><i class="fa fa-remove"></i>删除</a>');
						return actions.join('');
		            }
		        }]
            };
            $.table.init(options);
        });

        function queryParams(params) {
            var search = $.table.queryParams(params);
            search.userName = '测试1';
            return search;
        }

        $(function() {
            var options = {
            	id: "bootstrap-table-form",
                url: prefix + "/list",
		        showSearch: false,
		        showRefresh: false,
		        showToggle: false,
		        showColumns: false,
                columns: [{
		            checkbox: true
		        },
				{
					field : 'userId',
					title : '用户ID'
				},
				{
					field : 'userCode',
					title : '用户编号'
				},
				{
					field : 'userName',
					title : '用户姓名'
				},
				{
					field : 'userPhone',
					title : '用户手机'
				},
				{
					field : 'userEmail',
					title : '用户邮箱'
				},
				{
				    field : 'userBalance',
				    title : '用户余额'
				},
				{
                    field: 'status',
                    title: '用户状态',
                    align: 'center',
                    formatter: function(value, row, index) {
                    	return $.table.selectDictLabel(datas, value);
                    }
                },
		        {
		            title: '操作',
		            align: 'center',
		            formatter: function(value, row, index) {
		            	var actions = [];
		            	actions.push('<a class="btn btn-success btn-xs" href="#"><i class="fa fa-edit"></i>编辑</a> ');
                        actions.push('<a class="btn btn-danger btn-xs" href="#"><i class="fa fa-remove"></i>删除</a>');
						return actions.join('');
		            }
		        }]
            };
            $.table.init(options);
        });
    </script>
</body>
</html>
