<?php

namespace App\Http\Controllers\Admin\Monitor;

use App\Http\Controllers\Controller;
use App\Repositories\System\SysOperationLogRepository;
use Illuminate\Http\Request;

class SysOperationLogController extends Controller
{

    protected $prefix = 'admin/monitor/operationLog';
    protected $sysOperationLogRepository;

    public function __construct(SysOperationLogRepository $sysOperationLogRepository){
        $this->sysOperationLogRepository = $sysOperationLogRepository;
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
        $result = $this->sysOperationLogRepository->selectOperLogList($request->all());
        return $this->showPageResult($result);
    }

    /**
     * 删除操作
     */
    public function remove(Request $request){
        $this->sysOperationLogRepository->deleteOperLogByIds($request['ids']);
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 详情
     */
    public function detail($oper_id)
    {
        $data = array();
        $operLog = $this->sysOperationLogRepository->selectOperLogById($oper_id);
        $data['operLog'] = $operLog ;
        return view($this->prefix."/detail",$data);
    }

    /**
     * 清空操作
     */
    public function clean()
    {
        $this->sysOperationLogRepository->cleanOperLog();
        return $this->showJsonResult(true, '操作成功', []);
    }

}
