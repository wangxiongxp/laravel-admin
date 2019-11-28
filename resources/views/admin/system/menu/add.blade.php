@inject('dictService', 'App\Services\DictService')

<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
</head>
<body class="white-bg">
	<div class="wrapper wrapper-content animated fadeInRight ibox-content">
		<form class="form-horizontal m" id="form-menu-add">
			<input id="treeId" name="parent_id" type="hidden" value="{{$menu['menu_id']}}" />
			<div class="form-group">
				<label class="col-sm-3 control-label ">上级菜单：</label>
				<div class="col-sm-8">
				    <div class="input-group">
					    <input class="form-control" type="text" onclick="selectMenuTree()" id="treeName" readonly="true" value="{{$menu['menu_name']}}">
				        <span class="input-group-addon"><i class="fa fa-search"></i></span>
				    </div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">菜单类型：</label>
				<div class="col-sm-8">
					<label class="radio-box"> <input type="radio" name="menu_type" value="M" /> 目录 </label>
					<label class="radio-box"> <input type="radio" name="menu_type" value="C" /> 菜单 </label>
					<label class="radio-box"> <input type="radio" name="menu_type" value="F" /> 按钮 </label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">菜单名称：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="menu_name" id="menu_name" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">请求地址：</label>
				<div class="col-sm-8">
					<input id="url" name="url" class="form-control" type="text">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">打开方式：</label>
				<div class="col-sm-8">
					<select id="target" name="target" class="form-control m-b">
	                    <option value="menuItem">页签</option>
	                    <option value="menuBlank">新窗口</option>
	                </select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">权限标识：</label>
				<div class="col-sm-8">
					<input id="perms" name="perms" class="form-control" type="text">
					<span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 控制器中定义的权限标识，如：@RequiresPermissions("")</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">显示排序：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="orderNum" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">图标：</label>
				<div class="col-sm-8">
					<input id="icon" name="icon" class="form-control" type="text" placeholder="选择图标">
                    <div class="ms-parent" style="width: 100%;">
                        <div class="icon-drop animated flipInX" style="display: none;max-height:200px;overflow-y:auto">
                            @include('admin.system.menu.icon')
                        </div>
                    </div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">菜单状态：</label>
				<div class="col-sm-8">
                    @foreach ($dictService->getType('sys_show_hide') as $dict)
                        <div class="radio-box">
                            <input type="radio" id="{{$dict['dict_code']}}" name="visible" value="{{$dict['dict_value']}}" {{$dict['is_default'] == 'Y' ? 'checked' : ''}}>
                            <label for="{{$dict['dict_code']}}">{{$dict['dict_label']}}</label>
                        </div>
                    @endforeach
				</div>
			</div>
		</form>
	</div>
    @include('admin.layouts.footer')
    <script type="text/javascript">
        var prefix = "/system/menu";

        $("#form-menu-add").validate({
        	onkeyup: false,
        	rules:{
        		menu_type:{
        			required:true,
        		},
        		menu_name:{
        			remote: {
                        url: prefix + "/checkMenuNameUnique",
                        type: "post",
                        dataType: "json",
                        data: {
                        	"parent_id": function() {
		                		return $("input[name='parent_id']").val();
		                    },
                        	"menu_name" : function() {
                                return $.common.trim($("#menu_name").val());
                            }
                        },
                        dataFilter: function(data, type) {
                        	return $.validate.unique(data);
                        }
                    }
        		},
        		orderNum:{
        			digits:true
        		},
        	},
        	messages: {
                "menu_name": {
                    remote: "菜单已经存在"
                }
            },
            focusCleanup: true
        });

        function submitHandler() {
	        if ($.validate.form()) {
	            $.operate.save(prefix + "/save", $('#form-menu-add').serialize());
	        }
	    }

        $(function() {
        	$("input[name='icon']").focus(function() {
                $(".icon-drop").show();
            });
        	$("#form-menu-add").click(function(event) {
        	    var obj = event.srcElement || event.target;
        	    if (!$(obj).is("input[name='icon']")) {
        	    	$(".icon-drop").hide();
        	    }
        	});
        	$(".icon-drop").find(".ico-list i").on("click", function() {
        		$('#icon').val($(this).attr('class'));
            });
        	$('input').on('ifChecked', function(event){
        		var menu_type = $(event.target).val();
        		if (menu_type == "M") {
                    $("#url").parents(".form-group").hide();
                    $("#perms").parents(".form-group").hide();
                    $("#icon").parents(".form-group").show();
                    $("#target").parents(".form-group").hide();
                    $("input[name='visible']").parents(".form-group").show();
                } else if (menu_type == "C") {
                	$("#url").parents(".form-group").show();
                    $("#perms").parents(".form-group").show();
                    $("#icon").parents(".form-group").show();
                    $("#target").parents(".form-group").show();
                    $("input[name='visible']").parents(".form-group").show();
                } else if (menu_type == "F") {
                	$("#url").parents(".form-group").hide();
                    $("#perms").parents(".form-group").show();
                    $("#icon").parents(".form-group").hide();
                    $("#target").parents(".form-group").hide();
                    $("input[name='visible']").parents(".form-group").hide();
                }
        	});
        });

        /*菜单管理-新增-选择菜单树*/
        function selectMenuTree() {
        	var treeId = $("#treeId").val();
        	var menuId = treeId > 0 ? treeId : 1;
        	var url = prefix + "/selectMenuTree/" + menuId;
			var options = {
				title: '菜单选择',
				width: "380",
				url: url,
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
