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
		        detailView: true,
				onExpandRow : function(index, row, $detail) {
					initChildTable(index, row, $detail);
				},
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

		initChildTable = function(index, row, $detail) {
			var cur_table = $detail.html('<table style="table-layout:fixed"></table>').find('table');
    	    $(cur_table).bootstrapTable({
    	        url: prefix + "/list",
    	        method: 'post',
    	        sidePagination: "server",
    	        contentType: "application/x-www-form-urlencoded",   // 编码类型
    	        queryParams : {
                    userName: '测试8'
				},
    	        columns: [{
					field : 'userId',
					title : '子表ID'
				},
				{
					field : 'userCode',
					title : '子表编号'
				},
				{
					field : 'userName',
					title : '子表姓名'
				},
				{
                    field: 'status',
                    title: '子表状态',
                    align: 'center',
                    formatter: function(value, row, index) {
                    	return $.table.selectDictLabel(datas, value);
                    }
                }]
    	    });
		};
    </script>
</body>
</html>
