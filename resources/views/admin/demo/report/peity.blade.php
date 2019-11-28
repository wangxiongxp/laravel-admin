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
                    <h1>Peity图表</h1>
                    <p>是一个内嵌数据图形可视化的图表库</p>
                    <p><a href="http://benpickles.github.io/peity/" target="_blank" class="btn btn-primary btn-lg" role="button">了解 Peity</a>
                    </p>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>饼状图 <small>自定义颜色</small></h5>
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
                                    <th>代码</th>
                                </tr>
                            </thead>

                            <tbody>
                                <tr>
                                    <td>
                                        <span class="pie">1/5</span>
                                    </td>
                                    <td>
                                        <code>&lt;span class="pie"&gt;1/5&lt;/span&gt;</code>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="pie">226/360</span>
                                    </td>
                                    <td>
                                        <code>&lt;span class="pie"&gt;226/360&lt;/span&gt;</code>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="pie">0.52/1.561</span>
                                    </td>
                                    <td>
                                        <code>&lt;span class="pie"&gt;0.52/1.561&lt;/span&gt;</code>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="pie">1,4</span>
                                    </td>
                                    <td>
                                        <code>&lt;span class="pie"&gt;1,4&lt;/span&gt;</code>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="pie">226,134</span>
                                    </td>
                                    <td>
                                        <code>&lt;span class="pie"&gt;226,134&lt;/span&gt;</code>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="pie">0.52,1.041</span>
                                    </td>
                                    <td>
                                        <code>&lt;span class="pie"&gt;0.52,1.041&lt;/span&gt;</code>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>线性图</h5>
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
                                    <th>代码</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>
                                        <span data-diameter="40" class="updating-chart">5,3,9,6,5,9,7,3,5,2,5,3,9,6,5,9,7,3,5,2</span>
                                    </td>
                                    <td>
                                        <code>&lt;span class="line"&gt;5,3,9,6,5,9,7,3,5,2&lt;/span&gt;</code>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="line">5,3,9,6,5,9,7,3,5,2</span>
                                    </td>
                                    <td>
                                        <code>&lt;span class="line"&gt;5,3,9,6,5,9,7,3,5,2&lt;/span&gt;</code>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="line">5,3,2,-1,-3,-2,2,3,5,2</span>
                                    </td>
                                    <td>
                                        <code>&lt;span class="line"&gt;5,3,2,-1,-3,-2,2,3,5,2&lt;/span&gt;</code>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="line">0,-3,-6,-4,-5,-4,-7,-3,-5,-2</span>
                                    </td>
                                    <td>
                                        <code>&lt;span class="line"&gt;0,-3,-6,-4,-5,-4,-7,-3,-5,-2&lt;/span&gt;</code>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="bar">5,3,9,6,5,9,7,3,5,2</span>
                                    </td>
                                    <td>
                                        <code>&lt;span class="bar"&gt;5,3,9,6,5,9,7,3,5,2&lt;/span&gt;</code>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <span class="bar">5,3,2,-1,-3,-2,2,3,5,2</span>
                                    </td>
                                    <td>
                                        <code>&lt;span class="bar"&gt;5,3,2,-1,-3,-2,2,3,5,2&lt;/span&gt;</code>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.footer')
    <script src="/static/ajax/libs/report/peity/jquery.peity.min.js"></script>
    <script type="text/javascript">
	    $(function() {
	        $("span.pie").peity("pie", {
	            fill: ['#1ab394', '#d7d7d7', '#ffffff']
	        })

	        $(".line").peity("line",{
	            fill: '#1ab394',
	            stroke:'#169c81',
	        })

	        $(".bar").peity("bar", {
	            fill: ["#1ab394", "#d7d7d7"]
	        })

	        $(".bar_dashboard").peity("bar", {
	            fill: ["#1ab394", "#d7d7d7"],
	            width:100
	        })

	        var updatingChart = $(".updating-chart").peity("line", { fill: '#1ab394',stroke:'#169c81', width: 64 })

	        setInterval(function() {
	            var random = Math.round(Math.random() * 10)
	            var values = updatingChart.text().split(",")
	            values.shift()
	            values.push(random)

	            updatingChart
	                .text(values.join(","))
	                .change()
	        }, 1000);

	    });
    </script>
</body>
</html>
