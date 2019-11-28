<?php

namespace App\Models\Policies;

use App\Models\SysUser;
use App\Repositories\System\SysMenuRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class SysRolePolicy
{
    use HandlesAuthorization;

    protected $sysMenuRepository;

    public function __construct(SysMenuRepository $sysMenuRepository){
        $this->sysMenuRepository = $sysMenuRepository;
    }

    /**
     * 角色管理
     * @param SysUser $user
     * @return bool
     */
    public function view(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:role:view',$user);
    }

    /**
     * 角色查询
     * @param SysUser $user
     * @return bool
     */
    public function list(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:role:list',$user);
    }

    /**
     * 角色新增
     * @param SysUser $user
     * @return bool
     */
    public function create(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:role:add',$user);
    }

    /**
     * 角色修改
     * @param SysUser $user
     * @return bool
     */
    public function update(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:role:edit',$user);
    }

    /**
     * 角色删除
     * @param SysUser $user
     * @return bool
     */
    public function delete(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:role:remove',$user);
    }

    /**
     * 角色导出
     * @param SysUser $user
     * @return bool
     */
    public function export(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:role:export',$user);
    }

}
