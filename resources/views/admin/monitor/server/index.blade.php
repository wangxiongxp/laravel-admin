<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
</head>
<body class="gray-bg">
    <div class="wrapper wrapper-content">
        <div class="col-sm-12">
            <div class="row">
                <div class="col-sm-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>CPU</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link"><i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <table class="table table-hover no-margins">
                                <thead>
                                    <tr>
                                        <th>属性</th>
                                        <th>值</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>核心数</td>
                                        <td th:text="${server.cpu.cpuNum}">0个</td>
                                    </tr>
                                    <tr>
                                        <td>用户使用率</td>
                                        <td th:text="${server.cpu.used + '%'}">0%</td>
                                    </tr>
                                    <tr>
                                        <td>系统使用率</td>
                                        <td th:text="${server.cpu.sys + '%'}">0%</td>
                                    </tr>
                                    <tr>
                                        <td>当前空闲率</td>
                                        <td th:text="${server.cpu.free + '%'}">0%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-sm-6">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>内存</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link"><i class="fa fa-chevron-up"></i></a>
                                <a class="close-link"><i class="fa fa-times"></i></a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <table class="table table-hover no-margins">
                                <thead>
                                    <tr>
                                        <th>属性</th>
                                        <th>内存</th>
                                        <th>JVM</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>总内存</td>
                                        <td th:text="${server.mem.total + 'G'}">0GB</td>
                                        <td th:text="${server.jvm.total + 'M'}">0MB</td>
                                    </tr>
                                    <tr>
                                        <td>已用内存</td>
                                        <td th:text="${server.mem.used + 'G'}">0GB</td>
                                        <td th:text="${server.jvm.used + 'M'}">0MB</td>
                                    </tr>
                                    <tr>
                                        <td>剩余内存</td>
                                        <td th:text="${server.mem.free + 'G'}">0GB</td>
                                        <td th:text="${server.jvm.free + 'M'}">0MB</td>
                                    </tr>
                                    <tr>
                                        <td>使用率</td>
                                        <td th:class="${server.mem.usage gt 80} ? 'text-danger'">[[${server.mem.usage}]]%</td>
                                        <td th:class="${server.jvm.usage gt 80} ? 'text-danger'">[[${server.jvm.usage}]]%</td>
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
                            <h5>服务器信息</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">
                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-hover margin bottom">
                                        <tbody>
                                            <tr>
                                                <td>服务器名称</td>
                                                <td th:text="${server.sys.computerName}">RuoYi</td>
                                                <td>操作系统</td>
                                                <td th:text="${server.sys.osName}">Linux</td>
                                            </tr>
                                            <tr>
                                                <td>服务器IP</td>
                                                <td th:text="${server.sys.computerIp}">127.0.0.1</td>
                                                <td>系统架构</td>
                                                <td th:text="${server.sys.osArch}">amd64</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>Java虚拟机信息</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-hover margin bottom">
                                        <tbody>
                                            <tr>
                                                <td>Java名称</td>
                                                <td th:text="${server.jvm.name}">Java</td>
                                                <td>Java版本</td>
                                                <td th:text="${server.jvm.version}">1.8.0</td>
                                            </tr>
                                            <tr>
                                                <td>启动时间</td>
                                                <td th:text="${server.jvm.startTime}">2018-12-31 00:00:00</td>
                                                <td>运行时长</td>
                                                <td th:text="${server.jvm.runTime}">0天0时0分0秒</td>
                                            </tr>
                                            <tr>
                                                <td colspan="1">安装路径</td>
                                                <td colspan="3" th:text="${server.jvm.home}"></td>
                                            </tr>
                                             <tr>
                                                <td colspan="1">项目路径</td>
                                                <td colspan="3" th:text="${server.sys.userDir}"></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-12">
                    <div class="ibox float-e-margins">
                        <div class="ibox-title">
                            <h5>磁盘状态</h5>
                            <div class="ibox-tools">
                                <a class="collapse-link">
                                    <i class="fa fa-chevron-up"></i>
                                </a>
                                <a class="close-link">
                                    <i class="fa fa-times"></i>
                                </a>
                            </div>
                        </div>
                        <div class="ibox-content">

                            <div class="row">
                                <div class="col-sm-12">
                                    <table class="table table-hover margin bottom">
                                        <thead>
                                            <tr>
                                                <th>盘符路径</th>
                                                <th>文件系统</th>
                                                <th>盘符类型</th>
                                                <th>总大小</th>
                                                <th>可用大小</th>
                                                <th>已用大小</th>
                                                <th>已用百分比</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr th:each="sysFile : ${server.sysFiles}">
                                                <td th:text="${sysFile.dirName}">C:\</td>
                                                <td th:text="${sysFile.sysTypeName}">NTFS</td>
                                                <td th:text="${sysFile.typeName}">local</td>
                                                <td th:text="${sysFile.total}">0GB</td>
                                                <td th:text="${sysFile.free}">0GB</td>
                                                <td th:text="${sysFile.used}">0GB</td>
                                                <td th:class="${sysFile.usage gt 80} ? 'text-danger'">[[${sysFile.usage}]]%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
@include('admin.layouts.footer')
<script>
    $(".modal").appendTo("body"), $("[data-toggle=popover]").popover(), $(".collapse-link").click(function() {
        var div_ibox = $(this).closest("div.ibox"),
        e = $(this).find("i"),
        i = div_ibox.find("div.ibox-content");
        i.slideToggle(200),
        e.toggleClass("fa-chevron-up").toggleClass("fa-chevron-down"),
        div_ibox.toggleClass("").toggleClass("border-bottom"),
        setTimeout(function() {
        	div_ibox.resize();
        }, 50);
    }), $(".close-link").click(function () {
		var div_ibox = $(this).closest("div.ibox");
		div_ibox.remove()
	});
</script>
</html>
