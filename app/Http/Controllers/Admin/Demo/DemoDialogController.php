<?php

namespace App\Http\Controllers\Admin\Demo;

class DemoDialogController
{

    protected $prefix = 'admin/demo/modal';

    /**
     * 模态窗口
     */
    public function dialog()
    {
        return view($this->prefix."/dialog");
    }

    /**
     * 弹层组件
     */
    public function layer()
    {
        return view($this->prefix."/layer");
    }

    /**
     * 表单
     */
    public function form()
    {
        return view($this->prefix."/form");
    }

    /**
     * 表格
     */
    public function table()
    {
        return view($this->prefix."/table");
    }

    /**
     * 表格check
     */
    public function check()
    {
        return view($this->prefix."/table/check");
    }

    /**
     * 表格radio
     */
    public function radio()
    {
        return view($this->prefix."/table/radio");
    }

    /**
     * 表格回传父窗体
     */
    public function parent()
    {
        return view($this->prefix."/table/parent");
    }

}
