<?php

namespace App\Models\Policies;

use App\Models\SysUser;
use App\Repositories\System\SysMenuRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class SysUserPolicy
{
    use HandlesAuthorization;

    protected $sysMenuRepository;

    public function __construct(SysMenuRepository $sysMenuRepository){
        $this->sysMenuRepository = $sysMenuRepository;
    }

    /**
     * @param SysUser $user
     * @return bool
     */
//    public function viewAny(SysUser $user)
//    {
//        return true;
//    }

    /**
     * 用户管理
     * @param SysUser $user
     * @return bool
     */
    public function view(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:user:view',$user);
    }

    /**
     * 用户查询
     * @param SysUser $user
     * @return bool
     */
    public function list(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:user:list',$user);
    }

    /**
     * 用户新增
     * @param SysUser $user
     * @return bool
     */
    public function create(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:user:add',$user);
    }

    /**
     * 用户修改
     * @param SysUser $user
     * @return bool
     */
    public function update(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:user:edit',$user);
    }

    /**
     * 用户删除
     * @param SysUser $user
     * @return bool
     */
    public function delete(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:user:remove',$user);
    }

    /**
     * 用户导出
     * @param SysUser $user
     * @return bool
     */
    public function export(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:user:export',$user);
    }

    /**
     * 用户导入
     * @param SysUser $user
     * @return bool
     */
    public function import(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:user:import',$user);
    }

    /**
     * 重置密码
     * @param SysUser $user
     * @return bool
     */
    public function resetPwd(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:user:resetPwd',$user);
    }

}
