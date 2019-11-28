@inject('dictService', 'App\Services\DictService')

<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
</head>
<body class="white-bg">
	<div class="wrapper wrapper-content animated fadeInRight ibox-content">
		<form class="form-horizontal m" id="form-menu-edit" >
			<input name="menu_id" type="hidden" value="{{$menu['menu_id']}}" />
			<input id="treeId" name="parent_id" type="hidden" value="{{$menu['parent_id']}}" />
			<div class="form-group">
				<label class="col-sm-3 control-label ">上级菜单：</label>
				<div class="col-sm-8">
				    <div class="input-group">
						<input class="form-control" type="text" onclick="selectMenuTree()" id="treeName" readonly value="{{$parent['menu_name'] ?? '无'}} ">
					    <span class="input-group-addon"><i class="fa fa-search"></i></span>
				    </div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">菜单类型：</label>
				<div class="col-sm-8">
					<label class="radio-box"> <input type="radio" @if($menu['menu_type']=='M') checked @endif name="menu_type" value="M" /> 目录 </label>
					<label class="radio-box"> <input type="radio" @if($menu['menu_type']=='C') checked @endif name="menu_type" value="C" /> 菜单 </label>
					<label class="radio-box"> <input type="radio" @if($menu['menu_type']=='F') checked @endif name="menu_type" value="F" /> 按钮 </label>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">菜单名称：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="menu_name" id="menu_name" value="{{$menu['menu_name']}}" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">请求地址：</label>
				<div class="col-sm-8">
					<input id="url" name="url" class="form-control" type="text" value="{{$menu['url']}}">
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">打开方式：</label>
				<div class="col-sm-8">
					<select id="target" name="target" class="form-control m-b">
	                    <option value="menuItem" {{$menu['target'] == 'menuItem' ? 'selected' : ''}}>页签</option>
	                    <option value="menuBlank" {{$menu['target'] == 'menuBlank' ? 'selected' : ''}}>新窗口</option>
	                </select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">权限标识：</label>
				<div class="col-sm-8">
					<input id="perms" name="perms" class="form-control" type="text" value="{{$menu['perms']}}">
				    <span class="help-block m-b-none"><i class="fa fa-info-circle"></i> 控制器中定义的权限标识，如：@RequiresPermissions("")</span>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">显示排序：</label>
				<div class="col-sm-8">
					<input class="form-control" type="text" name="order_num" value="{{$menu['order_num']}}" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-3 control-label">图标：</label>
				<div class="col-sm-8">
					<input id="icon" name="icon" class="form-control" type="text" placeholder="选择图标" value="{{$menu['icon']}}">
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
                            <input type="radio" id="{{$dict['dict_code']}}" name="visible" value="{{$dict['dict_value']}}" @if($dict['dict_value']==$menu['visible'])checked="checked" @endif>
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

        $(function() {
            var menu_type = $('input[name="menu_type"]:checked').val();
            menuVisible(menu_type);
        });

        $("#form-menu-edit").validate({
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
                        	"menu_id": function() {
                                return $("#menu_id").val();
                            },
                            "parent_id": function() {
		                		return $("input[name='parent_id']").val();
		                    },
                			"menu_name": function() {
                                return $.common.trim($("#menu_name").val());
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
	            $.operate.save(prefix + "/update", $('#form-menu-edit').serialize());
	        }
	    }

        $(function() {
            $("input[name='icon']").focus(function() {
                $(".icon-drop").show();
            });
            $("#form-menu-edit").click(function(event) {
                var obj = event.srcElement || event.target;
                if (!$(obj).is("input[name='icon']")) {
                    $(".icon-drop").hide();
                }
            });
            $(".icon-drop").find(".ico-list i").on("click",
            function() {
                $('#icon').val($(this).attr('class'));
            });
            $('input').on('ifChecked',
            function(event) {
                var menu_type = $(event.target).val();
                menuVisible(menu_type);
            });
        });

        function menuVisible(menu_type) {
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
        }

        /*菜单管理-修改-选择菜单树*/
        function selectMenuTree() {
        	var menu_id = $("#treeId").val();
        	if(menu_id > 0) {
        		var url = prefix + "/selectMenuTree/" + menu_id;
        		$.modal.open("选择菜单", url, '380', '380');
        	} else {
        		$.modal.alertError("主菜单不能选择");
        	}
        }

        function selectMenuTree() {
        	var menu_id = $("#treeId").val();
        	if(menu_id > 0) {
        		var url = prefix + "/selectMenuTree/" + menu_id;
        		var options = {
       				title: '菜单选择',
       				width: "380",
       				url: url,
       				callBack: doSubmit
       			};
       			$.modal.openOptions(options);
        	} else {
        		$.modal.alertError("主菜单不能选择");
        	}
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
