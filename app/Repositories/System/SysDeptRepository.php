<?php

namespace App\Repositories\System;

use App\Constants\Constants;
use App\Exceptions\BusinessException;
use App\Models\SysDept;
use App\Models\SysUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SysDeptRepository
{

    /**
     * 查询列表
     * @param $arrData
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function selectDeptList($arrData)
    {
        $query = SysDept::query();
        if(!empty($arrData['parent_id'])){
            $query->where('parent_id','=', $arrData['parent_id']);
        }
        if(!empty($arrData['dept_name'])){
            $query->where('dept_name','like', '%'.$arrData['dept_name'].'%');
        }
        if(!empty($arrData['status'])){
            $query->where('status','=', $arrData['status']);
        }
        if(!empty($orderByColumn) && !empty($isAsc)){
            $query->orderBy($orderByColumn, $isAsc);
        }
        return $query->get();
    }

    /**
     * 查询部门管理树
     *
     * @return array
     */
    public function selectDeptTree()
    {
        $deptList = $this->selectDeptList(array());
        return $this->initZtree($deptList,null);
    }

    /**
     * 根据角色ID查询部门（数据权限）
     *
     * @param $request
     * @return array
     */
    public function roleDeptTreeData($request)
    {
        $deptList = $this->selectDeptList(array());
        if (!empty($request['role_id'])){
            $roleDeptList = DB::table('sys_dept')
                ->join('sys_role_dept', 'sys_dept.dept_id', '=', 'sys_role_dept.dept_id')
//                ->select('sys_dept.*')
                ->where('sys_dept.del_flag','=','0')
                ->where('sys_role_dept.role_id','=',$request['role_id'])
                ->orderBy('sys_dept.parent_id')
                ->orderBy('sys_dept.order_num')
                ->selectRaw('concat(sys_dept.dept_id, sys_dept.dept_name) as dept_name')
                ->get()->map(function ($value) {return (array)$value;})->toArray();
            $ztrees = $this->initZtree($deptList, $roleDeptList);
        }else{
            $ztrees = $this->initZtree($deptList,null);
        }
        return $ztrees;
    }

    /**
     * 对象转部门树
     *
     * @param $deptList
     * @param $roleDeptList
     * @return array
     */
    public function initZtree($deptList, $roleDeptList)
    {
        $ztrees = array();
        $isCheck = !is_null($roleDeptList);
        foreach ($deptList as $dept)
        {
            if (Constants::DEPT_NORMAL == $dept['status']){
                $ztree = array();
                $ztree['id']    = $dept['dept_id'];
                $ztree['pId']   = $dept['parent_id'];
                $ztree['name']  = $dept['dept_name'];
                $ztree['title'] = $dept['dept_name'];
                if ($isCheck){
                    $has = false;
                    foreach ($roleDeptList as $roleDept){
                        if($roleDept['dept_name'] == $dept['dept_id'].$dept['dept_name']){
                            $has = true;
                        }
                    }
                    $ztree['checked'] = $has;
                }
                $ztrees[] = $ztree;
            }
        }
        return $ztrees;
    }

    /**
     * 查询部门人数
     *
     * @param $parent_id
     * @return mixed
     */
    public function selectDeptCount($parent_id)
    {
        return SysDept::where('parent_id', '=', $parent_id)->where("del_flag","=","0")->count();
    }

    /**
     * 查询部门是否存在用户
     *
     * @param $dept_id
     * @return mixed
     */
    public function checkDeptExistUser($dept_id)
    {
        return SysUser::where('dept_id', '=', $dept_id)->where("del_flag","=","0")->count();
    }

    /**
     * 删除部门管理信息
     *
     * @param $dept_id
     */
    public function deleteDeptById($dept_id)
    {
        SysDept::where('dept_id', '=', $dept_id)->delete();
    }


    /**
     * 新增保存部门信息
     *
     * @param $arrData
     * @return mixed
     * @throws BusinessException
     */
    public function insertDept($arrData)
    {
        $dept = $this->selectDeptById($arrData['parent_id']);
        // 如果父节点不为"正常"状态,则不允许新增子节点
        if (!Constants::DEPT_NORMAL == $dept['status'])
        {
            throw new BusinessException("部门停用，不允许新增");
        }
        $arrData['ancestors'] = $dept['ancestors']. "," . $arrData['parent_id'] ;
        $arrData['create_by'] = Auth::user()->user_name;
        return SysDept::create($arrData);
    }

    /**
     * 修改保存部门信息
     *
     * @param $arrData
     * @return mixed
     */
    public function updateDept($arrData)
    {
        DB::transaction(function () use ($arrData) {
            $newParentDept = $this->selectDeptById($arrData['parent_id']);
            $oldDept = $this->selectDeptById($arrData['dept_id']);
            if (!is_null($newParentDept) && !is_null($oldDept)){
                $newAncestors = $newParentDept['ancestors'] . "," . $newParentDept['dept_id'];
                $oldAncestors = $oldDept['ancestors'];
                $arrData['ancestors'] = $newAncestors;
                $this->updateDeptChildren($arrData['dept_id'], $newAncestors, $oldAncestors);
            }
            $arrData['update_by'] = Auth::user()->user_name;
            SysDept::where('dept_id','=',$arrData['dept_id'])->update($arrData);
            if (Constants::DEPT_NORMAL == $arrData['status']){
                // 如果该部门是启用状态，则启用该部门的所有上级部门
                $this->updateParentDeptStatus($arrData);
            }
        });
    }

    /**
     * 修改该部门的父级部门状态
     *
     * @param $arrData
     */
    private function updateParentDeptStatus($arrData)
    {
        SysDept::where("dept_id",$arrData['dept_id'])->update(['status'=>$arrData['status']]);
    }

    /**
     * 修改子元素关系
     *
     * @param $dept_id
     * @param $newAncestors
     * @param $oldAncestors
     */
    public function updateDeptChildren($dept_id, $newAncestors, $oldAncestors)
    {
        $children = DB::table('sys_dept')
            ->whereRaw('FIND_IN_SET (?,ancestors)', [$dept_id])
            ->get();

        foreach ($children as  $child)
        {
            $child['ancestors'] = str_replace($oldAncestors,$newAncestors,$child['ancestors']);
            SysDept::where('dept_id',$child['dept_id'])->update(['ancestors'=>$child['ancestors']]);
        }
    }

    /**
     * 根据部门ID查询信息
     *
     * @param $dept_id
     * @return mixed
     */
    public function selectDeptById($dept_id)
    {
        return SysDept::where('dept_id', '=', $dept_id)->first();
    }

    /**
     * 校验部门名称是否唯一
     *
     * @param $arrData
     * @return string
     */
    public function checkDeptNameUnique($arrData)
    {
        $dept_id = empty($arrData['dept_id']) ? -1 : $arrData['dept_id'];
        $sys_dept = SysDept::where('dept_name', '=', $arrData['dept_name'])->where('parent_id', '=', $arrData['parent_id'])->first();
        if (!is_null($sys_dept) && $sys_dept['dept_id'] != $dept_id)
        {
            return Constants::DEPT_NAME_NOT_UNIQUE;
        }
        return Constants::DEPT_NAME_UNIQUE;
    }

}
