<?php

namespace App\Models\Policies;

use App\Models\SysUser;
use App\Repositories\System\SysMenuRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class SysLoginInfoPolicy
{
    use HandlesAuthorization;

    protected $sysMenuRepository;

    public function __construct(SysMenuRepository $sysMenuRepository){
        $this->sysMenuRepository = $sysMenuRepository;
    }

    /**
     * 登录日志
     * @param SysUser $user
     * @return bool
     */
    public function view(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('monitor:logininfor:view',$user);
    }

    /**
     * 登录查询
     * @param SysUser $user
     * @return bool
     */
    public function list(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('monitor:logininfor:list',$user);
    }

    /**
     * 登录删除
     * @param SysUser $user
     * @return bool
     */
    public function delete(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('monitor:logininfor:remove',$user);
    }

    /**
     * 日志导出
     * @param SysUser $user
     * @return bool
     */
    public function export(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('monitor:logininfor:export',$user);
    }

    /**
     * 账户解锁
     * @param SysUser $user
     * @return bool
     */
    public function unlock(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('monitor:logininfor:unlock',$user);
    }

}
