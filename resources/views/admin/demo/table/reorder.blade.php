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
			    <p class="select-title">按住表格拖拽</p>
				<table id="bootstrap-table"
				 data-use-row-attr-func="true"
				 data-reorderable-rows="true"></table>
			</div>
		</div>
	</div>
     @include('admin.layouts.footer')
     <script src="/static/ajax/libs/bootstrap-table/extensions/reorder/bootstrap-table-reorder.js"></script>
     <script src="/static/ajax/libs/bootstrap-table/extensions/reorder/jquery.tablednd.js"></script>
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
		        onReorderRow: function (data) {
		        	 //当拖拽结束后，data为整个表格的数据
		            console.log('拖拽结束' + JSON.stringify(data))
		            return false;
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
                }]
            };
            $.table.init(options);
        });
    </script>
</body>
</html>
