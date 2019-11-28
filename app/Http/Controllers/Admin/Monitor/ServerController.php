<?php

namespace App\Http\Controllers\Admin\Monitor;

use App\Http\Controllers\Controller;
use App\Utils\Sysinfo;

class ServerController extends Controller
{
    protected $prefix = 'admin/monitor/server';
    protected $sysinfo;

    public function __construct()
    {
        $this->sysinfo = new Sysinfo();
    }

    /**
     * 列表页面
     */
    public function index(){
        $data = array();
        return view($this->prefix."/index",$data);
    }
}
