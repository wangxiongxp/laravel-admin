<?php

namespace App\Models\Policies;

use App\Models\SysUser;
use App\Repositories\System\SysMenuRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class SysConfigPolicy
{
    use HandlesAuthorization;

    protected $sysMenuRepository;

    public function __construct(SysMenuRepository $sysMenuRepository){
        $this->sysMenuRepository = $sysMenuRepository;
    }

    /**
     * 参数管理
     * @param SysUser $user
     * @return bool
     */
    public function view(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:config:view',$user);
    }

    /**
     * 参数查询
     * @param SysUser $user
     * @return bool
     */
    public function list(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:config:list',$user);
    }

    /**
     * 参数新增
     * @param SysUser $user
     * @return bool
     */
    public function create(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:config:add',$user);
    }

    /**
     * 参数修改
     * @param SysUser $user
     * @return bool
     */
    public function update(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:config:edit',$user);
    }

    /**
     * 参数删除
     * @param SysUser $user
     * @return bool
     */
    public function delete(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:config:remove',$user);
    }

    /**
     * 参数导出
     * @param SysUser $user
     * @return bool
     */
    public function export(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:config:export',$user);
    }

}
