<!DOCTYPE html>
<html lang="zh">
<head>
    @include('admin.layouts.header')
</head>
<body class="gray-bg">
      <div class="wrapper wrapper-content animated fadeInRight">
        <div class="row">
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>搜索自动补全<small>https://github.com/lzwme/bootstrap-suggest-plugin</small></h5>
                    </div>
                    <div class="ibox-content">
                        <p>展示下拉菜单按钮。</p>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="suggest-demo-1">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p>不展示下拉菜单按钮。</p>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="suggest-demo-2">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <p>前端json中获取数据</p>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group">
                                    <input type="text" class="form-control" id="suggest-demo-3">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3>百度搜索</h3>
                        <p>支持逗号分隔多关键字</p>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group" style="width: 300px;">
                                    <input type="text" class="form-control" id="baidu">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3>淘宝搜索</h3>
                        <p>支持逗号分隔多关键字</p>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="input-group" style="width: 400px;">
                                    <input type="text" class="form-control" id="taobao">
                                    <div class="input-group-btn">
                                        <button type="button" class="btn btn-white dropdown-toggle" data-toggle="dropdown">
                                            <span class="caret"></span>
                                        </button>
                                        <ul class="dropdown-menu dropdown-menu-right" role="menu">
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="font-noraml">相关参数详细信息</label>
                            <div><a href="http://doc.ruoyi.vip/ruoyi/document/zjwd.html#bootstrap-suggest" target="_blank">http://doc.ruoyi.vip/ruoyi/document/zjwd.html#bootstrap-suggest</a></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="ibox float-e-margins">
                    <div class="ibox-title">
                        <h5>搜索自动补全<small>https://github.com/bassjobsen/Bootstrap-3-Typeahead</small></h5>
                    </div>
                    <div class="ibox-content">
                        <p>通过数据属性的基本示例。</p>
                        <div class="row">
                            <div class="col-lg-6">
                           	    <input type="text" placeholder="ruoyi..." data-provide="typeahead" data-source='["ruoyi 1","ruoyi 2","ruoyi 3"]' class="form-control" />
                            </div>
                        </div>
                        <hr>
                        <p>通过javascript的基本示例。</p>
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" placeholder="ruoyi..." class="form-control" id="typeahead-demo-1"/>
                            </div>
                        </div>
                        <hr>
                        <p>通过javascript的复杂示例。</p>
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" placeholder="ruoyi..." class="form-control" id="typeahead-demo-2"/>
                            </div>
                        </div>
                        <hr>
                        <p>后台url中获取简单数据</p>
                        <div class="row">
                            <div class="col-lg-6">
                                <input type="text" placeholder="ruoyi..." class="form-control" id="typeahead-demo-3"/>
                            </div>
                        </div>
                        <hr>
                        <div class="form-group">
                            <label class="font-noraml">相关参数详细信息</label>
                            <div><a href="http://doc.ruoyi.vip/ruoyi/document/zjwd.html#bootstrap-typeahead" target="_blank">http://doc.ruoyi.vip/ruoyi/document/zjwd.html#bootstrap-typeahead</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
      @include('admin.layouts.footer')
      <script src="/static/ajax/libs/suggest/bootstrap-suggest.min.js"></script>
      <script src="/static/ajax/libs/typeahead/bootstrap3-typeahead.min.js"></script>
      <script type="text/javascript">

	    var testBsSuggest = $("#suggest-demo-1").bsSuggest({
	        url: "/demo/form/userModel",
	        idField: "userId",
	        keyField: "userName"
	    }).on('onDataRequestSuccess', function (e, result) {
	        console.log('onDataRequestSuccess: ', result);
	    }).on('onSetSelectValue', function (e, keyword) {
	        console.log('onSetSelectValue: ', keyword);
	    }).on('onUnsetSelectValue', function (e) {
	        console.log("onUnsetSelectValue");
	    });

	    var testBsSuggest = $("#suggest-demo-2").bsSuggest({
	        url: "/demo/form/userModel",
	        showBtn: false,
	        idField: "userId",
	        keyField: "userName"
	    }).on('onDataRequestSuccess', function (e, result) {
	        console.log('onDataRequestSuccess: ', result);
	    }).on('onSetSelectValue', function (e, keyword) {
	        console.log('onSetSelectValue: ', keyword);
	    }).on('onUnsetSelectValue', function (e) {
	        console.log("onUnsetSelectValue");
	    });

	    //data 数据中获取
	    var testdataBsSuggest = $("#suggest-demo-3").bsSuggest({
	        indexId: 1,
	        indexKey: 2,
	        data: {
	            'value': [
	                {
	                    'userId': '1',
	                    'userCode': '1000001',
	                    'userName': '测试1',
	                    'userPhone': '15888888888'
	                },
	                {
	                    'userId': '2',
	                    'userCode': '1000002',
	                    'userName': '测试2',
	                    'userPhone': '15888888888'
	                },
	                {
	                    'userId': '3',
	                    'userCode': '1000003',
	                    'userName': '测试3',
	                    'userPhone': '15888888888'
	                },
	                {
	                    'userId': '4',
	                    'userCode': '1000004',
	                    'userName': '测试4',
	                    'userPhone': '15888888888'
	                },
	                {
	                    'userId': '5',
	                    'userCode': '1000005',
	                    'userName': '测试5',
	                    'userPhone': '15888888888'
	                }
				],
	            'defaults': 'http://ruoyi.vip'
	        }
	    });

	    //百度搜索测试
	    var baiduBsSuggest = $("#baidu").bsSuggest({
	        allowNoKeyword: false, //是否允许无关键字时请求数据
	        multiWord: true, //以分隔符号分割的多关键字支持
	        separator: ",", //多关键字支持时的分隔符，默认为空格
	        getDataMethod: "url", //获取数据的方式，总是从 URL 获取
	        url: 'http://unionsug.baidu.com/su?p=3&t=' + (new Date()).getTime() + '&wd=',
	        /*优先从url ajax 请求 json 帮助数据，注意最后一个参数为关键字请求参数*/
	        jsonp: 'cb',
	        /*如果从 url 获取数据，并且需要跨域，则该参数必须设置*/
	        processData: function (json) { // url 获取数据时，对数据的处理，作为 getData 的回调函数
	            var i, len, data = {
	                value: []
	            };
	            if (!json || !json.s || json.s.length === 0) {
	                return false;
	            }

	            console.log(json);
	            len = json.s.length;

	            jsonStr = "{'value':[";
	            for (i = 0; i < len; i++) {
	                data.value.push({
	                    word: json.s[i]
	                });
	            }
	            data.defaults = 'baidu';

	            //字符串转化为 js 对象
	            return data;
	        }
	    });

	    //淘宝搜索建议测试
	    var taobaoBsSuggest = $("#taobao").bsSuggest({
	        indexId: 2, //data.value 的第几个数据，作为input输入框的内容
	        indexKey: 1, //data.value 的第几个数据，作为input输入框的内容
	        allowNoKeyword: false, //是否允许无关键字时请求数据
	        multiWord: true, //以分隔符号分割的多关键字支持
	        separator: ",", //多关键字支持时的分隔符，默认为空格
	        getDataMethod: "url", //获取数据的方式，总是从 URL 获取
	        effectiveFieldsAlias: {
	            Id: "序号",
	            Keyword: "关键字",
	            Count: "数量"
	        },
	        showHeader: true,
	        url: 'http://suggest.taobao.com/sug?code=utf-8&extras=1&q=',
	        /*优先从url ajax 请求 json 帮助数据，注意最后一个参数为关键字请求参数*/
	        jsonp: 'callback',
	        /*如果从 url 获取数据，并且需要跨域，则该参数必须设置*/
	        processData: function (json) { // url 获取数据时，对数据的处理，作为 getData 的回调函数
	            var i, len, data = {
	                value: []
	            };

	            if (!json || !json.result || json.result.length == 0) {
	                return false;
	            }

	            console.log(json);
	            len = json.result.length;

	            for (i = 0; i < len; i++) {
	                data.value.push({
	                    "Id": (i + 1),
	                    "Keyword": json.result[i][0],
	                    "Count": json.result[i][1]
	                });
	            }
	            console.log(data);
	            return data;
	        }
	    });

	    $('#typeahead-demo-1').typeahead({
            source: ["ruoyi 1","ruoyi 2","ruoyi 3"]
        });

	    $('#typeahead-demo-2').typeahead({
            source: [
                {"name": "Afghanistan", "code": "AF", "ccn0": "040"},
                {"name": "Land Islands", "code": "AX", "ccn0": "050"},
                {"name": "Albania", "code": "AL","ccn0": "060"},
                {"name": "Algeria", "code": "DZ","ccn0": "070"}
            ]
        });

	    $.get("/demo/form/collection", function(data){
	    	$("#typeahead-demo-3").typeahead({
		        source: data.value
		    });
        },'json');
    </script>
</body>
</html>
