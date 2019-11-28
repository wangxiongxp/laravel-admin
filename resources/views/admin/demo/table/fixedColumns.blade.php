@inject('dictService', 'App\Services\DictService')

<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
</head>
<body class="gray-bg">
     <div class="container-div">
		<div class="row">
			<div class="btn-group-sm" id="toolbar" role="group">
				<a class="btn btn-success">
	                <i class="fa fa-plus"></i> 新增
	            </a>
				<a class="btn btn-primary single disabled">
		            <i class="fa fa-edit"></i> 修改
		        </a>
				<a class="btn btn-danger multiple disabled">
		            <i class="fa fa-remove"></i> 删除
		        </a>
	        </div>
			<div class="col-sm-12 select-table table-striped">
				<table id="bootstrap-table"></table>
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
		        fixedColumns: true,
    		    fixedNumber: 3,
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
				    field : 'userBalance',
				    title : '测试1'
				},
				{
				    field : 'userBalance',
				    title : '测试2'
				},
				{
				    field : 'userBalance',
				    title : '测试3'
				},
				{
				    field : 'userBalance',
				    title : '测试4'
				},
				{
				    field : 'userBalance',
				    title : '测试5'
				},
				{
				    field : 'userBalance',
				    title : '测试6'
				},
				{
				    field : 'userBalance',
				    title : '测试7'
				},
				{
				    field : 'userBalance',
				    title : '测试8'
				},
				{
				    field : 'userBalance',
				    title : '测试9'
				},
				{
				    field : 'userBalance',
				    title : '测试10'
				},
				{
				    field : 'userBalance',
				    title : '测试11'
				},
				{
				    field : 'userBalance',
				    title : '测试12'
				},
				{
				    field : 'userBalance',
				    title : '测试13'
				},
				{
				    field : 'userBalance',
				    title : '测试14'
				},
				{
				    field : 'userBalance',
				    title : '测试15'
				},
				{
				    field : 'userBalance',
				    title : '测试16'
				}]
            };
            $.table.init(options);
        });
    </script>
</body>
</html>
