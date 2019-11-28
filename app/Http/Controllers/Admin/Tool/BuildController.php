<?php

namespace App\Http\Controllers\Admin\Tool;

use App\Http\Controllers\Controller;

class BuildController extends Controller
{
    protected $prefix = 'admin/tool/build';

    /**
     * 列表页面
     */
    public function index(){
        return view($this->prefix."/index");
    }
}
