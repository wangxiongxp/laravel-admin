@inject('dictService', 'App\Services\DictService')

<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
    <link href="/static/ajax/libs/select2/select2.min.css" rel="stylesheet"/>
    <link href="/static/ajax/libs/select2/select2-bootstrap.css" rel="stylesheet"/>
</head>
<body>
    <div class="main-content">
        <form class="form-horizontal" id="form-user-edit" >
            <input name="user_id"  type="hidden"  value="{{$user['user_id']}}" />
			<input name="dept_id"  type="hidden"  value="{{$user['dept_id']}}" id="treeId"/>
            <h4 class="form-header h4">基本信息</h4>
            <div class="row">
            	<div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span style="color: red; ">*</span>用户名称：</label>
                        <div class="col-sm-8">
                            <input name="user_name" placeholder="请输入用户名称" class="form-control" type="text" maxlength="30" value="{{$user['user_name']}}" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span style="color: red; ">*</span>归属部门：</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                                <input class="form-control" type="text" onclick="selectDeptTree()" id="treeName" value="{{$dept['dept_name']}}" required>
                            	<span class="input-group-addon"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span style="color: red; ">*</span>手机号码：</label>
                        <div class="col-sm-8">
                            <input name="phonenumber" placeholder="请输入手机号码" class="form-control" type="text" maxlength="11" value="{{$user['phonenumber']}}" required>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span style="color: red; ">*</span>邮箱：</label>
                        <div class="col-sm-8">
                            <input name="email" class="form-control email" type="text" maxlength="50" placeholder="请输入邮箱" value="{{$user['email']}}" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span style="color: red; ">*</span>登录账号：</label>
                        <div class="col-sm-8">
                            <input class="form-control" type="text" readonly="true" value="{{$user['login_name']}}"/>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">用户状态：</label>
                        <div class="col-sm-8">
                            <label class="toggle-switch switch-solid">
	                            <input type="checkbox" id="status" checked="{{$user['status'] == '0' ? true : false}}" >
	                            <span></span>
	                        </label>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">岗位：</label>
                        <div class="col-sm-8">
                            <select id="post" class="form-control select2-multiple" multiple>
                                @foreach ($posts as $post)
                                    <option value="{{$post['post_id']}}" {{$post['status']==1?'disabled':''}} {{$post['flag']?'selected':''}}>{{$post['post_name']}}</option>
                                @endforeach
							</select>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">用户性别：</label>
                        <div class="col-sm-8">
                            <select name="sex" class="form-control m-b">
                                @foreach ($dictService->getType('sys_user_sex') as $dict)
                                <option value="{{$dict['dict_value']}}" {{$dict['dict_value']==$user['sex']?'selected':''}}>{{$dict['dict_label']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
            	<div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-xs-2 control-label">角色：</label>
                        <div class="col-xs-10">
                            @foreach ($roles as $role)
                                <label class="check-box">
                                    <input name="role" type="checkbox" value="{{$role['role_id']}}" {{$role['flag']?'checked':''}} {{$role['status']==1?'disabled':''}}>{{$role['role_name']}}
                                </label>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <h4 class="form-header h4">其他信息</h4>
            <div class="row">
                <div class="col-sm-12">
                    <div class="form-group">
                        <label class="col-xs-2 control-label">备注：</label>
                        <div class="col-xs-10">
                            <textarea name="remark" maxlength="500" class="form-control" rows="3">{{$user['remark']}}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="row">
        <div class="col-sm-offset-5 col-sm-10">
            <button type="button" class="btn btn-sm btn-primary" onclick="submitHandler()"><i class="fa fa-check"></i>保 存</button>&nbsp;
            <button type="button" class="btn btn-sm btn-danger" onclick="closeItem()"><i class="fa fa-reply-all"></i>关 闭 </button>
        </div>
    </div>
    @include('admin.layouts.footer')
    <script src="/static/ajax/libs/select2/select2.min.js"></script>
	<script type="text/javascript">
        var prefix = "/system/user";

        $("#form-user-edit").validate({
        	onkeyup: false,
        	rules:{
        		email:{
                    email:true,
                    remote: {
                        url: prefix + "/checkEmailUnique",
                        type: "post",
                        dataType: "json",
                        data: {
                        	"user_id": function() {
                                return $("#user_id").val();
                            },
                			"email": function() {
                                return $.common.trim($("#email").val());
                            }
                        },
                        dataFilter: function (data, type) {
                        	return $.validate.unique(data);
                        }
                    }
        		},
        		phonenumber:{
        			isPhone:true,
                    remote: {
                        url: prefix + "/checkPhoneUnique",
                        type: "post",
                        dataType: "json",
                        data: {
                        	"user_id": function() {
                        		return $("#user_id").val();
                            },
                			"phonenumber": function() {
                                return $.common.trim($("#phonenumber").val());
                            }
                        },
                        dataFilter: function (data, type) {
                        	return $.validate.unique(data);
                        }
                    }
        		},
        	},
        	messages: {
        		"email": {
                    remote: "Email已经存在"
                },
        		"phonenumber":{
                	remote: "手机号码已经存在"
        		}
            },
            focusCleanup: true
        });

        function submitHandler() {
	        if ($.validate.form()) {
	        	var data = $("#form-user-edit").serializeArray();
	        	var status = $("input[id='status']").is(':checked') == true ? 0 : 1;
	        	var roleIds = $.form.selectCheckeds("role");
	        	var postIds = $.form.selectSelects("post");
	        	data.push({"name": "status", "value": status});
	        	data.push({"name": "role_ids", "value": roleIds});
	        	data.push({"name": "post_ids", "value": postIds});
	        	$.operate.saveTab(prefix + "/update", data);
	        }
	    }

        /*用户管理-修改-选择部门树*/
        function selectDeptTree() {
        	var dept_id = $.common.isEmpty($("#treeId").val()) ? "100" : $("#treeId").val();
            var url = "/system/dept/selectDeptTree/" + dept_id;
		    var options = {
				title: '选择部门',
				width: "380",
				url: url,
				callBack: doSubmit
			};
			$.modal.openOptions(options);
		}

		function doSubmit(index, layero){
			var tree = layero.find("iframe")[0].contentWindow.$._tree;
			if ($.tree.notAllowParents(tree)) {
    			var body = layer.getChildFrame('body', index);
    			$("#treeId").val(body.find('#treeId').val());
    			$("#treeName").val(body.find('#treeName').val());
    			layer.close(index);
			}
		}

		$(function() {
            $('#post').select2({
                placeholder:"请选择岗位",
                allowClear: true
            });
        })
    </script>
</body>
</html>
