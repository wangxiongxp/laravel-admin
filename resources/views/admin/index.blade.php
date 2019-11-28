@inject('configService', 'App\Services\ConfigService')

<!DOCTYPE html>
<html lang="zh">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <title>若依系统首页</title>
    <!--[if lt IE 9]>
    <meta http-equiv="refresh" content="0;ie.html"/>
    <![endif]-->
    <link href="/static/favicon.ico" rel="shortcut icon" />
    <link href="/static/css/bootstrap.min.css" rel="stylesheet"/>
    <link href="/static/css/jquery.contextMenu.min.css" rel="stylesheet"/>
    <link href="/static/css/font-awesome.min.css" rel="stylesheet"/>
    <link href="/static/css/animate.css" rel="stylesheet"/>
    <link href="/static/css/style.css" rel="stylesheet"/>
    <link href="/static/css/skins.css" rel="stylesheet"/>
    <link href="/static/ruoyi/css/ry-ui.css" rel="stylesheet"/>
</head>
<body class="fixed-sidebar full-height-layout gray-bg" style="overflow: hidden">
<div id="wrapper">

    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close">
            <i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse" >
            <ul class="nav" id="side-menu">
                <li class="logo">
                    <span class="logo-lg">RuoYi</span>
            	</li>
            	<li>
            		<div class="user-panel">
            			<a class="menuItem" title="个人中心" href="/system/user/profile">
            				<div class="hide">个人中心</div>
					        <div class="pull-left image">
		                    	<img src="/static/img/profile.jpg" class="img-circle" alt="User Image">
					        </div>
				        </a>
				        <div class="pull-left info">
				          <p>{{Auth::user()->user_name}}</p>
				          <a href="#"><i class="fa fa-circle text-success"></i> 在线</a>
				          <a href="/admin/logout" style="padding-left:5px;"><i class="fa fa-sign-out text-danger"></i> 注销</a>
				        </div>
				    </div>
            	</li>
                <li class="active">
                    <a href="index.html"><i class="fa fa-home"></i> <span class="nav-label">主页</span> <span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level">
                        <li class="active"><a class="menuItem" href="/system/main">了解若依</a></li>
                    </ul>
                </li>
                @foreach ($menus as $menu)
                <li>
                	<a class="{{$menu['url'] != '' && $menu['url'] != '#' ? $menu['target'] : ''}}" href="{{$menu['url'] == '' ? '#' : $menu['url']}}">
                		<i class="{{$menu['icon']??'fa fa-bar-chart-o'}}"></i>
                    	<span class="nav-label">{{$menu['menu_name']}}</span>
                    	<span class="{{$menu['url'] == '' || $menu['url'] == '#' ? 'fa arrow' : '' }}"></span>
                	</a>
                    <ul class="nav nav-second-level collapse">
                        @foreach ($menu['children'] as $sub_menu)
						<li>
                            @if (isset($sub_menu['children']))
                                <a href="#">{{$sub_menu['menu_name']}}<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    @foreach ($sub_menu['children'] as $sub_sub_menu)
                                    <li><a class="{{$sub_sub_menu['target'] == '' ? 'menuItem' : $sub_sub_menu['target']}}" href="{{$sub_sub_menu['url']}}">{{$sub_sub_menu['menu_name']}}</a></li>
                                    @endforeach
                                </ul>
                            @else
                                <a class="{{$sub_menu['target'] == '' ? 'menuItem' : $sub_menu['target'] }}" href="{{$sub_menu['url']}}">{{$sub_menu['menu_name']}}</a>
                            @endif
						</li>
                        @endforeach
					</ul>
                </li>
                @endforeach
                @if (config('app.demo_enabled', 'false'))
                <li>
                    <a href="#"><i class="fa fa-desktop"></i><span class="nav-label">实例演示</span><span class="fa arrow"></span></a>
                    <ul class="nav nav-second-level collapse">
                        <li> <a>表单<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
								<li><a class="menuItem" href="/demo/form/button">按钮</a></li>
								<li><a class="menuItem" href="/demo/form/grid">栅格</a></li>
								<li><a class="menuItem" href="/demo/form/select">下拉框</a></li>
								<li><a class="menuItem" href="/demo/form/timeline">时间轴</a></li>
								<li><a class="menuItem" href="/demo/form/basic">基本表单</a></li>
								<li><a class="menuItem" href="/demo/form/cards">卡片列表</a></li>
								<li><a class="menuItem" href="/demo/form/jasny">功能扩展</a></li>
								<li><a class="menuItem" href="/demo/form/sortable">拖动排序</a></li>
								<li><a class="menuItem" href="/demo/form/tabs_panels">选项卡 & 面板</a></li>
								<li><a class="menuItem" href="/demo/form/validate">表单校验</a></li>
								<li><a class="menuItem" href="/demo/form/wizard">表单向导</a></li>
								<li><a class="menuItem" href="/demo/form/upload">文件上传</a></li>
								<li><a class="menuItem" href="/demo/form/datetime">日期和时间</a></li>
								<li><a class="menuItem" href="/demo/form/summernote">富文本编辑器</a></li>
								<li><a class="menuItem" href="/demo/form/duallistbox">左右互选组件</a></li>
								<li><a class="menuItem" href="/demo/form/autocomplete">搜索自动补全</a></li>
							</ul>
                        </li>
                        <li> <a>表格<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
								<li><a class="menuItem" href="/demo/table/search">查询条件</a></li>
								<li><a class="menuItem" href="/demo/table/footer">数据汇总</a></li>
								<li><a class="menuItem" href="/demo/table/groupHeader">组合表头</a></li>
								<li><a class="menuItem" href="/demo/table/export">表格导出</a></li>
								<li><a class="menuItem" href="/demo/table/remember">翻页记住选择</a></li>
								<li><a class="menuItem" href="/demo/table/pageGo">跳转至指定页</a></li>
								<li><a class="menuItem" href="/demo/table/params">自定义查询参数</a></li>
								<li><a class="menuItem" href="/demo/table/multi">初始多表格</a></li>
								<li><a class="menuItem" href="/demo/table/button">点击按钮加载表格</a></li>
								<li><a class="menuItem" href="/demo/table/fixedColumns">表格冻结列</a></li>
								<li><a class="menuItem" href="/demo/table/event">自定义触发事件</a></li>
								<li><a class="menuItem" href="/demo/table/detail">表格细节视图</a></li>
								<li><a class="menuItem" href="/demo/table/child">表格父子视图</a></li>
								<li><a class="menuItem" href="/demo/table/image">表格图片预览</a></li>
								<li><a class="menuItem" href="/demo/table/curd">动态增删改查</a></li>
								<li><a class="menuItem" href="/demo/table/reorder">表格拖拽操作</a></li>
								<li><a class="menuItem" href="/demo/table/editable">表格行内编辑</a></li>
								<li><a class="menuItem" href="/demo/table/other">表格其他操作</a></li>
							</ul>
                        </li>
                        <li> <a>弹框<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
								<li><a class="menuItem" href="/demo/modal/dialog">模态窗口</a></li>
								<li><a class="menuItem" href="/demo/modal/layer">弹层组件</a></li>
								<li><a class="menuItem" href="/demo/modal/table">弹层表格</a></li>
							</ul>
                        </li>
                        <li> <a>操作<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
								<li><a class="menuItem" href="/demo/operate/table">表格</a></li>
								<li><a class="menuItem" href="/demo/operate/other">其他</a></li>
							</ul>
                        </li>
                        <li> <a>报表<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
								<li><a class="menuItem" href="/demo/report/echarts">百度ECharts</a></li>
								<li><a class="menuItem" href="/demo/report/peity">peity</a></li>
								<li><a class="menuItem" href="/demo/report/sparkline">sparkline</a></li>
								<li><a class="menuItem" href="/demo/report/metrics">图表组合</a></li>
							</ul>
                        </li>
                        <li> <a>图标<span class="fa arrow"></span></a>
                            <ul class="nav nav-third-level">
								<li><a class="menuItem" href="/demo/icon/fontawesome">Font Awesome</a></li>
								<li><a class="menuItem" href="/demo/icon/glyphicons">Glyphicons</a></li>
							</ul>
                        </li>
                        <li>
	                        <a href="#"><i class="fa fa-sitemap"></i> <span class="nav-label">四层菜单 </span><span class="fa arrow"></span></a>
	                        <ul class="nav nav-second-level collapse">
	                            <li>
	                                <a href="#" id="damian">三级菜单1<span class="fa arrow"></span></a>
	                                <ul class="nav nav-third-level">
	                                    <li>
	                                        <a href="#">四级菜单1</a>
	                                    </li>
	                                    <li>
	                                        <a href="#">四级菜单2</a>
	                                    </li>
	                                </ul>
	                            </li>
	                            <li><a href="#">三级菜单2</a></li>
	                        </ul>
	                    </li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->

    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <div class="navbar-header">
                    <a class="navbar-minimalize minimalize-styl-2" style="color:#FFF;" href="#" title="收起菜单">
                    	<i class="fa fa-bars"></i>
                    </a>
                </div>
                <ul class="nav navbar-top-links navbar-right welcome-message">
				    <li><a title="视频教程" href="http://doc.ruoyi.vip/ruoyi/document/spjc.html" target="_blank"><i class="fa fa-video-camera"></i> 视频教程</a></li>
                    <li><a title="开发文档" href="http://doc.ruoyi.vip" target="_blank"><i class="fa fa-question-circle"></i> 开发文档</a></li>
	                <li><a title="全屏显示" href="javascript:void(0)" id="fullScreen"><i class="fa fa-arrows-alt"></i> 全屏显示</a></li>
                    <li class="dropdown user-menu">
						<a href="javascript:void(0)" class="dropdown-toggle" data-hover="dropdown">
							<img src="/static/img/profile.jpg" class="user-image">
							<span class="hidden-xs">{{Auth::user()->user_name}}</span>
						</a>
						<ul class="dropdown-menu">
							<li class="mt5">
								<a href="/system/user/profile" class="menuItem">
								<i class="fa fa-user"></i> 个人中心</a>
							</li>
							<li>
								<a onclick="resetPwd()">
								<i class="fa fa-key"></i> 修改密码</a>
							</li>
							<li>
								<a onclick="switchSkin()">
								<i class="fa fa-dashboard"></i> 切换主题</a>
							</li>
							<li class="divider"></li>
							<li>
								<a href="/admin/logout">
								<i class="fa fa-sign-out"></i> 退出登录</a>
							</li>
						</ul>
					</li>
                </ul>
            </nav>
        </div>
        <div class="row content-tabs">
            <button class="roll-nav roll-left tabLeft">
                <i class="fa fa-backward"></i>
            </button>
            <nav class="page-tabs menuTabs">
                <div class="page-tabs-content">
                    <a href="javascript:;" class="active menuTab" data-id="/system/main">首页</a>
                </div>
            </nav>
            <button class="roll-nav roll-right tabRight">
                <i class="fa fa-forward"></i>
            </button>
            <a href="javascript:void(0);" class="roll-nav roll-right tabReload"><i class="fa fa-refresh"></i> 刷新</a>
        </div>

        <a id="ax_close_max" class="ax_close_max" href="#" title="关闭全屏"> <i class="fa fa-times-circle-o"></i> </a>

        <div class="row mainContent" id="content-main">
            <iframe class="RuoYi_iframe" name="iframe0" width="100%" height="100%" data-id="/system/main"
                    src="/system/main" frameborder="0" seamless></iframe>
        </div>
        <div class="footer">
            <div class="pull-right">© {{ config('app.copyright_year', '2019') }} RuoYi Copyright </div>
        </div>
    </div>
    <!--右侧部分结束-->
