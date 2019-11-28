<?php

namespace App\Http\Controllers\Admin\System;

use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Repositories\System\SysDictTypeRepository;
use Illuminate\Http\Request;

class SysDictTypeController extends Controller
{

    protected $prefix = 'admin/system/dict/type';
    protected $sysDictTypeRepository;

    public function __construct(SysDictTypeRepository $sysDictTypeRepository){
        $this->sysDictTypeRepository = $sysDictTypeRepository;
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
        $result = $this->sysDictTypeRepository->selectDictTypeList($request->all());
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
        if (Constants::DICT_TYPE_NOT_UNIQUE == $this->sysDictTypeRepository->checkDictTypeUnique($request->all()))
        {
            return $this->showJsonResult(false, '新增字典'.$request['dict_type'].'失败，字典类型已存在', []);
        }
        $this->sysDictTypeRepository->insertDictType($request->all());
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 编辑页面
     */
    public function edit($dict_id)
    {
        $data = array();
        $dict = $this->sysDictTypeRepository->selectDictTypeById($dict_id);
        $data['dict'] = $dict ;
        return view($this->prefix."/edit",$data);
    }

    /**
     * 更新操作
     */
    public function update(Request $request){
        if (Constants::DICT_TYPE_NOT_UNIQUE == $this->sysDictTypeRepository->checkDictTypeUnique($request->all()))
        {
            return $this->showJsonResult(false, '修改字典'.$request['dict_type'].'失败，字典类型已存在', []);
        }
        $this->sysDictTypeRepository->updateDictType($request->all());
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 删除操作
     */
    public function remove(Request $request){
        $this->sysDictTypeRepository->deleteDictTypeByIds($request['ids']);
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 查询字典详细
     */
    public function detail($dict_id)
    {
        $data = array();
        $data['dict'] = $this->sysDictTypeRepository->selectDictTypeById($dict_id);
        $data['dict_list'] = $this->sysDictTypeRepository->selectDictTypeAll();;
        return view("admin/system/dict/data/index",$data);
    }

    /**
     * 校验字典类型
     */
    public function checkDictTypeUnique(Request $request)
    {
        return $this->sysDictTypeRepository->checkDictTypeUnique($request);
    }

    /**
     * 选择字典树
     */
    public function selectDeptTree($column_id, $dict_type)
    {
        $data = array();
        $data['column_id'] = $column_id;
        $data['dict'] = $this->sysDictTypeRepository->selectDictTypeByType($dict_type);
        return view($this->prefix."/tree",$data);
    }

    /**
     * 加载字典列表树
     */
    public function treeData()
    {
        return $this->sysDictTypeRepository->selectDictTree(array());
    }

}
