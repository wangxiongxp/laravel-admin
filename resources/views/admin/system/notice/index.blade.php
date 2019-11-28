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
				<form id="notice-form">
					<div class="select-list">
						<ul>
							<li>
								公告标题：<input type="text" name="notice_title"/>
							</li>
							<li>
								操作人员：<input type="text" name="create_by"/>
							</li>
							<li>
								公告类型：
                                <select name="noticeType">
									<option value="">所有</option>
                                    @foreach ($dictService->getType('sys_notice_type') as $dict)
                                        <option value="{{$dict['dict_value']}}">{{$dict['dict_label']}}</option>
                                    @endforeach
								</select>
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
                @can('create', App\Models\SysNotice::class)
                    <a class="btn btn-success" onclick="$.operate.addFull()">
                        <i class="fa fa-plus"></i> 新增
                    </a>
                @endcan

                @can('update', App\Models\SysNotice::class)
                    <a class="btn btn-primary single disabled" onclick="$.operate.editFull()">
                        <i class="fa fa-edit"></i> 修改
                    </a>
                @endcan

                @can('delete', App\Models\SysNotice::class)
                    <a class="btn btn-danger multiple disabled" onclick="$.operate.removeAll()">
                        <i class="fa fa-remove"></i> 删除
                    </a>
                @endcan
	        </div>

	        <div class="col-sm-12 select-table table-striped">
	            <table id="bootstrap-table"></table>
	        </div>
    	</div>
    </div>
    @include('admin.layouts.footer')
    <script type="text/javascript">
        var types = @json($dictService->getType('sys_notice_type'), JSON_PRETTY_PRINT) ;
        var datas = @json($dictService->getType('sys_notice_status'), JSON_PRETTY_PRINT) ;
        var prefix = "/system/notice";

        $(function() {
            var options = {
                url: prefix + "/list",
                createUrl: prefix + "/add",
                updateUrl: prefix + "/edit/{id}",
                removeUrl: prefix + "/remove",
                modalName: "公告",
                columns: [{
		            checkbox: true
		        },
				{
					field : 'notice_id',
					title : '序号'
				},
				{
					field : 'notice_title',
					title : '公告标题'
				},
				{
		            field: 'notice_type',
		            title: '公告类型',
		            align: 'center',
		            formatter: function(value, row, index) {
		            	return $.table.selectDictLabel(types, value);
		            }
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
					field : 'create_by',
					title : '创建者'
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
                        @can('update', App\Models\SysNotice::class)
                            actions.push('<a class="btn btn-success btn-xs" href="javascript:void(0)" onclick="$.operate.editFull(\'' + row.notice_id + '\')"><i class="fa fa-edit"></i>编辑</a> ');
                        @endcan
                        @can('delete', App\Models\SysNotice::class)
                            actions.push('<a class="btn btn-danger btn-xs" href="javascript:void(0)" onclick="$.operate.remove(\'' + row.notice_id + '\')"><i class="fa fa-remove"></i>删除</a>');
                        @endcan
		            	return actions.join('');
		            }
		        }]
            };
            $.table.init(options);
        });
    </script>
</body>
</html>