</div>
<!-- 全局js -->
<script src="/static/js/jquery.min.js"></script>
<script src="/static/js/bootstrap.min.js"></script>
<script src="/static/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/static/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/static/js/jquery.contextMenu.min.js"></script>
<script src="/static/ajax/libs/blockUI/jquery.blockUI.js"></script>
<script src="/static/ajax/libs/layer/layer.min.js"></script>
<script src="/static/ruoyi/js/ry-ui.js?v=4.0.2"></script>
<script src="/static/ruoyi/js/common.js?v=4.0.0"></script>
<script src="/static/ruoyi/index.js"></script>
<script src="/static/ajax/libs/fullscreen/jquery.fullscreen.js"></script>
<script type="text/javascript">
var ctx = '/';
var skin = storage.get("skin");
// 本地主题优先，未设置取系统配置
if($.common.isNotEmpty(skin)){
	$("body").addClass(skin.split('|')[0]);
	$("body").addClass(skin.split('|')[1]);
} else {
	var sideTheme = '{{ $configService->getKey('sys.index.sideTheme') }}' ;
	var skinName = '{{ $configService->getKey('sys.index.skinName') }}';
	$("body").addClass(sideTheme);
	$("body").addClass(skinName);
}

/* 用户管理-重置密码 */
function resetPwd() {
    var url = '/system/user/profile/resetPwd';
    $.modal.open("重置密码", url, '770', '380');
}
/* 切换主题 */
function switchSkin() {
    layer.open({
		type : 2,
		shadeClose : true,
		title : "切换主题",
		area : ["530px", "386px"],
		content : [ "/system/switchSkin", 'no']
	})
}

// 排除非左侧菜单链接
var excludesUrl = ["/system/user/profile"];

$(function() {
    var hash = location.hash;
    if (hash !== '') {
        var url = hash.substring(1, hash.length);
        $('a[href$="' + decodeURI(url) + '"]').click();
        if($.inArray(url, excludesUrl)){
            $('a[href$="' + url + '"]').parent("li").addClass("selected").parents("li").addClass("active").end().parents("ul").addClass("in");
        }
    }
});
</script>
</body>
</html>
