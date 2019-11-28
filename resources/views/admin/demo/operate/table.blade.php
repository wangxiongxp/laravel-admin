@inject('dictService', 'App\Services\DictService')

<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
</head>
<body class="gray-bg">
     <div class="container-div">
     	<div class="btn-group-sm" id="toolbar" role="group">
	        <a class="btn btn-success" onclick="$.operate.add()">
	            <i class="fa fa-plus"></i> 新增
	        </a>
	        <a class="btn btn-primary single disabled" onclick="$.operate.edit()">
	            <i class="fa fa-edit"></i> 修改
	        </a>
	        <a class="btn btn-danger multiple disabled" onclick="$.operate.removeAll()">
	            <i class="fa fa-remove"></i> 删除
	        </a>
	        <a class="btn btn-info" onclick="$.table.importExcel()">
	            <i class="fa fa-upload"></i> 导入
	        </a>
	        <a class="btn btn-warning" onclick="$.table.exportExcel()">
	            <i class="fa fa-download"></i> 导出
	        </a>
	        <a class="btn btn-info single disabled" onclick="$.operate.detail()">
	            <i class="fa fa-search"></i> 详细
	        </a>
	        <a class="btn btn-danger" onclick="$.operate.clean()">
	            <i class="fa fa-trash"></i> 清空
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
        var prefix = "/demo/operate";
        var datas = @json($dictService->getType('sys_normal_disable'), JSON_PRETTY_PRINT) ;

        $(function() {
            var options = {
                url: prefix + "/list",
                createUrl: prefix + "/add",
                updateUrl: prefix + "/edit/{id}",
                removeUrl: prefix + "/remove",
                exportUrl: prefix + "/export",
                importUrl: prefix + "/importData",
                importTemplateUrl: prefix + "/importTemplate",
                detailUrl: prefix + "/detail/{id}",
                cleanUrl: prefix + "/clean",
		        showSearch: false,
		        showRefresh: false,
		        showToggle: false,
		        showColumns: false,
		        search: true,
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
		            	actions.push('<a class="btn btn-success btn-xs" href="#" onclick="$.operate.edit(\'' + row.userId + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                        actions.push('<a class="btn btn-info btn-xs" href="#" onclick="$.operate.detail(\'' + row.userId + '\')"><i class="fa fa-search"></i>详细</a> ');
                        actions.push('<a class="btn btn-danger btn-xs" href="#" onclick="$.operate.remove(\'' + row.userId + '\')"><i class="fa fa-remove"></i>删除</a>');
						return actions.join('');
		            }
		        }]
            };
            $.table.init(options);
        });
    </script>
</body>
<!-- 导入区域 -->
<script id="importTpl" type="text/template">
<form enctype="multipart/form-data" class="mt20 mb10">
	<div class="col-xs-offset-1">
		<input type="file" id="file" name="file"/>
		<div class="mt10 pt5">
			<input type="checkbox" id="updateSupport" name="updateSupport" title="如果登录账户已经存在，更新这条数据。"> 是否更新已经存在的用户数据
			 &nbsp;	<a onclick="$.table.importTemplate()" class="btn btn-default btn-xs"><i class="fa fa-file-excel-o"></i> 下载模板</a>
		</div>
		<font color="red" class="pull-left mt10">
			提示：仅允许导入“xls”或“xlsx”格式文件！
		</font>
	</div>
</form>
</script>
</html>
