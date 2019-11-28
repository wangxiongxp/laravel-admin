<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
</head>
<body class="gray-bg">
	<div class="wrapper wrapper-content fadeInRight">
	    <div class="row">
	        <div class="col-sm-6">
	            <div class="ibox">
	                <div class="ibox-title">
	                <h5>信息框</h5>
	                </div>
	                <div class="ibox-content" id="test">
	                    <p>通过调用<code>$.modal.alert()</code>实现。 </p>
	                    <button type="button" class="btn btn-primary" onclick="$.modal.alert('Hi，你好！')">普通</button>
	                    <button type="button" class="btn btn-success" onclick="$.modal.alertSuccess('Hi，你好！')">成功</button>
	                    <button type="button" class="btn btn-warning" onclick="$.modal.alertWarning('Hi，你好！')">警告</button>
	                    <button type="button" class="btn btn-danger" onclick="$.modal.alertError('Hi，你好！')">失败</button>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-6">
	            <div class="ibox">
	                <div class="ibox-title">
	                <h5>提示框</h5>
	                </div>
	                <div class="ibox-content">
	                    <p>通过调用<code>$.modal.msg()</code>实现。 </p>
	                    <button type="button" class="btn btn-primary" onclick="$.modal.msg('Hi，你好！')">普通</button>
	                    <button type="button" class="btn btn-success" onclick="$.modal.msgSuccess('Hi，你好！')">成功</button>
	                    <button type="button" class="btn btn-warning" onclick="$.modal.msgWarning('Hi，你好！')">警告</button>
	                    <button type="button" class="btn btn-danger" onclick="$.modal.msgError('Hi，你好！')">失败</button>
	                </div>
	            </div>
	        </div>
	    </div>
	    <div class="row">
	        <div class="col-sm-6">
	            <div class="ibox">
	                <div class="ibox-title">
	                <h5>询问框</h5>
	                </div>
	                <div class="ibox-content">
	                    <p>通过调用<code>$.modal.confirm()</code>实现。 </p>
	                    <button type="button" class="btn btn-primary" id="button-confirm">询问按钮</button>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-6">
	            <div class="ibox ">
	                <div class="ibox-title">
	                <h5>消息提示并刷新父窗体</h5>
	                </div>
	                <div class="ibox-content">
	                    <p>通过调用<code>$.modal.msgReload()</code>实现。 </p>
	                    <button type="button" class="btn btn-primary" id="button-msgReload">提示刷新按钮</button>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-6">
	            <div class="ibox">
	                <div class="ibox-title">
	                <h5>普通弹出层</h5>
	                </div>
	                <div class="ibox-content">
	                    <p>通过调用<code>$.modal.open()</code>实现。 </p>
	                    <button type="button" class="btn btn-primary" id="button-open-1">默认</button>
	                    <button type="button" class="btn btn-success" id="button-open-2">设置宽高</button>
	                    <button type="button" class="btn btn-warning" id="button-open-3">回调函数</button>
	                    <button type="button" class="btn btn-danger" id="button-open-4">自定义选项</button>
	                    <button type="button" class="btn btn-primary" id="button-open-5">全屏弹出</button>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-6">
	            <div class="ibox">
	                <div class="ibox-title">
	                <h5>选卡页方式</h5>
	                </div>
	                <div class="ibox-content">
	                    <p>通过调用<code>$.modal.openTab()</code>实现。 </p>
	                    <button type="button" class="btn btn-primary" id="button-open-6">新窗口打开</button>
	                    <button type="button" class="btn btn-warning" id="button-open-7">关闭当前</button>
	                    <button type="button" class="btn btn-primary" id="button-open-14">选卡页同一页签打开</button>
	                    <button type="button" class="btn btn-warning" id="button-open-15">关闭指定</button>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-6">
	            <div class="ibox">
	                <div class="ibox-title">
	                <h5>其他内容</h5>
	                </div>
	                <div class="ibox-content">
	                    <p>通过调用<code>layer</code>实现。 </p>
	                    <button type="button" class="btn btn-primary" id="button-open-8">tab层</button>
	                    <button type="button" class="btn btn-primary" id="button-open-9">prompt层</button>
	                    <button type="button" class="btn btn-primary" id="button-open-10">捕获页</button>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-6">
	            <div class="ibox">
	                <div class="ibox-title">
	                <h5>遮罩层</h5>
	                </div>
	                <div class="ibox-content">
	                    <p>通过调用<code>blockUI</code>实现。 </p>
	                    <button type="button" class="btn btn-primary" id="button-open-11">打开</button>
	                    <button type="button" class="btn btn-warning" id="button-open-12">关闭</button>
	                    <button type="button" class="btn btn-primary" id="button-open-13">layer遮罩</button>
	                </div>
	            </div>
	        </div>
	        <div class="col-sm-12">
	            <div class="ibox">
	                <div class="ibox-title">
                        <label class="font-noraml">相关参数详细信息</label>
                        <div><a href="http://doc.ruoyi.vip/#/standard/zjwd?id=layer" target="_blank">http://doc.ruoyi.vip/#/standard/zjwd?id=layer</a></div>
                    </div>
                </div>
	        </div>
	    </div>
	</div>
        @include('admin.layouts.footer')
    <script type="text/javascript">
        var prefix = "/demo/modal";

	    $("#button-confirm").click(function(){
	    	$.modal.confirm("确认要点击确定吗?", function() {
	    		$.modal.alert("ok");
	    	});
	    })

	    $("#button-msgReload").click(function(){
	        $.modal.msgReload("保存成功,正在刷新数据请稍后……", modal_status.SUCCESS);
	    })

	    $("#button-open-1").click(function(){
	    	$.modal.open('添加用户', prefix + "/form");
	    })

	    $("#button-open-2").click(function(){
	    	$.modal.open('添加用户', prefix + "/form", '900', '320');
	    })

	    $("#button-open-3").click(function(){
	    	$.modal.open('添加用户', prefix + "/form", '900', '320', callback);
	    })

	    $("#button-open-4").click(function(){
	    	var btn = ['<i class="fa fa-check"></i> 点我回调', '<i class="fa fa-close"></i> 点我关闭'];
			var options = {
				title: '添加用户',
				width: "900",
				height: "320",
				url: prefix + "/form",
				btn: btn,
				callBack: doSubmit
			};
			$.modal.openOptions(options);
	    })

	    function doSubmit(index, layero) {
	    	alert("进入了自定义选项提交方法");
	    }

	    function callback(index, layero) {
	    	alert("进入了回调函数提交方法");
	    }

	    $("#button-open-5").click(function(){
	    	$.modal.openFull('添加用户', prefix + "/form");
	    })

	    $("#button-open-6").click(function(){
	    	$.modal.openTab('添加用户', prefix + "/form");
	    })

	    $("#button-open-7").click(function(){
	    	$.modal.closeTab();
	    })

	     $("#button-open-8").click(function(){
	    	//tab层
	    	 layer.tab({
	    	     area: ['600px', '300px'],
	    	     tab: [{
	    	         title: 'TAB1',
	    	         content: '内容1'
	    	     },
	    	     {
	    	         title: 'TAB2',
	    	         content: '内容2'
	    	     },
	    	     {
	    	         title: 'TAB3',
	    	         content: '内容3'
	    	     }]
	    	 });
	    })

	    $("#button-open-9").click(function(){
	    	layer.prompt({title: '输入任何口令，并确认', formType: 1}, function(pass, index){
	    	  layer.close(index);
	    	  layer.prompt({title: '随便写点啥，并确认', formType: 2}, function(text, index){
	    	    layer.close(index);
	    	    layer.msg('演示完毕！您的口令：'+ pass +'<br>您最后写下了：'+text);
	    	  });
	    	});
	    })

	    $("#button-open-10").click(function(){
	    	layer.open({
    		  type: 1,
    		  shade: false,
    		  title: false, //不显示标题
    		  content: $('#test'), //捕获的元素，注意：最好该指定的元素要存放在body最外层，否则可能被其它的相对元素所影响
    		  cancel: function(){
    		    layer.msg('捕获就是从页面已经存在的元素上，包裹layer的结构', {time: 5000, icon:6});
    		  }
    		});
	    })

	    $("#button-open-11").click(function(){
	    	$.modal.loading("数据加载中");
	    })

	    $("#button-open-12").click(function(){
	    	$.modal.closeLoading();
	    })

	    $("#button-open-13").click(function(){
	    	layer.load(0, {shade: false}); // 0代表加载的风格，支持0-2
	    })

	    $("#button-open-14").click(function(){
	    	$.modal.parentTab('添加用户', prefix + "/form");
	    })

	    $("#button-open-15").click(function(){
	    	// 需要关闭窗口的url
	    	$.modal.closeTab(prefix + "/form");
	    })
	</script>
</body>
</html>
