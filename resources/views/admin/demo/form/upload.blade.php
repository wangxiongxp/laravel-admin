<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
    <link href="/static/ajax/libs/bootstrap-fileinput/fileinput.min.css" rel="stylesheet"/>
</head>
<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>文件上传控件 <small>https://github.com/kartik-v/bootstrap-fileinput</small></h5>
                    </div>
                    <div class="ibox-content">
                    	<div class="form-group">
                            <label class="font-noraml">简单示例</label>
	                        <div class="file-loading">
					            <input class="file" type="file" multiple data-min-file-count="1" data-theme="fas">
					        </div>
                        </div>
                        <div class="form-group">
                            <label class="font-noraml">多文件上传</label>
	                        <div class="file-loading">
					            <input id="fileinput-demo-1" type="file" multiple>
					        </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="font-noraml">相关参数详细信息</label>
                            <div><a href="http://doc.ruoyi.vip/ruoyi/document/zjwd.html#bootstrap-fileinput" target="_blank">http://doc.ruoyi.vip/ruoyi/document/zjwd.html#bootstrap-fileinput</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@include('admin.layouts.footer')
<script src="/static/ajax/libs/bootstrap-fileinput/fileinput.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function () {
        $("#fileinput-demo-1").fileinput({
            'theme': 'explorer-fas',
            'uploadUrl': '#',
            overwriteInitial: false,
            initialPreviewAsData: true,
            initialPreview: [
                "/static/img/profile.jpg"
            ]
        });
    });
    </script>
</body>
</html>
