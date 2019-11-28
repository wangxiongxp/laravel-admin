<?php

namespace App\Http\Controllers\Admin\Demo;

use App\Http\Controllers\Controller;

class DemoFormController extends Controller
{

    protected $prefix = 'admin/demo/form';

    protected $users = array();

    public function __construct()
    {
        $this->users[] = array('userId'=>1,'userCode'=>'1000001','userName'=>'测试1','userPhone'=>'15888888899' );
        $this->users[] = array('userId'=>2,'userCode'=>'1000002','userName'=>'测试2','userPhone'=>'15888888388' );
        $this->users[] = array('userId'=>3,'userCode'=>'1000003','userName'=>'测试3','userPhone'=>'15888884888' );
        $this->users[] = array('userId'=>4,'userCode'=>'1000004','userName'=>'测试4','userPhone'=>'15888885888' );
    }

    /**
     * 按钮页
     */
    public function button()
    {
        return view($this->prefix."/button");
    }

    /**
     * 下拉框
     */
    public function select()
    {
        return view($this->prefix."/select");
    }

    /**
     * 时间轴
     */
    public function timeline()
    {
        return view($this->prefix."/timeline");
    }

    /**
     * 表单校验
     */
    public function formValidate()
    {
        return view($this->prefix."/validate");
    }

    /**
     * 功能扩展（包含文件上传）
     */
    public function jasny()
    {
        return view($this->prefix."/jasny");
    }

    /**
     * 拖动排序
     */
    public function sortable()
    {
        return view($this->prefix."/sortable");
    }

    /**
     * 选项卡 & 面板
     */
    public function tabs_panels()
    {
        return view($this->prefix."/tabs_panels");
    }

    /**
     * 栅格
     */
    public function grid()
    {
        return view($this->prefix."/grid");
    }

    /**
     * 表单向导
     */
    public function wizard()
    {
        return view($this->prefix."/wizard");
    }

    /**
     * 文件上传
     */
    public function upload()
    {
        return view($this->prefix."/upload");
    }

    /**
     * 日期和时间页
     */
    public function datetime()
    {
        return view($this->prefix."/datetime");
    }

    /**
     * 左右互选组件
     */
    public function duallistbox()
    {
        return view($this->prefix."/duallistbox");
    }

    /**
     * 基本表单
     */
    public function basic()
    {
        return view($this->prefix."/basic");
    }

    /**
     * 卡片列表
     */
    public function cards()
    {
        return view($this->prefix."/cards");
    }

    /**
     * 富文本编辑器
     */
    public function summernote()
    {
        return view($this->prefix."/summernote");
    }

    /**
     * 搜索自动补全
     */
    public function autocomplete()
    {
        return view($this->prefix."/autocomplete");
    }

    /**
     * 获取用户数据
     */
    public function userModel()
    {
        return $this->showJsonResult(true, '获取成功', $this->users);
    }

    /**
     * 获取数据集合
     */
    public function collection()
    {
        $result = array("ruoyi 1", "ruoyi 2", "ruoyi 3", "ruoyi 4", "ruoyi 5");
        return $this->showJsonResult(true, '获取成功', $result);
    }

}
