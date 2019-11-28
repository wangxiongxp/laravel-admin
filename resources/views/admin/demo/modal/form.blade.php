@inject('dictService', 'App\Services\DictService')

<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
</head>
<body>
    <div class="main-content">
        <form id="form-user-add" class="form-horizontal">
            <div class="row">
            	<div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span style="color: red; ">*</span>用户名称：</label>
                        <div class="col-sm-8">
                            <input name="userName" placeholder="请输入用户名称" class="form-control" type="text">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span style="color: red; ">*</span>归属部门：</label>
                        <div class="col-sm-8">
                            <div class="input-group">
                            	<input name="deptName" type="text" placeholder="请选择归属部门" class="form-control">
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
                            <input name="phonenumber" placeholder="请输入手机号码" class="form-control" type="text">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span style="color: red; ">*</span>邮箱：</label>
                        <div class="col-sm-8">
                            <input name="email" class="form-control" type="text" placeholder="请输入邮箱">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span style="color: red; ">*</span>登录账号：</label>
                        <div class="col-sm-8">
                            <input name="loginName" placeholder="请输入登录账号" class="form-control" type="text">
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label"><span style="color: red; ">*</span>登录密码：</label>
                        <div class="col-sm-8">
                            <input name="password" placeholder="请输入登录密码" class="form-control" type="password">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">用户性别：</label>
                        <div class="col-sm-8">
                            <div class="input-group" style="width: 100%">
                                <select name="sex" class="form-control m-b" >
                                    @foreach ($dictService->getType('sys_user_sex') as $dict)
                                        <option value="{{$dict['dict_value']}}" {{$dict['is_default'] == 'Y' ? 'selected' : ''}}>{{$dict['dict_label']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label class="col-sm-4 control-label">用户状态：</label>
                        <div class="col-sm-8">
                            <label class="toggle-switch switch-solid">
	                            <input type="checkbox" id="status" checked>
	                            <span></span>
	                        </label>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    @include('admin.layouts.footer')
</body>
</html>
