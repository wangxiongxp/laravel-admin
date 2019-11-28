<?php

namespace App\Http\Controllers\Admin\System;

use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Repositories\System\SysConfigRepository;
use Illuminate\Http\Request;

class SysConfigController extends Controller
{
    protected $prefix = 'admin/system/config';
    protected $sysConfigRepository;

    public function __construct(SysConfigRepository $sysConfigRepository){
        $this->sysConfigRepository = $sysConfigRepository;
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
        $result = $this->sysConfigRepository->selectConfigList($request->all());
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
        if (Constants::CONFIG_KEY_NOT_UNIQUE == $this->sysConfigRepository->checkConfigKeyUnique($request->all())){
            return $this->showJsonResult(false, '新增参数'.$request['config_name'].'失败，参数键名已存在', []);
        }
        $this->sysConfigRepository->insertConfig($request->all());
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 编辑页面
     */
    public function edit($config_Id)
    {
        $data = array();
        $config = $this->sysConfigRepository->selectConfigById($config_Id);
        $data['config'] = $config ;
        return view($this->prefix."/edit",$data);
    }

    /**
     * 更新操作
     */
    public function update(Request $request){
        if (Constants::CONFIG_KEY_NOT_UNIQUE == $this->sysConfigRepository->checkConfigKeyUnique($request->all())){
            return $this->showJsonResult(false, '修改参数'.$request['config_name'].'失败，参数键名已存在', []);
        }
        $this->sysConfigRepository->updateConfig($request->all());
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 删除操作
     */
    public function remove(Request $request){
        $this->sysConfigRepository->deleteConfigByIds($request['ids']);
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 校验参数键名
     */
    public function checkConfigKeyUnique(Request $request)
    {
        return $this->sysConfigRepository->checkConfigKeyUnique($request->all());
    }

}
