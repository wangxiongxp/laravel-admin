<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
    <link href="/static/ajax/libs/summernote/summernote.css" rel="stylesheet"/>
    <link href="/static/ajax/libs/summernote/summernote-bs3.css" rel="stylesheet"/>
</head>
<body class="gray-bg">
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>Summernote 富文本编辑器</h5>
                    </div>
                    <div class="ibox-content no-padding">
                        <div class="summernote">
                            <h2>若依后台管理系统</h2>
                            <p>ruoyi是一个完全响应式，基于Bootstrap3.3.6最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术，她提供了诸多的强大的可以重新组合的UI组件，并集成了最新的jQuery版本(v2.1.1)，当然，也集成了很多功能强大，用途广泛的就jQuery插件，她可以用于所有的Web应用程序，如<b>网站管理后台</b>，<b>网站会员中心</b>，<b>CMS</b>，<b>CRM</b>，<b>OA</b>等等，当然，您也可以对她进行深度定制，以做出更强系统。</p>
                            <p>
                                <b>当前版本：</b>v4.0.0
                            </p>
                            <p>
                                <span class="label label-warning">免费开源</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-content">
                        <h2>Summernote</h2>
                        <p>
                            Summernote是一个简单的基于Bootstrap的WYSIWYG富文本编辑器
                        </p>
                        <div class="alert alert-warning"> 官方文档请参考：
                            <a href="https://github.com/summernote/summernote">https://github.com/summernote/summernote</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>编辑/保存为html代码示例</h5>
                        <button id="edit" class="btn btn-primary btn-xs m-l-sm" onclick="edit()" type="button">编辑</button>
                        <button id="save" class="btn btn-primary  btn-xs" onclick="save()" type="button">保存</button>
                    </div>
                    <div class="ibox-content" id="eg">
                        <div class="click2edit wrapper">
                            <h3>你好，若依 </h3>
                            <p>H+是一个完全响应式，基于Bootstrap3.3.6最新版本开发的扁平化主题，她采用了主流的左右两栏式布局，使用了Html5+CSS3等现代技术，她提供了诸多的强大的可以重新组合的UI组件，并集成了最新的jQuery版本(v2.1.1)，当然，也集成了很多功能强大，用途广泛的就jQuery插件，她可以用于所有的Web应用程序，如<b>网站管理后台</b>，<b>网站会员中心</b>，<b>CMS</b>，<b>CRM</b>，<b>OA</b>等等，当然，您也可以对她进行深度定制，以做出更强系统。</p>
                            <p>
                                <b>当前版本：</b>v4.0.0
                            </p>
                            <p>
                                <span class="label label-warning">开源免费</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('admin.layouts.footer')
    <script src="/static/ajax/libs/summernote/summernote.min.js"></script>
    <script src="/static/ajax/libs/summernote/summernote-zh-CN.js"></script>
    <script>
        $(document).ready(function () {
            $('.summernote').summernote({
                lang: 'zh-CN'
            });
        });
        var edit = function () {
            $("#eg").addClass("no-padding");
            $('.click2edit').summernote({
                lang: 'zh-CN',
                focus: true
            });
        };
        var save = function () {
            $("#eg").removeClass("no-padding");
            var aHTML = $('.click2edit').summernote('code');
            $('.click2edit').summernote('destroy');
        };
    </script>
</body>
</html>
