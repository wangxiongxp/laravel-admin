<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Repositories\System\SysNoticeRepository;
use Illuminate\Http\Request;

class SysNoticeController extends Controller
{

    protected $prefix = 'admin/system/notice';
    protected $sysNoticeRepository;

    public function __construct(SysNoticeRepository $sysNoticeRepository){
        $this->sysNoticeRepository = $sysNoticeRepository;
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
        $result = $this->sysNoticeRepository->selectNoticeList($request->all());
        return $this->showPageResult($result);
    }

    /**
     * 新增页面
     */
    public function add()
    {
        return view($this->prefix."/add");
    }

    /**
     * 保存操作
     */
    public function save(Request $request){
        $this->sysNoticeRepository->insertNotice($request->all());
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 编辑页面
     */
    public function edit($notice_id)
    {
        $data = array();
        $notice = $this->sysNoticeRepository->selectNoticeById($notice_id);
        $data['notice'] = $notice ;
        return view($this->prefix."/edit",$data);
    }

    /**
     * 更新操作
     */
    public function update(Request $request){
        $this->sysNoticeRepository->updateNotice($request->all());
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 删除操作
     */
    public function remove(Request $request){
        $this->sysNoticeRepository->deleteNoticeByIds($request['ids']);
        return $this->showJsonResult(true, '操作成功', []);
    }

}
