<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
    <link href="/static/ajax/libs/select2/select2.min.css" rel="stylesheet"/>
    <link href="/static/ajax/libs/select2/select2-bootstrap.css" rel="stylesheet"/>
    <link href="/static/ajax/libs/bootstrap-select/bootstrap-select.css" rel="stylesheet"/>
</head>
<body class="gray-bg">
     <form>
      <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>下拉框 <small>https://github.com/select2/select2</small></h5>
                    </div>
                    <div class="ibox-content">
                        <div class="form-group">
                            <label class="font-noraml">单选</label>
                            <select class="form-control">
                            	<option value="">--请选择开发语言--</option>
                            	<option value="Java">Java</option>
                            	<option value="PHP">PHP</option>
                            	<option value=".NET">.NET</option>
                            </select>
                        </div>
                        <div class="form-group">
                             <label class="font-noraml">分组单选</label>
                             <select class="form-control">
                               <optgroup label="--请选择开发语言--">
								 <option value="Java">Java</option>
                                 <option value="PHP">PHP</option>
                                 <option value=".NET">.NET</option>
							   </optgroup>
							   <optgroup label="--请选择数据库--">
							     <option value="Oracle">Oracle</option>
                                 <option value="Mysql">Mysql</option>
                                 <option value="Sysbase">Sysbase</option>
						       </optgroup>
                             </select>
                        </div>
                        <div class="form-group">
                            <label class="font-noraml">多选</label>
                            <select class="form-control select2-multiple" multiple>
                            	<option value="">请选择开发语言</option>
                            	<option value="Java">Java</option>
                            	<option value="PHP">PHP</option>
                            	<option value=".NET">.NET</option>
                            </select>
                        </div>
                        <div class="form-group">
                             <label class="font-noraml">分组多选</label>
                             <select class="form-control select2-multiple" multiple>
                               <optgroup label="--请选择开发语言--">
								 <option value="Java">Java</option>
                                 <option value="PHP">PHP</option>
                                 <option value=".NET">.NET</option>
							   </optgroup>
							   <optgroup label="--请选择数据库--">
							     <option value="Oracle">Oracle</option>
                                 <option value="Mysql">Mysql</option>
                                 <option value="Sysbase">Sysbase</option>
						       </optgroup>
                             </select>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="font-noraml">相关参数详细信息</label>
                            <div><a href="http://doc.ruoyi.vip/ruoyi/document/zjwd.html#select2" target="_blank">http://doc.ruoyi.vip/ruoyi/document/zjwd.html#select2</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>下拉框 <small>https://github.com/snapappointments/bootstrap-select</small></h5>
                    </div>
                     <div class="ibox-content">
                        <div class="form-group">
                            <label class="font-noraml">单选</label>
                            <select class="form-control noselect2 selectpicker">
                            	<option value="">--请选择开发语言--</option>
                            	<option value="Java">Java</option>
                            	<option value="PHP">PHP</option>
                            	<option value=".NET">.NET</option>
                            </select>
                        </div>
                        <div class="form-group">
                             <label class="font-noraml">分组多选</label>
                             <select class="form-control noselect2 selectpicker">
                               <optgroup label="--请选择开发语言--">
								 <option value="Java">Java</option>
                                 <option value="PHP">PHP</option>
                                 <option value=".NET">.NET</option>
							   </optgroup>
							   <optgroup label="--请选择数据库--">
							     <option value="Oracle">Oracle</option>
                                 <option value="Mysql">Mysql</option>
                                 <option value="Sysbase">Sysbase</option>
						       </optgroup>
                             </select>
                        </div>
                        <div class="form-group">
                            <label class="font-noraml">多选</label>
                            <select class="form-control noselect2 selectpicker" data-none-selected-text="请选择开发语言" multiple>
                            	<option value="Java">Java</option>
                            	<option value="PHP">PHP</option>
                            	<option value=".NET">.NET</option>
                            </select>
                        </div>
                        <div class="form-group">
                             <label class="font-noraml">分组多选</label>
                             <select class="form-control noselect2 selectpicker" data-none-selected-text="请选择" multiple>
                               <optgroup label="--请选择开发语言--">
								 <option value="Java">Java</option>
                                 <option value="PHP">PHP</option>
                                 <option value=".NET">.NET</option>
							   </optgroup>
							   <optgroup label="--请选择数据库--">
							     <option value="Oracle">Oracle</option>
                                 <option value="Mysql">Mysql</option>
                                 <option value="Sysbase">Sysbase</option>
						       </optgroup>
                             </select>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="font-noraml">相关参数详细信息</label>
                            <div><a href="http://doc.ruoyi.vip/ruoyi/document/zjwd.html#bootstrap-select" target="_blank">http://doc.ruoyi.vip/ruoyi/document/zjwd.html#bootstrap-select</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
   </form>
     @include('admin.layouts.footer')
     <!-- select2下拉框插件 -->
     <script src="/static/ajax/libs/select2/select2.min.js"></script>
     <!-- bootstrap-select下拉框插件 -->
     <script src="/static/ajax/libs/bootstrap-select/bootstrap-select.js"></script>
</body>
</html>
