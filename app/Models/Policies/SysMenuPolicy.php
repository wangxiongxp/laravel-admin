<?php

namespace App\Models\Policies;

use App\Models\SysUser;
use App\Repositories\System\SysMenuRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class SysMenuPolicy
{
    use HandlesAuthorization;

    protected $sysMenuRepository;

    public function __construct(SysMenuRepository $sysMenuRepository){
        $this->sysMenuRepository = $sysMenuRepository;
    }

    /**
     * 菜单管理
     * @param SysUser $user
     * @return bool
     */
    public function view(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:menu:view',$user);
    }

    /**
     * 菜单查询
     * @param SysUser $user
     * @return bool
     */
    public function list(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:menu:list',$user);
    }

    /**
     * 菜单新增
     * @param SysUser $user
     * @return bool
     */
    public function create(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:menu:add',$user);
    }

    /**
     * 菜单修改
     * @param SysUser $user
     * @return bool
     */
    public function update(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:menu:edit',$user);
    }

    /**
     * 菜单删除
     * @param SysUser $user
     * @return bool
     */
    public function delete(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:menu:remove',$user);
    }

}
