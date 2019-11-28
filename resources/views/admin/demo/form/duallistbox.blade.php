<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
    <link href="/static/ajax/libs/duallistbox/bootstrap-duallistbox.min.css" rel="stylesheet"/>
</head>
<body class="gray-bg">
	<div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox">
                    <div class="ibox-title">
                        <h5>双重列表框 <small>https://github.com/istvan-ujjmeszaros/bootstrap-duallistbox</small></h5>
                    </div>
                    <div class="ibox-content">
                        <p>
                            Bootstrap Dual Listbox是针对Twitter Bootstrap进行了优化的响应式双列表框。它适用于所有现代浏览器和触摸设备。
                        </p>
                        <form id="form" action="#" class="wizard-big">
                            <select class="form-control dual_select" multiple>
                                <option value="1">若依1</option>
                                <option value="2">若依2</option>
                                <option value="3">若依3</option>
                                <option selected value="4">若依4</option>
                                <option selected value="5">若依5</option>
                                <option value="6">若依6</option>
                                <option value="7">若依7</option>
                                <option value="8">若依8</option>
                                <option value="9">若依9</option>
                                <option value="10">若依10</option>
                                <option value="11">若依11</option>
                                <option value="12">若依12</option>
                            </select>
                        </form>
                        <hr>
                        <div class="form-group">
                            <label class="font-noraml">相关参数详细信息</label>
                            <div><a href="http://doc.ruoyi.vip/ruoyi/document/zjwd.html#bootstrap-duallistbox" target="_blank">http://doc.ruoyi.vip/ruoyi/document/zjwd.html#bootstrap-duallistbox</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.footer')
    <script src="/static/ajax/libs/duallistbox/bootstrap-duallistbox.min.js"></script>
    <script type="text/javascript">
	    $('.dual_select').bootstrapDualListbox({
	    	nonSelectedListLabel: '未有用户',
            selectedListLabel: '已有用户',
            preserveSelectionOnMove: 'moved',
            moveOnSelect: false,           // 出现一个剪头，表示可以一次选择一个
            filterTextClear: '展示所有',
            moveSelectedLabel: "添加",
            moveAllLabel: '添加所有',
            removeSelectedLabel: "移除",
            removeAllLabel: '移除所有',
            infoText: '共{0}个',
            showFilterInputs: false,       // 是否带搜索
	        selectorMinimalHeight: 160
	    });
    </script>
</body>
</html>
