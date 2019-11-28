<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Repositories\System\SysDictDataRepository;
use Illuminate\Http\Request;

class SysDictDataController extends Controller
{

    protected $prefix = 'admin/system/dict/data';
    protected $sysDictDataRepository;

    public function __construct(SysDictDataRepository $sysDictDataRepository){
        $this->sysDictDataRepository = $sysDictDataRepository;
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
        $result = $this->sysDictDataRepository->selectDictDataList($request->all());
        return $this->showPageResult($result);
    }

    /**
     * 新增页面
     */
    public function add($dict_type)
    {
        $data = array();
        $data['dict_type'] = $dict_type;
        return view($this->prefix."/add",$data);
    }

    /**
     * 保存操作
     */
    public function save(Request $request){
        $this->sysDictDataRepository->insertDictData($request->all());
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 编辑页面
     */
    public function edit($dict_code)
    {
        $data = array();
        $dictData = $this->sysDictDataRepository->selectDictDataById($dict_code);
        $data['dictData'] = $dictData ;
        return view($this->prefix."/edit",$data);
    }

    /**
     * 更新操作
     */
    public function update(Request $request){
        $this->sysDictDataRepository->updateDictData($request->all());
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 删除操作
     */
    public function remove(Request $request){
        $this->sysDictDataRepository->deleteDictDataByIds($request['ids']);
        return $this->showJsonResult(true, '操作成功', []);
    }

}
