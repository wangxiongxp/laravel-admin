<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
    <link href="/static/ajax/libs/bootstrap-select/bootstrap-select.css" rel="stylesheet"/>
</head>
<body class="gray-bg">
    <div class="container-div">
		<div class="row">
			<div class="col-sm-12 search-collapse">
			    <p class="select-title">普通条件查询</p>
				<form id="ordinary-form">
					<div class="select-list">
						<ul>
							<li>
								商户编号：<input type="text" name="userId"/>
							</li>
							<li>
								终端编号：<input type="text" name="termId"/>
							</li>
							<li>
								处理状态：<select name="status">
									<option value="">所有</option>
									<option value="0">初始</option>
									<option value="1">处理中</option>
									<option value="2">交易成功</option>
									<option value="3">交易失败</option>
								</select>
							</li>
							<li>
								<a class="btn btn-primary btn-rounded btn-sm" onclick="$.table.search()"><i class="fa fa-search"></i>&nbsp;搜索</a>
							    <a class="btn btn-warning btn-rounded btn-sm" onclick="$.form.reset()"><i class="fa fa-refresh"></i>&nbsp;重置</a>
							</li>
						</ul>
					</div>
				</form>
			</div>
			<div class="col-sm-12 search-collapse">
			    <p class="select-title">时间条件查询</p>
				<form id="time-form">
					<div class="select-list">
						<ul>
							<li>
								商户编号：<input type="text" name="userId"/>
							</li>
							<li>
								终端编号：<input type="text" name="termId"/>
							</li>
							<li class="select-time">
								<label>创建时间： </label>
								<input type="text" class="time-input" id="startTime" placeholder="开始时间" name="params[beginTime]"/>
								<span>-</span>
								<input type="text" class="time-input" id="endTime" placeholder="结束时间" name="params[endTime]"/>
							</li>
							<li>
								<a class="btn btn-primary btn-rounded btn-sm" onclick="$.table.search()"><i class="fa fa-search"></i>&nbsp;搜索</a>
							    <a class="btn btn-warning btn-rounded btn-sm" onclick="$.form.reset('time-form')"><i class="fa fa-refresh"></i>&nbsp;重置</a>
							</li>
						</ul>
					</div>
				</form>
			</div>
			<div class="col-sm-12 search-collapse">
			    <p class="select-title">下拉多选条件查询</p>
				<form id="select-form">
					<div class="select-list">
						<ul>
							<li>
								商户编号：<input type="text" name="userId"/>
							</li>
							<li>
								终端编号：<input type="text" name="termId"/>
							</li>
							<li class="select-selectpicker">
								<label>操作类型： </label><select class="selectpicker" data-none-selected-text="请选择" multiple>
									<option value="">所有</option>
									<option value="0">初始</option>
									<option value="1">处理中</option>
									<option value="2">交易成功</option>
									<option value="3">交易失败</option>
								</select>
							</li>
							<li>
								<a class="btn btn-primary btn-rounded btn-sm" onclick="$.table.search()"><i class="fa fa-search"></i>&nbsp;搜索</a>
							    <a class="btn btn-warning btn-rounded btn-sm" onclick="$.form.reset('select-form')"><i class="fa fa-refresh"></i>&nbsp;重置</a>
							</li>
						</ul>
					</div>
				</form>
			</div>
			<div class="col-sm-12 search-collapse">
			    <p class="select-title">复杂条件查询</p>
				<form id="complex-form">
					<div class="select-list">
						<ul>
							<li>
								<p style="width: 80px">商户编号：</p>
								<input type="text" name="userId"/>
							</li>
							<li>
								<p style="width: 80px">订单号：</p>
								<input type="text" name="orderNo"/>
							</li>
							<li>
								<p style="width: 80px">日期：</p>
								<input type="text" class="time-input" placeholder="日期"/>
							</li>
							<li class="select-selectpicker">
								<p style="width: 80px">状态：</p>
								<select class="selectpicker" data-none-selected-text="请选择" multiple>
									<option value="">所有</option>
									<option value="0">初始</option>
									<option value="1">处理中</option>
									<option value="2">交易成功</option>
									<option value="3">交易失败</option>
								</select>
							</li>
							<li>
								<p style="width: 80px">供货商通道：</p>
								<select>
									<option value="">所有</option>
									<option value="0">腾讯</option>
									<option value="1">天猫</option>
									<option value="2">京东</option>
								</select>
							</li>
							<li>
								<p style="width: 80px">来源：</p>
								<select>
									<option value="">所有</option>
									<option value="0">手机</option>
									<option value="1">电脑</option>
									<option value="2">第三方</option>
								</select>
							</li>
							<li>
								<p style="width: 80px">运营商：</p>
								<select>
									<option value="">所有</option>
									<option value="0">移动</option>
									<option value="1">电信</option>
									<option value="2">联通</option>
								</select>
							</li>
							<li class="select-time">
								<p style="width: 80px">回调时间：</p>
								<input type="text" class="time-input" placeholder="开始时间"/>
								<span>-</span>
								<input type="text" class="time-input" placeholder="结束时间"/>
							</li>
							<li>
								<a class="btn btn-primary btn-rounded btn-sm m50" onclick="$.table.search()"><i class="fa fa-search"></i>&nbsp;搜索</a>
							    <a class="btn btn-warning btn-rounded btn-sm" onclick="$.form.reset('complex-form')"><i class="fa fa-refresh"></i>&nbsp;重置</a>
							</li>
						</ul>
					</div>
				</form>
			</div>
		</div>
	</div>
    @include('admin.layouts.footer')
    <script src="/static/ajax/libs/bootstrap-select/bootstrap-select.js"></script>
</body>
</html>
