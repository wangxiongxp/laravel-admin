<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// 客户未登录
Route::group(['prefix' => '/','namespace'=>'Web'], function () {
    Route::get('', function () {
        return view('web.welcome');
    });
});

// 客户登录成功
Route::group(['middleware' => 'auth:web','namespace'=>'Web'], function () {
    Route::get('/home', 'HomeController@index')->name('home');
});

// 后台登录
Route::group(['prefix' => 'admin','namespace'=>'Admin'], function () {
    Route::get('login', 'System\SysLoginController@showLoginForm')->name('admin_login');
    Route::post('login', 'System\SysLoginController@login');
});

// 后台管理
Route::group(['middleware' => 'auth.admin:admin','namespace'=>'Admin'], function() {

    Route::get('/admin/logout', 'System\SysLoginController@logout');

    Route::get('/admin', 'System\SysIndexController@index');
    Route::get('/system/switchSkin', 'System\SysIndexController@switchSkin');
    Route::get('/system/main', 'System\SysIndexController@main');

    //服务监控
    Route::get('/monitor/server', 'Monitor\ServerController@index');

    //操作日志
    Route::get('/monitor/operationLog', 'Monitor\SysOperationLogController@index');
    Route::post('/monitor/operationLog/list', 'Monitor\SysOperationLogController@list');
    Route::get('/monitor/operationLog/add', 'Monitor\SysOperationLogController@add');
    Route::post('/monitor/operationLog/save', 'Monitor\SysOperationLogController@save');
    Route::get('/monitor/operationLog/edit/{oper_id}', 'Monitor\SysOperationLogController@edit');
    Route::post('/monitor/operationLog/update', 'Monitor\SysOperationLogController@update');
    Route::post('/monitor/operationLog/remove', 'Monitor\SysOperationLogController@remove');
    Route::get('/monitor/operationLog/detail/{oper_id}', 'Monitor\SysOperationLogController@detail');

    //登录日志
    Route::get('/monitor/loginInfo', 'Monitor\SysLoginInfoController@index');
    Route::post('/monitor/loginInfo/list', 'Monitor\SysLoginInfoController@list');
    Route::get('/monitor/loginInfo/add', 'Monitor\SysLoginInfoController@add');
    Route::post('/monitor/loginInfo/save', 'Monitor\SysLoginInfoController@save');
    Route::get('/monitor/loginInfo/edit/{info_id}', 'Monitor\SysLoginInfoController@edit');
    Route::post('/monitor/loginInfo/update', 'Monitor\SysLoginInfoController@update');
    Route::post('/monitor/loginInfo/remove', 'Monitor\SysLoginInfoController@remove');

    //表单构建
    Route::get('/tool/build', 'Tool\BuildController@index');

    //用户管理
    Route::get('/system/user', 'System\SysUserController@index');
    Route::post('/system/user/list', 'System\SysUserController@list');
    Route::get('/system/user/add', 'System\SysUserController@add');
    Route::post('/system/user/save', 'System\SysUserController@save');
    Route::get('/system/user/edit/{userId}', 'System\SysUserController@edit');
    Route::post('/system/user/update', 'System\SysUserController@update');
    Route::post('/system/user/remove', 'System\SysUserController@remove');
    Route::post('/system/user/checkLoginNameUnique', 'System\SysUserController@checkLoginNameUnique');
    Route::post('/system/user/checkPhoneUnique', 'System\SysUserController@checkPhoneUnique');
    Route::post('/system/user/checkEmailUnique', 'System\SysUserController@checkEmailUnique');
    Route::post('/system/user/changeStatus', 'System\SysUserController@changeStatus');
    Route::get('/system/user/resetPwd/{userId}', 'System\SysUserController@resetPwd');
    Route::post('/system/user/resetPwdSave', 'System\SysUserController@resetPwdSave');
    Route::get('/system/user/profile', 'System\SysProfileController@profile');
    Route::get('/system/user/profile/resetPwd', 'System\SysProfileController@resetPwd');
    Route::get('/system/user/profile/checkPassword', 'System\SysProfileController@checkPassword');
    Route::post('/system/user/profile/resetPwdSave', 'System\SysProfileController@resetPwdSave');
    Route::post('/system/user/profile/update', 'System\SysProfileController@update');
    Route::get('/system/user/profile/avatar', 'System\SysProfileController@avatar');
    Route::post('/system/user/profile/updateAvatar', 'System\SysProfileController@updateAvatar');

    //角色管理
    Route::get('/system/role', 'System\SysRoleController@index');
    Route::post('/system/role/list', 'System\SysRoleController@list');
    Route::get('/system/role/add', 'System\SysRoleController@add');
    Route::post('/system/role/save', 'System\SysRoleController@save');
    Route::get('/system/role/edit/{role_id}', 'System\SysRoleController@edit');
    Route::post('/system/role/update', 'System\SysRoleController@update');
    Route::post('/system/role/remove', 'System\SysRoleController@remove');
    Route::post('/system/role/checkRoleKeyUnique', 'System\SysRoleController@checkRoleKeyUnique');
    Route::post('/system/role/checkRoleNameUnique', 'System\SysRoleController@checkRoleNameUnique');
    Route::get('/system/role/authDataScope/{role_id}', 'System\SysRoleController@authDataScope');
    Route::post('/system/role/authDataScopeSave', 'System\SysRoleController@authDataScopeSave');
    Route::get('/system/role/authUser/{role_id}', 'System\SysRoleController@authUser');
    Route::post('/system/role/authUser/allocatedList', 'System\SysRoleController@allocatedList');
    Route::post('/system/role/authUser/unallocatedList', 'System\SysRoleController@unallocatedList');
    Route::post('/system/role/authUser/selectAuthUserAll', 'System\SysRoleController@selectAuthUserAll');
    Route::post('/system/role/authUser/cancelAuthUser', 'System\SysRoleController@cancelAuthUser');
    Route::post('/system/role/authUser/cancelAuthUserAll', 'System\SysRoleController@cancelAuthUserAll');
    Route::get('/system/role/authUser/selectUser/{role_id}', 'System\SysRoleController@selectUser');
    Route::post('/system/role/changeStatus', 'System\SysRoleController@changeStatus');

    //菜单管理
    Route::get('/system/menu', 'System\SysMenuController@index');
    Route::post('/system/menu/list', 'System\SysMenuController@list');
    Route::get('/system/menu/add/{parent_id}', 'System\SysMenuController@add');
    Route::post('/system/menu/save', 'System\SysMenuController@save');
    Route::get('/system/menu/edit/{menu_id}', 'System\SysMenuController@edit');
    Route::post('/system/menu/update', 'System\SysMenuController@update');
    Route::get('/system/menu/remove/{menu_id}', 'System\SysMenuController@remove');
    Route::post('/system/menu/checkMenuNameUnique', 'System\SysMenuController@checkMenuNameUnique');
    Route::get('/system/menu/selectMenuTree/{menu_id}', 'System\SysMenuController@selectMenuTree');
    Route::get('/system/menu/menuTreeData', 'System\SysMenuController@menuTreeData');
    Route::get('/system/menu/roleMenuTreeData', 'System\SysMenuController@roleMenuTreeData');

    //部门管理
    Route::get('/system/dept', 'System\SysDeptController@index');
    Route::post('/system/dept/list', 'System\SysDeptController@list');
    Route::get('/system/dept/add/{parent_id}', 'System\SysDeptController@add');
    Route::post('/system/dept/save', 'System\SysDeptController@save');
    Route::get('/system/dept/edit/{dept_id}', 'System\SysDeptController@edit');
    Route::post('/system/dept/update', 'System\SysDeptController@update');
    Route::get('/system/dept/remove/{dept_id}', 'System\SysDeptController@remove');
    Route::get('/system/dept/selectDeptTree/{dept_id}', 'System\SysDeptController@selectDeptTree');
    Route::get('/system/dept/treeData', 'System\SysDeptController@treeData');
    Route::get('/system/dept/roleDeptTreeData', 'System\SysDeptController@roleDeptTreeData');
    Route::post('/system/dept/checkDeptNameUnique', 'System\SysDeptController@checkDeptNameUnique');

    //岗位管理
    Route::get('/system/post', 'System\SysPostController@index');
    Route::post('/system/post/list', 'System\SysPostController@list');
    Route::get('/system/post/add', 'System\SysPostController@add');
    Route::post('/system/post/save', 'System\SysPostController@save');
    Route::get('/system/post/edit/{post_id}', 'System\SysPostController@edit');
    Route::post('/system/post/update', 'System\SysPostController@update');
    Route::post('/system/post/remove', 'System\SysPostController@remove');
    Route::post('/system/post/checkPostNameUnique', 'System\SysPostController@checkPostNameUnique');
    Route::post('/system/post/checkPostCodeUnique', 'System\SysPostController@checkPostCodeUnique');

    //字典管理
    Route::get('/system/dict', 'System\SysDictTypeController@index');
    Route::post('/system/dict/list', 'System\SysDictTypeController@list');
    Route::get('/system/dict/add', 'System\SysDictTypeController@add');
    Route::post('/system/dict/save', 'System\SysDictTypeController@save');
    Route::get('/system/dict/edit/{dict_id}', 'System\SysDictTypeController@edit');
    Route::post('/system/dict/update', 'System\SysDictTypeController@update');
    Route::post('/system/dict/remove', 'System\SysDictTypeController@remove');
    Route::get('/system/dict/detail/{dict_id}', 'System\SysDictTypeController@detail');
    Route::post('/system/dict/checkDictTypeUnique', 'System\SysDictTypeController@checkDictTypeUnique');
    Route::post('/system/dict/data/list', 'System\SysDictDataController@list');
    Route::get('/system/dict/data/add/{dict_type}', 'System\SysDictDataController@add');
    Route::post('/system/dict/data/save', 'System\SysDictDataController@save');
    Route::get('/system/dict/data/edit/{dict_code}', 'System\SysDictDataController@edit');
    Route::post('/system/dict/data/update', 'System\SysDictDataController@update');
    Route::post('/system/dict/data/remove', 'System\SysDictDataController@remove');

    //参数设置
    Route::get('/system/config', 'System\SysConfigController@index');
    Route::post('/system/config/list', 'System\SysConfigController@list');
    Route::get('/system/config/add', 'System\SysConfigController@add');
    Route::post('/system/config/save', 'System\SysConfigController@save');
    Route::get('/system/config/edit/{config_id}', 'System\SysConfigController@edit');
    Route::post('/system/config/update', 'System\SysConfigController@update');
    Route::post('/system/config/remove', 'System\SysConfigController@remove');
    Route::post('/system/config/checkConfigKeyUnique', 'System\SysConfigController@checkConfigKeyUnique');

    //通知公告
    Route::get('/system/notice', 'System\SysNoticeController@index');
    Route::post('/system/notice/list', 'System\SysNoticeController@list');
    Route::get('/system/notice/add', 'System\SysNoticeController@add');
    Route::post('/system/notice/save', 'System\SysNoticeController@save');
    Route::get('/system/notice/edit/{notice_id}', 'System\SysNoticeController@edit');
    Route::post('/system/notice/update', 'System\SysNoticeController@update');
    Route::post('/system/notice/remove', 'System\SysNoticeController@remove');

    //表单相关
    Route::get('/demo/form/button', 'Demo\DemoFormController@button');
    Route::get('/demo/form/select', 'Demo\DemoFormController@select');
    Route::get('/demo/form/timeline', 'Demo\DemoFormController@timeline');
    Route::get('/demo/form/validate', 'Demo\DemoFormController@formValidate');
    Route::get('/demo/form/jasny', 'Demo\DemoFormController@jasny');
    Route::get('/demo/form/sortable', 'Demo\DemoFormController@sortable');
    Route::get('/demo/form/tabs_panels', 'Demo\DemoFormController@tabs_panels');
    Route::get('/demo/form/grid', 'Demo\DemoFormController@grid');
    Route::get('/demo/form/wizard', 'Demo\DemoFormController@wizard');
    Route::get('/demo/form/upload', 'Demo\DemoFormController@upload');
    Route::get('/demo/form/datetime', 'Demo\DemoFormController@datetime');
    Route::get('/demo/form/duallistbox', 'Demo\DemoFormController@duallistbox');
    Route::get('/demo/form/basic', 'Demo\DemoFormController@basic');
    Route::get('/demo/form/cards', 'Demo\DemoFormController@cards');
    Route::get('/demo/form/summernote', 'Demo\DemoFormController@summernote');
    Route::get('/demo/form/autocomplete', 'Demo\DemoFormController@autocomplete');
    Route::get('/demo/form/userModel', 'Demo\DemoFormController@userModel');
    Route::get('/demo/form/collection', 'Demo\DemoFormController@collection');

    //表格相关
    Route::get('/demo/table/search', 'Demo\DemoTableController@search');
    Route::get('/demo/table/footer', 'Demo\DemoTableController@footer');
    Route::get('/demo/table/groupHeader', 'Demo\DemoTableController@groupHeader');
    Route::get('/demo/table/export', 'Demo\DemoTableController@export'); // 导出有问题，拿不到数据
    Route::get('/demo/table/remember', 'Demo\DemoTableController@remember');
    Route::get('/demo/table/pageGo', 'Demo\DemoTableController@pageGo');
    Route::get('/demo/table/params', 'Demo\DemoTableController@params');
    Route::get('/demo/table/multi', 'Demo\DemoTableController@multi');
    Route::get('/demo/table/button', 'Demo\DemoTableController@button');
    Route::get('/demo/table/fixedColumns', 'Demo\DemoTableController@fixedColumns');
    Route::get('/demo/table/event', 'Demo\DemoTableController@event');
    Route::get('/demo/table/detail', 'Demo\DemoTableController@detail');
    Route::get('/demo/table/child', 'Demo\DemoTableController@child');
    Route::get('/demo/table/image', 'Demo\DemoTableController@image');
    Route::get('/demo/table/curd', 'Demo\DemoTableController@curd');
    Route::get('/demo/table/reorder', 'Demo\DemoTableController@reorder');
    Route::get('/demo/table/editable', 'Demo\DemoTableController@editable');
    Route::get('/demo/table/other', 'Demo\DemoTableController@other');
    Route::post('/demo/table/list', 'Demo\DemoTableController@list');

    //模态窗口
    Route::get('/demo/modal/dialog', 'Demo\DemoDialogController@dialog');
    Route::get('/demo/modal/layer', 'Demo\DemoDialogController@layer');
    Route::get('/demo/modal/form', 'Demo\DemoDialogController@form');
    Route::get('/demo/modal/table', 'Demo\DemoDialogController@table');
    Route::get('/demo/modal/check', 'Demo\DemoDialogController@check');
    Route::get('/demo/modal/radio', 'Demo\DemoDialogController@radio');
    Route::get('/demo/modal/parent', 'Demo\DemoDialogController@parent');

    //操作控制
    Route::get('/demo/operate/table', 'Demo\DemoOperateController@table');
    Route::get('/demo/operate/other', 'Demo\DemoOperateController@other');
    Route::post('/demo/operate/list', 'Demo\DemoOperateController@list');
    Route::get('/demo/operate/add', 'Demo\DemoOperateController@add');
    Route::post('/demo/operate/add', 'Demo\DemoOperateController@addSave');
    Route::get('/demo/operate/edit/{id}', 'Demo\DemoOperateController@edit');
    Route::post('/demo/operate/edit', 'Demo\DemoOperateController@editSave');
    Route::post('/demo/operate/remove', 'Demo\DemoOperateController@remove');
    Route::post('/demo/operate/clean', 'Demo\DemoOperateController@clean');
    Route::get('/demo/operate/detail/{id}', 'Demo\DemoOperateController@detail');

    //报表
    Route::get('/demo/report/echarts', 'Demo\DemoReportController@echarts');
    Route::get('/demo/report/peity', 'Demo\DemoReportController@peity');
    Route::get('/demo/report/sparkline', 'Demo\DemoReportController@sparkline');
    Route::get('/demo/report/metrics', 'Demo\DemoReportController@metrics');

    //图标相关
    Route::get('/demo/icon/fontawesome', 'Demo\DemoIconController@fontawesome');
    Route::get('/demo/icon/glyphicons', 'Demo\DemoIconController@glyphicons');

});

Auth::routes();


