@inject('dictService', 'App\Services\DictService')

<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
</head>
<body class="white-bg">
	<div class="wrapper wrapper-content animated fadeInRight ibox-content">
		<form class="form-horizontal m" id="form-dept-add">
			<input id="treeId" name="parent_id" type="hidden" value="{{$dept['dept_id']}}" />
			<div class="form-group">
				<label class="col-sm-3 control-label ">上级部门：</label>
				<div class="col-sm-8">
				    <div class="input-group">
						<input class="form-control" type="text" onclick="selectDeptTree()" id="treeName" readonly value="{{$dept['dept_name']}}">
					    <span class="input-group-addon"><i class="fa fa-search"></i></span>
				    </div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">部门名称：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="dept_name" id="dept_name" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">显示排序：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="order_num" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">负责人：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="leader">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">联系电话：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="phone">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">邮箱：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="email">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">部门状态：</label>
				<div class="col-sm-8">
                    @foreach ($dictService->getType('sys_normal_disable') as $dict)
                        <div class="radio-box">
                            <input type="radio" id="{{$dict['dict_code']}}" name="status" value="{{$dict['dict_value']}}" {{$dict['is_default'] == 'Y' ? 'checked' : ''}}>
                            <label for="{{$dict['dict_code']}}">{{$dict['dict_label']}}</label>
                        </div>
                    @endforeach
				</div>
			</div>
		</form>
	</div>
    @include('admin.layouts.footer')
    <script type="text/javascript">
		var prefix = "/system/dept";

		$("#form-dept-add").validate({
			onkeyup: false,
			rules:{
				dept_name:{
					remote: {
		                url: prefix + "/checkDeptNameUnique",
		                type: "post",
		                dataType: "json",
		                data: {
		                	"parent_id": function() {
		                		return $("input[name='parent_id']").val();
		                    },
		                	"dept_name" : function() {
		                        return $.common.trim($("#dept_name").val());
		                    }
		                },
		                dataFilter: function(data, type) {
		                	return $.validate.unique(data);
		                }
		            }
				},
				order_num:{
					digits:true
				},
				email:{
                    email:true,
        		},
        		phone:{
        			isPhone:true,
        		},
			},
			messages: {
		        "dept_name": {
		            remote: "部门已经存在"
		        }
		    },
		    focusCleanup: true
		});

		function submitHandler() {
	        if ($.validate.form()) {
	        	$.operate.save(prefix + "/save", $('#form-dept-add').serialize());
	        }
	    }

		/*部门管理-新增-选择父部门树*/
		function selectDeptTree() {
			var options = {
				title: '部门选择',
				width: "380",
				url: prefix + "/selectDeptTree/" + $("#treeId").val(),
				callBack: doSubmit
			};
			$.modal.openOptions(options);
		}

		function doSubmit(index, layero){
			var body = layer.getChildFrame('body', index);
   			$("#treeId").val(body.find('#treeId').val());
   			$("#treeName").val(body.find('#treeName').val());
   			layer.close(index);
		}
	</script>
</body>
</html>
