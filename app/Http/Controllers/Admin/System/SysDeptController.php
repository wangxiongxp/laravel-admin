<?php

namespace App\Http\Controllers\Admin\System;

use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Repositories\System\SysDeptRepository;
use Illuminate\Http\Request;

class SysDeptController extends Controller
{
    protected $prefix = 'admin/system/dept';
    protected $sysDeptRepository;

    public function __construct(SysDeptRepository $sysDeptRepository){
        $this->sysDeptRepository = $sysDeptRepository;
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
        $result = $this->sysDeptRepository->selectDeptList($request->all());
        return $this->showListResult($result);
    }

    /**
     * 新增页面
     */
    public function add($parent_id)
    {
        $data = array();
        $data['dept'] = $this->sysDeptRepository->selectDeptById($parent_id);
        return view($this->prefix."/add",$data);
    }

    /**
     * 保存操作
     */
    public function save(Request $request){
        if (Constants::DEPT_NAME_NOT_UNIQUE == $this->sysDeptRepository->checkDeptNameUnique($request->all()))
        {
            return $this->showJsonResult(false, '新增部门'.$request['dept_name'].'失败，部门名称已存在', []);
        }
        $this->sysDeptRepository->insertDept($request->all());
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 编辑页面
     */
    public function edit($dept_id)
    {
        $data = array();
        $dept = $this->sysDeptRepository->selectDeptById($dept_id);
        $data['dept'] = $dept ;
        $parent = $this->sysDeptRepository->selectDeptById($dept['parent_id']);
        if(!is_null($parent)){
            $data['parent'] = $parent ;
        }
        return view($this->prefix."/edit",$data);
    }

    /**
     * 更新操作
     */
    public function update(Request $request){
        if (Constants::DEPT_NAME_NOT_UNIQUE == $this->sysDeptRepository->checkDeptNameUnique($request->all()))
        {
            return $this->showJsonResult(false, '修改部门'.$request['dept_name'].'失败，部门名称已存在', []);
        }
        else if ($request['parent_id'] == $request['dept_id'])
        {
            return $this->showJsonResult(false, '修改部门'.$request['dept_name'].'失败，上级部门不能是自己', []);
        }
        $this->sysDeptRepository->updateDept($request->all());
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 删除操作
     */
    public function remove($dept_id){
        if ($this->sysDeptRepository->selectDeptCount($dept_id) > 0)
        {
            return $this->showJsonResult(false, '存在下级部门,不允许删除', []);
        }
        if ($this->sysDeptRepository->checkDeptExistUser($dept_id))
        {
            return $this->showJsonResult(false, '部门存在用户,不允许删除', []);
        }

        $this->sysDeptRepository->deleteDeptById($dept_id);
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 校验部门名称
     */
    public function checkDeptNameUnique(Request $request)
    {
        return $this->sysDeptRepository->checkDeptNameUnique($request);
    }

    /**
     * 选择部门树
     */
    public function selectDeptTree($dept_id)
    {
        $data = array();
        $dept = $this->sysDeptRepository->selectDeptById($dept_id);
        $data['dept'] = $dept ;
        return view($this->prefix."/tree",$data);
    }

    /**
     * 加载部门列表树
     */
    public function treeData()
    {
        return $this->sysDeptRepository->selectDeptTree();
    }

    /**
     * 加载角色部门（数据权限）列表树
     */
    public function roleDeptTreeData(Request $request)
    {
    return $this->sysDeptRepository->roleDeptTreeData($request);
    }

}
