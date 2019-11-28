<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
</head>
<body class="gray-bg">
     <div class="container-div">
        <div class="btn-group-sm" id="toolbar" role="group">
	        <a class="btn btn-success" onclick="insertRow()">
	            <i class="fa fa-plus"></i> 新增行
	        </a>
	        <a class="btn btn-danger multiple disabled" onclick="removeRow()">
	            <i class="fa fa-remove"></i> 删除选择行
	        </a>
	        <a class="btn btn-danger" onclick="removeRowByUniqueId()">
	            <i class="fa fa-remove"></i> 根据值删除行
	        </a>
	        <a class="btn btn-danger" onclick="removeRowAll()">
	            <i class="fa fa-remove"></i> 删除所有行
	        </a>
	        <a class="btn btn-info" onclick="updateRow()">
	            <i class="fa fa-edit"></i> 修改行
	        </a>
	        <a class="btn btn-info" onclick="updateRowByUniqueId()">
	            <i class="fa fa-edit"></i> 根据值修改行
	        </a>
	        <a class="btn btn-info" onclick="getSelections()">
	            <i class="fa fa-search"></i> 查询选择数据
	        </a>
	        <a class="btn btn-info" onclick="getRowByUniqueId()">
	            <i class="fa fa-search"></i> 根据值查询行
	        </a>
	        <a class="btn btn-primary" onclick="getData()">
	            <i class="fa fa-search"></i> 查询所有数据
	        </a>
        </div>
		<div class="row">
			<div class="col-sm-12 select-table table-striped">
				<table id="bootstrap-table"></table>
			</div>
		</div>
	</div>
     @include('admin.layouts.footer')
    <script type="text/javascript">
        var prefix = "/demo/table";

        $(function() {
            var options = {
                url: prefix + "/list",
		        showSearch: false,
		        showRefresh: false,
		        showToggle: false,
		        showColumns: false,
		        pagination: true,
		        uniqueId: "userId",
		        height: 400,
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
				}]
            };
            $.table.init(options);
        });

        /* 新增表格行 */
        function insertRow(){
        	var randomId = 100 + ~~(Math.random() * 100)
        	$("#" + table.options.id).bootstrapTable('insertRow', {
        		index: 0, // 你想插入到哪，0表示第一行
                row: {
                	userId: randomId,
                	userCode: 2000000 + randomId,
                	userName: '测试' + randomId,
                	userPhone: '1588888888',
                	userEmail: 'ry1@qq.com',
                	userBalance: 10 + randomId,
                }
        	})
        }

        /* 删除指定表格行 */
        function removeRow(){
        	var ids = $.table.selectColumns("userId");
        	if (ids.length == 0) {
    			$.modal.alertWarning("请至少选择一条记录");
    			return;
    		}
        	$("#" + table.options.id).bootstrapTable('remove', {
        	    field: 'userId',
        	    values: ids
        	})
        }

        /* 删除行ID值为1的数据 */
        function removeRowByUniqueId(){
        	$("#" + table.options.id).bootstrapTable('removeByUniqueId', 1)
        }

        /* 删除所有表格行 */
        function removeRowAll(){
        	$("#" + table.options.id).bootstrapTable('removeAll')
        }

        /* 修改表格行 */
        function updateRow(){
        	var randomId = 100 + ~~(Math.random() * 100)
        	$("#" + table.options.id).bootstrapTable('updateRow', {
        		index: 0, // 你想修改哪行，0表示第一行
                row: {
                	userId: randomId,
                	userCode: 3000000 + randomId,
                	userName: '测试' + randomId,
                	userPhone: '1599999999',
                	userEmail: 'ry2@qq.com',
                	userBalance: 50 + randomId,
                }
        	})
        }

        /* 修改行ID值为1的数据 */
        function updateRowByUniqueId(){
        	var randomId = 100 + ~~(Math.random() * 100)
        	$("#" + table.options.id).bootstrapTable('updateByUniqueId', {
        		id: 1,
                row: {
                	userId: randomId,
                	userCode: 3000000 + randomId,
                	userName: '测试' + randomId,
                	userPhone: '1599999999',
                	userEmail: 'ry2@qq.com',
                	userBalance: 50 + randomId,
                }
        	})
        }

        /* 查询表格所有数据值 */
        function getData(){
        	var data = $("#" + table.options.id).bootstrapTable('getData');
            alert(JSON.stringify(data))
        }

        /* 查询行ID值为1的数据 */
        function getRowByUniqueId(){
        	var data = $("#" + table.options.id).bootstrapTable('getRowByUniqueId', 1);
            alert(JSON.stringify(data))
        }

        /* 查询表格选择行数据值 */
        function getSelections(){
        	var data = $("#" + table.options.id).bootstrapTable('getSelections');
        	alert(JSON.stringify(data))
        }
    </script>
</body>
</html>
