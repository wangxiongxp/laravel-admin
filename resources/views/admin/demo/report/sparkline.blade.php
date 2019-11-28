<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
</head>
<body class="gray-bg">
    <div class="wrapper wrapper-content animated fadeInDown">
        <div class="row">
            <div class="col-sm-5">
                <div class="jumbotron">
                    <h1>Sparkline</h1>
                    <p>这是另一个可视化图表库</p>
                    <p><a href="http://omnipotent.net/jquery.sparkline" target="_blank" class="btn btn-primary btn-lg" role="button">了解 Sparkline</a>
                    </p>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Sparkline图表 <small>自定义颜色</small></h5>
                        <div class="ibox-tools">
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div>
                        <table class="table table-bordered white-bg">
                            <thead>
                                <tr>
                                    <th>图表</th>
                                    <th>类型</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>
                                        <span id="sparkline1"></span>
                                    </td>
                                    <td>
                                        内联线性图
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span id="sparkline2"></span>
                                    </td>
                                    <td>
                                        柱状图
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span id="sparkline3"></span>
                                    </td>
                                    <td>
                                        饼状图
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span id="sparkline4"></span>
                                    </td>
                                    <td>
                                        长线性图
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span id="sparkline5"></span>
                                    </td>
                                    <td>
                                        三态图
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span id="sparkline6"></span>
                                    </td>
                                    <td>
                                        散点图
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>自定义饼状图尺寸</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="graph_sparkline.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="graph_sparkline.html#">选项1</a>
                                </li>
                                <li><a href="graph_sparkline.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content text-center h-200">
                        <span id="sparkline7"></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>自定义柱状图尺寸</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="graph_sparkline.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="graph_sparkline.html#">选项1</a>
                                </li>
                                <li><a href="graph_sparkline.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content text-center h-200">
                        <span id="sparkline8"></span>
                    </div>
                </div>
            </div>
            <div class="col-sm-4">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>自定义线性图尺寸</h5>
                        <div class="ibox-tools">
                            <a class="collapse-link">
                                <i class="fa fa-chevron-up"></i>
                            </a>
                            <a class="dropdown-toggle" data-toggle="dropdown" href="graph_sparkline.html#">
                                <i class="fa fa-wrench"></i>
                            </a>
                            <ul class="dropdown-menu dropdown-user">
                                <li><a href="graph_sparkline.html#">选项1</a>
                                </li>
                                <li><a href="graph_sparkline.html#">选项2</a>
                                </li>
                            </ul>
                            <a class="close-link">
                                <i class="fa fa-times"></i>
                            </a>
                        </div>
                    </div>
                    <div class="ibox-content text-center h-200">
                        <span id="sparkline9"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.footer')
    <script src="/static/ajax/libs/report/sparkline/jquery.sparkline.min.js"></script>
    <script type="text/javascript">
	    $(function () {
	        $("#sparkline1").sparkline([34, 43, 43, 35, 44, 32, 44, 52, 25], {
	            type: 'line',
	            lineColor: '#17997f',
	            fillColor: '#1ab394',
	        });
	        $("#sparkline2").sparkline([5, 6, 7, 2, 0, -4, -2, 4], {
	            type: 'bar',
	            barColor: '#1ab394',
	            negBarColor: '#c6c6c6'});

	        $("#sparkline3").sparkline([1, 1, 2], {
	            type: 'pie',
	            sliceColors: ['#1ab394', '#b3b3b3', '#e4f0fb']});

	        $("#sparkline4").sparkline([34, 43, 43, 35, 44, 32, 15, 22, 46, 33, 86, 54, 73, 53, 12, 53, 23, 65, 23, 63, 53, 42, 34, 56, 76, 15, 54, 23, 44], {
	            type: 'line',
	            lineColor: '#17997f',
	            fillColor: '#ffffff',
	        });

	        $("#sparkline5").sparkline([1, 1, 0, 1, -1, -1, 1, -1, 0, 0, 1, 1], {
	            type: 'tristate',
	            posBarColor: '#1ab394',
	            negBarColor: '#bfbfbf'});


	        $("#sparkline6").sparkline([4, 6, 7, 7, 4, 3, 2, 1, 4, 4, 5, 6, 3, 4, 5, 8, 7, 6, 9, 3, 2, 4, 1, 5, 6, 4, 3, 7, ], {
	            type: 'discrete',
	            lineColor: '#1ab394'});

	        $("#sparkline7").sparkline([52, 12, 44], {
	            type: 'pie',
	            height: '150px',
	            sliceColors: ['#1ab394', '#b3b3b3', '#e4f0fb']});

	        $("#sparkline8").sparkline([5, 6, 7, 2, 0, 4, 2, 4, 5, 7, 2, 4, 12, 14, 4, 2, 14, 12, 7], {
	            type: 'bar',
	            barWidth: 8,
	            height: '150px',
	            barColor: '#1ab394',
	            negBarColor: '#c6c6c6'});

	        $("#sparkline9").sparkline([34, 43, 43, 35, 44, 32, 15, 22, 46, 33, 86, 54, 73, 53, 12, 53, 23, 65, 23, 63, 53, 42, 34, 56, 76, 15, 54, 23, 44], {
	            type: 'line',
	            lineWidth: 1,
	            height: '150px',
	            lineColor: '#17997f',
	            fillColor: '#ffffff',
	        });
	    });
    </script>
</body>
</html>
