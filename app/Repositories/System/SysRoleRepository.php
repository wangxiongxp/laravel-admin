<?php

namespace App\Repositories\System;

use App\Constants\Constants;
use App\Exceptions\BusinessException;
use App\Models\SysRole;
use App\Models\SysRoleDept;
use App\Models\SysRoleMenu;
use App\Models\SysUserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SysRoleRepository
{
    /**
     * 查询列表
     * @param $arrData
     * @return array
     */
    public function selectRoleList($arrData)
    {
        $pageNum     = $arrData['pageNum'] ;
        $pageSize    = $arrData['pageSize'] ;

        $query = SysRole::query();
        $query->where('del_flag','=', 0);
        if(!empty($arrData['role_name'])){
            $query->where('role_name','like', '%'.$arrData['role_name'].'%');
        }
        if(!empty($arrData['status'])){
            $query->where('status','=', $arrData['status']);
        }
        if(!empty($arrData['role_key'])){
            $query->where('role_key','like', '%'.$arrData['role_key'].'%');
        }
        if(!empty($arrData['start_time'])){
            $query->whereDate('create_time','>=', $arrData['start_time']);
        }
        if(!empty($arrData['end_time'])){
            $query->whereDate('create_time','<=', $arrData['end_time']);
        }
        if(!empty($orderByColumn) && !empty($isAsc)){
            $query->orderBy($orderByColumn, $isAsc);
        }

        $sum = $query->count();
        if($sum > 0){
            //从第几条开始
            $start = ( intval($pageNum) - 1 ) * $pageSize ;
            $rows = $query->skip($start)->take($pageSize)->get();
        }else{
            $rows = array();
        }

        $resultData = array();
        $resultData['pageNum']   = $pageNum;
        $resultData['pageSize']  = $pageSize ;
        $resultData['total']     = $sum ;
        $resultData['rows']      = $rows ;
        return $resultData ;
    }

    /**
     * 根据用户ID查询权限
     *
     * @param $user_id
     * @return array
     */
    public function selectRoleKeys($user_id)
    {
        $sys_roles = DB::table("sys_user_role")
            ->join('sys_role', 'sys_role.role_id', '=', 'sys_user_role.role_id')
            ->where('sys_user_role.user_id',$user_id)
            ->where('sys_role.del_flag','0')
            ->select('sys_role.*')
            ->get();
        $return = array();
        foreach($sys_roles as $sys_role){
            $return[] = $sys_role['role_key'];
        }
        return $return;
    }

    /**
     * 根据用户ID查询角色
     *
     * @param $user_id
     * @return SysRole[]|\Illuminate\Database\Eloquent\Collection
     */
    public function selectRolesByUserId($user_id)
    {
        $roles = $this->selectRoleAll();
        foreach ($roles as $role)
        {
            $role['flag'] = false ;
            $user_role = SysUserRole::where('user_id',$user_id)->where('role_id',$role['role_id'])->first();
            if (!is_null($user_role)){
                $role['flag'] = true ;
            }
        }
        return $roles;
    }

    /**
     * 查询所有角色
     *
     * @return SysRole[]|\Illuminate\Database\Eloquent\Collection
     */
    public function selectRoleAll()
    {
        return SysRole::all();
    }

    /**
     * 通过角色ID查询角色
     *
     * @param $role_id
     * @return mixed
     */
    public function selectRoleById($role_id)
    {
        return SysRole::where('role_id', '=', $role_id)->first();
    }

    /**
     * 通过角色ID删除角色
     *
     * @param $role_id
     * @return mixed
     */
    public function deleteRoleById($role_id)
    {
        return SysRole::where('role_id', '=', $role_id)->delete();
    }

    /**
     * 批量删除角色信息
     *
     * @param $ids
     * @return mixed
     * @throws BusinessException
     */
    public function deleteRoleByIds($ids)
    {
        $id_arr = explode(",",$ids);
        foreach ($id_arr as $role_id)
        {
            self::checkRoleAllowed(['role_id'=>$role_id]);
            $role = $this->selectRoleById($role_id);
            if (self::countUserRoleByRoleId($role_id) > 0)
            {
                throw new BusinessException( $role['role_name'].'已分配,不能删除');
            }
        }
        return SysRole::whereIn('role_id', $id_arr)->update(['del_flag'=>2]);
    }

    /**
     * 新增保存角色信息
     *
     * @param $arrData
     * @return int
     */
    public function insertRole($arrData)
    {
        // 新增角色信息
        $arrData['create_by'] = Auth::user()->user_name;
        SysRole::create($arrData);
        return $this->insertRoleMenu($arrData);
    }

    /**
     * 修改保存角色信息
     *
     * @param $arrData
     * @return mixed
     */
    public function updateRole($arrData)
    {
        // 修改角色信息
        $menu_ids = $arrData['menu_ids'] ;
        unset($arrData['menu_ids']);
        $role_id = $arrData['role_id'];
        $arrData['update_by'] = Auth::user()->user_name;
        SysRole::where('role_id','=',$role_id)->update($arrData);
        // 删除角色与菜单关联
        SysRoleMenu::where('role_id',$role_id)->delete();

        $arrData['menu_ids'] = $menu_ids;
        return $this->insertRoleMenu($arrData);
    }

    /**
     * 修改数据权限信息
     *
     * @param $arrData
     * @return int
     */
    public function authDataScope($arrData)
    {
        // 修改角色信息
        $dept_ids = $arrData['dept_ids'] ;
        unset($arrData['dept_ids']);
        $role_id = $arrData['role_id'];
        SysRole::where('role_id','=',$role_id)->update($arrData);
        // 删除角色与部门关联
        SysRoleDept::where('role_id',$role_id)->delete();
        // 新增角色和部门信息（数据权限）
        $arrData['dept_ids'] = $dept_ids;
        return $this->insertRoleDept($arrData);
    }

    /**
     * 新增角色菜单信息
     *
     * @param $arrData
     * @return int
     */
    public function insertRoleMenu($arrData)
    {
        $rows = 1;
        // 新增用户与角色管理
        $list = array();
        foreach (explode(",",$arrData['menu_ids']) as $menu_id)
        {
            $role_menu = array();
            $role_menu['role_id'] = $arrData['role_id'];
            $role_menu['menu_id'] = $menu_id;
            $list[] = $role_menu;
        }
        if (count($list) > 0)
        {
            $rows = DB::table('sys_role_menu')->insert($list);
        }
        return $rows;
    }

    /**
     * 新增角色部门信息(数据权限)
     *
     * @param $arrData
     * @return int
     */
    public function insertRoleDept($arrData)
    {
        $rows = 1;
        // 新增角色与部门（数据权限）管理
        $list = array();
        foreach (explode(",",$arrData['dept_ids']) as $dept_id)
        {
            $role_dept = array();
            $role_dept['role_id'] = $arrData['role_id'];
            $role_dept['dept_id'] = $dept_id;
            $list[] = $role_dept;
        }
        if (count($list) > 0)
        {
            $rows = DB::table('sys_role_dept')->insert($list);
        }
        return $rows;
    }

    /**
     * 校验角色名称是否唯一
     *
     * @param $arrData
     * @return string
     */
    public function checkRoleNameUnique($arrData)
    {
        $role_id = empty($arrData['role_id']) ? -1 : $arrData['role_id'];
        $sys_role = SysRole::where('role_name', '=', $arrData['role_name'])->first();
        if (!is_null($sys_role) && $sys_role['role_id'] != $role_id)
        {
            return Constants::ROLE_NAME_NOT_UNIQUE;
        }
        return Constants::ROLE_NAME_UNIQUE;
    }

    /**
     * 校验角色权限是否唯一
     *
     * @param $arrData
     * @return string
     */
    public function checkRoleKeyUnique($arrData)
    {
        $role_id = empty($arrData['role_id']) ? -1 : $arrData['role_id'];
        $sys_role = SysRole::where('role_key', '=', $arrData['role_key'])->first();
        if (!is_null($sys_role) && $sys_role['role_id'] != $role_id)
        {
            return Constants::ROLE_KEY_NOT_UNIQUE;
        }
        return Constants::ROLE_KEY_UNIQUE;
    }

    /**
     * 校验角色是否允许操作
     *
     * @param $arrData
     * @throws BusinessException
     */
    public function checkRoleAllowed($arrData)
    {
        if (!empty($arrData['role_id']) && $arrData['role_id']==1)
        {
            throw new BusinessException("不允许操作超级管理员角色");
        }
    }

    /**
     * 通过角色ID查询角色使用数量
     *
     * @param $role_id
     * @return mixed
     */
    public function countUserRoleByRoleId($role_id)
    {
        return SysUserRole::where('role_id', '=', $role_id)->count();
    }

    /**
     * 角色状态修改
     *
     * @param $arrData
     * @return mixed
     */
    public function changeStatus($arrData)
    {
        return SysRole::where('role_id','=',$arrData['role_id'])->update($arrData);
    }

    /**
     * 取消授权用户角色
     *
     * @param $arrData
     * @return string
     */
    public function deleteAuthUser($arrData)
    {
        return SysUserRole::where('user_id',$arrData['user_id'])->where('role_id',$arrData['role_id'])->delete();
    }

    /**
     * 批量取消授权用户角色
     *
     * @param $role_id
     * @param $userIds
     * @return mixed
     */
    public function deleteAuthUsers($role_id, $userIds)
    {
        $id_arr = explode(",",$userIds);
        return SysUserRole::where('role_id',$role_id)->whereIn('user_id',$id_arr)->delete();
    }

    /**
     * 批量选择授权用户角色
     *
     * @param $role_id
     * @param $userIds
     * @return mixed
     */
    public function insertAuthUsers($role_id, $userIds)
    {
        $id_arr = explode(",",$userIds);
        // 新增用户与角色管理
        $list = array();
        foreach ($id_arr as $user_id)
        {
            $user_role = array();
            $user_role['user_id'] = $user_id;
            $user_role['role_id'] = $role_id;
            $list[] = $user_role;
        }
        return DB::table('sys_user_role')->insert($list);
    }

}
