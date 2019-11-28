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
                <form id="form1">
                    <div class="select-list">
                        <ul>
						    <li>
								用户名称：<input type="text" name="userName"/>
							</li>
							<li>
								<a class="btn btn-primary btn-rounded btn-sm" onclick="$.table.search('form1', 'bootstrap-table1')"><i class="fa fa-search"></i>&nbsp;搜索</a>
							    <a class="btn btn-warning btn-rounded btn-sm" onclick="$.form.reset('form1', 'bootstrap-table1')"><i class="fa fa-refresh"></i>&nbsp;重置</a>
							</li>
						</ul>
					</div>
				</form>
			</div>
            <div class="btn-group-sm" id="toolbar1" role="group">
                <a class="btn btn-success" onclick="options1()">
	                <i class="fa fa-search"></i> options
	            </a>
	            <a class="btn btn-success" onclick="$.operate.add()">
	                <i class="fa fa-plus"></i> 新增
	            </a>
	            <a class="btn btn-primary single disabled" onclick="$.operate.edit()">
	                <i class="fa fa-edit"></i> 修改
	            </a>
	            <a class="btn btn-danger multiple disabled" onclick="$.operate.removeAll()">
	                <i class="fa fa-remove"></i> 删除
	            </a>
            </div>
			<div class="col-sm-12 select-table table-striped">
				<table id="bootstrap-table1"></table>
			</div>
		</div>
	</div>
	<div class="container-div">
        <div class="row">
            <div class="col-sm-12 search-collapse">
                <form id="form2">
                    <div class="select-list">
                        <ul>
                            <li>
								用户名称：<input type="text" name="userName"/>
							</li>
							<li>
								<a class="btn btn-primary btn-rounded btn-sm" onclick="$.table.search('form2', 'bootstrap-table2')"><i class="fa fa-search"></i>&nbsp;搜索</a>
							    <a class="btn btn-warning btn-rounded btn-sm" onclick="$.form.reset('form2', 'bootstrap-table2')"><i class="fa fa-refresh"></i>&nbsp;重置</a>
							</li>
						</ul>
					</div>
				</form>
			</div>
            <div class="btn-group-sm" id="toolbar2" role="group">
                <a class="btn btn-success" onclick="options2()">
	                <i class="fa fa-search"></i> options
	            </a>
	            <a class="btn btn-success" onclick="$.operate.add()">
	                <i class="fa fa-plus"></i> 新增
	            </a>
	            <a class="btn btn-primary single disabled" onclick="$.operate.edit()">
	                <i class="fa fa-edit"></i> 修改
	            </a>
	            <a class="btn btn-danger multiple disabled" onclick="$.operate.removeAll()">
	                <i class="fa fa-remove"></i> 删除
	            </a>
            </div>
			<div class="col-sm-12 select-table table-striped">
				<table id="bootstrap-table2"></table>
			</div>
		</div>
	</div>
    @include('admin.layouts.footer')
    <script type="text/javascript">
        var prefix = "/demo/operate";
        var datas = @json($dictService->getType('sys_normal_disable'), JSON_PRETTY_PRINT) ;

        $(function() {
            var options = {
            	id: "bootstrap-table1",
            	toolbar: "toolbar1",
                url: prefix + "/list",
                createUrl: prefix + "/add",
                removeUrl: prefix + "/remove",
                updateUrl: prefix + "/edit/{id}",
		        modalName: "用户",
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
		            	actions.push('<a class="btn btn-success btn-xs" href="###" onclick="$.operate.edit(\'' + row.userId + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                        actions.push('<a class="btn btn-danger btn-xs" href="###" onclick="$.operate.remove(\'' + row.userId + '\')"><i class="fa fa-remove"></i>删除</a>');
						return actions.join('');
		            }
		        }]
            };
            $.table.init(options);
        });

        $(function() {
            var options = {
            	id: "bootstrap-table2",
            	toolbar: "toolbar2",
                url: prefix + "/list",
                createUrl: prefix + "/add",
                removeUrl: prefix + "/remove",
                updateUrl: prefix + "/edit/{id}",
		        modalName: "用户",
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
		            	actions.push('<a class="btn btn-success btn-xs" href="###" onclick="$.operate.edit(\'' + row.userId + '\')"><i class="fa fa-edit"></i>编辑</a> ');
		            	actions.push('<a class="btn btn-danger btn-xs" href="###" onclick="$.operate.remove(\'' + row.userId + '\')"><i class="fa fa-remove"></i>删除</a>');
						return actions.join('');
		            }
		        }]
            };
            $.table.init(options);
        });

        function options1() {
        	var temp = "";
        	var obj = table.config['bootstrap-table1'];
        	for (var i in obj) {
        	    temp += i + ":" + obj[i] + "<br/>";
        	}
        	$.modal.alert(temp);
        }

        function options2() {
        	var temp = "";
        	var obj = table.config['bootstrap-table2'];
        	for (var i in obj) {
        	    temp += i + ":" + obj[i] + "<br/>";
        	}
        	$.modal.alert(temp);
        }
    </script>
</body>
</html>
