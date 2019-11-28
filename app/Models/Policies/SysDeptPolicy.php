<?php

namespace App\Models\Policies;

use App\Models\SysUser;
use App\Repositories\System\SysMenuRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class SysDeptPolicy
{
    use HandlesAuthorization;

    protected $sysMenuRepository;

    public function __construct(SysMenuRepository $sysMenuRepository){
        $this->sysMenuRepository = $sysMenuRepository;
    }

    /**
     * 部门管理
     * @param SysUser $user
     * @return bool
     */
    public function view(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:dept:view',$user);
    }

    /**
     * 部门查询
     * @param SysUser $user
     * @return bool
     */
    public function list(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:dept:list',$user);
    }

    /**
     * 部门新增
     * @param SysUser $user
     * @return bool
     */
    public function create(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:dept:add',$user);
    }

    /**
     * 部门修改
     * @param SysUser $user
     * @return bool
     */
    public function update(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:dept:edit',$user);
    }

    /**
     * 部门删除
     * @param SysUser $user
     * @return bool
     */
    public function delete(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:dept:remove',$user);
    }

}
