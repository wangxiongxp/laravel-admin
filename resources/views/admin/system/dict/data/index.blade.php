@inject('dictService', 'App\Services\DictService')

<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
    <link href="/static/ajax/libs/select2/select2.min.css" rel="stylesheet"/>
    <link href="/static/ajax/libs/select2/select2-bootstrap.css" rel="stylesheet"/>
</head>
<body class="gray-bg">
	<div class="container-div">
		<div class="row">
			<div class="col-sm-12 search-collapse">
				<form id="data-form">
					<div class="select-list">
						<ul>
						    <li>
								字典名称：
                                <select id="dict_type" name="dict_type" class="form-control">
                                    @foreach ($dict_list as $item)
                                        <option value="{{$item['dict_type']}}" {{$item['dict_type']==$dict['dict_type']?'selected':''}}>{{$item['dict_name']}}</option>
                                    @endforeach
								</select>
							</li>
							<li>
								字典标签：<input type="text" name="dict_label"/>
							</li>
							<li>
								数据状态：
                                <select name="status">
                                    <option value="">所有</option>
                                    @foreach ($dictService->getType('sys_normal_disable') as $item)
                                        <option value="{{$item['dict_value']}}">{{$item['dict_label']}}</option>
                                    @endforeach
                                </select>
							</li>
							<li>
								<a class="btn btn-primary btn-rounded btn-sm" onclick="$.table.search()"><i class="fa fa-search"></i>&nbsp;搜索</a>
							    <a class="btn btn-warning btn-rounded btn-sm" onclick="resetPre()"><i class="fa fa-refresh"></i>&nbsp;重置</a>
							</li>
						</ul>
					</div>
				</form>
			</div>

	       <div class="btn-group-sm" id="toolbar" role="group">
               @can('create', App\Models\SysDictType::class)
                   <a class="btn btn-success" onclick="add()">
                       <i class="fa fa-plus"></i> 新增
                   </a>
               @endcan

               @can('update', App\Models\SysDictType::class)
                   <a class="btn btn-primary single disabled" onclick="$.operate.edit()">
                       <i class="fa fa-edit"></i> 修改
                   </a>
               @endcan

               @can('delete', App\Models\SysDictType::class)
                   <a class="btn btn-danger multiple disabled" onclick="$.operate.removeAll()">
                       <i class="fa fa-remove"></i> 删除
                   </a>
               @endcan

               @can('export', App\Models\SysDictType::class)
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
    <script src="/static/ajax/libs/select2/select2.min.js"></script>
    <script type="text/javascript">
        var datas = @json($dictService->getType('sys_normal_disable'), JSON_PRETTY_PRINT) ;
		var prefix = "/system/dict/data";

		$(function() {
			var options = {
				url: prefix + "/list",
				createUrl: prefix + "/add/{id}",
				updateUrl: prefix + "/edit/{id}",
				removeUrl: prefix + "/remove",
				exportUrl: prefix + "/export",
				queryParams: queryParams,
				sortName: "create_time",
		        sortOrder: "desc",
				modalName: "数据",
				columns: [{
						checkbox: true
					},
					{
						field: 'dict_code',
						title: '字典编码'
					},
					{
						field: 'dict_label',
						title: '字典标签'
					},
					{
						field: 'dict_value',
						title: '字典键值'
					},
					{
						field: 'dict_sort',
						title: '字典排序'
					},
					{
						field: 'status',
						title: '状态',
						align: 'center',
						formatter: function(value, row, index) {
							return $.table.selectDictLabel(datas, value);
						}
					},
					{
						field: 'remark',
						title: '备注'
					},
					{
						field: 'create_time',
						title: '创建时间',
						sortable: true
					},
					{
						title: '操作',
						align: 'center',
						formatter: function(value, row, index) {
							var actions = [];
                            @can('update', App\Models\SysDictType::class)
                                actions.push('<a class="btn btn-success btn-xs" href="javascript:void(0)" onclick="$.operate.edit(\'' + row.dict_code + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                            @endcan
                            @can('delete', App\Models\SysDictType::class)
                                actions.push('<a class="btn btn-danger btn-xs" href="javascript:void(0)" onclick="$.operate.remove(\'' + row.dict_code + '\')"><i class="fa fa-remove"></i>删除</a>');
                            @endcan
							return actions.join('');
						}
					}]
				};
			$.table.init(options);
		});

		function queryParams(params) {
			var search = $.table.queryParams(params);
			search.dict_type = $("#dict_type").val();
			return search;
		}

		/*字典数据-新增字典*/
		function add() {
		    var dict_type = $("#dict_type option:selected").val();
		    $.operate.add(dict_type);
		}

		function resetPre() {
			$.form.reset();
			$("#dict_type").val($("#dict_type").val()).trigger("change");
		}
	</script>
</body>
</html>
