@inject('dictService', 'App\Services\DictService')

<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
    <link href="/static/ajax/libs/summernote/summernote.css" rel="stylesheet"/>
    <link href="/static/ajax/libs/summernote/summernote-bs3.css" rel="stylesheet"/>
</head>
<body class="white-bg">
    <div class="wrapper wrapper-content animated fadeInRight ibox-content">
        <form class="form-horizontal m" id="form-notice-add">
			<div class="form-group">
				<label class="col-sm-2 control-label">公告标题：</label>
				<div class="col-sm-10">
					<input id="notice_title" name="notice_title" class="form-control" type="text" required>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">公告类型：</label>
				<div class="col-sm-10">
					<select name="notice_type" class="form-control m-b">
                        @foreach ($dictService->getType('sys_notice_type') as $dict)
                            <option value="{{$dict['dict_value']}}" {{$dict['is_default'] == 'Y' ? 'selected' : ''}}>{{$dict['dict_label']}}</option>
                        @endforeach
	                </select>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">公告内容：</label>
				<div class="col-sm-10">
				    <input id="notice_content" name="notice_content" type="hidden">
				    <div class="summernote"></div>
				</div>
			</div>
			<div class="form-group">
				<label class="col-sm-2 control-label">公告状态：</label>
				<div class="col-sm-10">
                    @foreach ($dictService->getType('sys_notice_status') as $dict)
                        <div class="radio-box">
                            <input type="radio" id="{{$dict['dict_code']}}" name="status" value="{{$dict['dict_value']}}" {{$dict['is_default'] == 'Y' ? 'checked' : ''}}>
                            <label for="{{$dict['dict_code']}}">{{$dict['dict_label']}}</label>
                        </div>
                    @endforeach
				</div>
			</div>
		</form>
	</div>
    @include('admin.layouts.footer')
    <script src="/static/ajax/libs/summernote/summernote.min.js"></script>
    <script src="/static/ajax/libs/summernote/summernote-zh-CN.js"></script>
    <script type="text/javascript">
        var prefix = "/system/notice";

	    $('.summernote').summernote({
	    	placeholder: '请输入公告内容',
			height : 192,
			lang : 'zh-CN',
			followingToolbar: false,
			callbacks: {
                onImageUpload: function (files) {
                    sendFile(files[0], this);
                }
            }
		});

	    // 上传文件
	    function sendFile(file, obj) {
	        var data = new FormData();
	        data.append("file", file);
	        $.ajax({
	            type: "POST",
	            url: ctx + "common/upload",
	            data: data,
	            cache: false,
	            contentType: false,
	            processData: false,
	            dataType: 'json',
	            success: function(result) {
	                if (result.code == web_status.SUCCESS) {
	                	$(obj).summernote('editor.insertImage', result.url, result.fileName);
					} else {
						$.modal.alertError(result.msg);
					}
	            },
	            error: function(error) {
	                $.modal.alertWarning("图片上传失败。");
	            }
	        });
	    }

		$("#form-notice-add").validate({
			focusCleanup: true
		});

		function submitHandler() {
	        if ($.validate.form()) {
	        	var sHTML = $('.summernote').summernote('code');
				$("#notice_content").val(sHTML);
				$.operate.save(prefix + "/save", $('#form-notice-add').serialize());
	        }
	    }
	</script>
</body>
</html>
