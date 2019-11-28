<?php

namespace App\Http\Controllers\Admin\Monitor;

use App\Http\Controllers\Controller;
use App\Repositories\System\SysLoginInfoRepository;
use Illuminate\Http\Request;

class SysLoginInfoController extends Controller
{
    protected $prefix = 'admin/monitor/loginInfo';
    protected $sysLoginInfoRepository;

    public function __construct(SysLoginInfoRepository $sysLoginInfoRepository){
        $this->sysLoginInfoRepository = $sysLoginInfoRepository;
    }

    /**
     * 列表页面
     */
    public function index(){
        return view($this->prefix."/index");
    }

    /**
     * 列表查询
     */
    public function list(Request $request)
    {
        $result = $this->sysLoginInfoRepository->selectLogininforList($request->all());
        return $this->showPageResult($result);
    }

    /**
     * 删除操作
     */
    public function remove(Request $request){
        $this->sysLoginInfoRepository->deleteLogininforByIds($request['ids']);
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 清空操作
     */
    public function clean()
    {
        $this->sysLoginInfoRepository->cleanLogininfor();
        return $this->showJsonResult(true, '操作成功', []);
    }

}
