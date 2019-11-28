@inject('dictService', 'App\Services\DictService')

<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
</head>
<body class="white-bg">
	<div class="wrapper wrapper-content animated fadeInRight ibox-content">
		<form class="form-horizontal m" id="form-dept-edit" >
			<input name="dept_id" type="hidden" value="{{$dept['dept_id']}}" />
			<input id="treeId" name="parent_id" type="hidden" value="{{$dept['parent_id']}}" />
			<div class="form-group">
				<label class="col-sm-3 control-label ">上级部门：</label>
				<div class="col-sm-8">
				    <div class="input-group">
						<input class="form-control" type="text" id="treeName" onclick="selectDeptTree()" readonly value="{{$parent['dept_name'] ?? '无'}}">
					    <span class="input-group-addon"><i class="fa fa-search"></i></span>
				    </div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">部门名称：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="dept_name" value="{{$dept['dept_name']}}" id="dept_name" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">显示排序：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="order_num" value="{{$dept['order_num']}}" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">负责人：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="leader" value="{{$dept['leader']}}">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">联系电话：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="phone" value="{{$dept['phone']}}">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">邮箱：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="email" value="{{$dept['email']}}">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">部门状态：</label>
				<div class="col-sm-8">
                    @foreach ($dictService->getType('sys_normal_disable') as $dict)
                        <div class="radio-box">
                            <input type="radio" id="{{$dict['dict_code']}}" name="status" value="{{$dict['dict_value']}}" @if($dict['dict_value']==$dept['status'])checked="checked" @endif>
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

		$("#form-dept-edit").validate({
			onkeyup: false,
			rules:{
				dept_name:{
					remote: {
		                url: prefix + "/checkDeptNameUnique",
		                type: "post",
		                dataType: "json",
		                data: {
		                	"dept_id": function() {
		                        return $("#dept_id").val();
		                    },
		                    "parent_id": function() {
		                        return $("input[name='parent_id']").val();
		                    },
		        			"dept_name": function() {
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
	        	$.operate.save(prefix + "/update", $('#form-dept-edit').serialize());
	        }
	    }

		/*部门管理-修改-选择部门树*/
		function selectDeptTree() {
			var dept_id = $("#treeId").val();
			if(dept_id > 0) {
			    var options = {
					title: '部门选择',
					width: "380",
					url: prefix + "/selectDeptTree/" + $("#treeId").val(),
					callBack: doSubmit
				};
				$.modal.openOptions(options);
			} else {
        		$.modal.alertError("父部门不能选择");
        	}
		}

		function doSubmit(index, layero){
			var tree = layero.find("iframe")[0].contentWindow.$._tree;
			if ($.tree.notAllowLastLevel(tree)) {
	   			var body = layer.getChildFrame('body', index);
	   			$("#treeId").val(body.find('#treeId').val());
	   			$("#treeName").val(body.find('#treeName').val());
	   			layer.close(index);
			}
		}
	</script>
</body>
</html>
