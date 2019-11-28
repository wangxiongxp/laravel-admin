<?php

namespace App\Models\Policies;

use App\Models\SysUser;
use App\Repositories\System\SysMenuRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class SysOperationLogPolicy
{
    use HandlesAuthorization;

    protected $sysMenuRepository;

    public function __construct(SysMenuRepository $sysMenuRepository){
        $this->sysMenuRepository = $sysMenuRepository;
    }

    /**
     * 操作日志
     * @param SysUser $user
     * @return bool
     */
    public function view(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('monitor:operlog:view',$user);
    }

    /**
     * 操作查询
     * @param SysUser $user
     * @return bool
     */
    public function list(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('monitor:operlog:list',$user);
    }

    /**
     * 详细信息
     * @param SysUser $user
     * @return bool
     */
    public function detail(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('monitor:operlog:detail',$user);
    }

    /**
     * 操作删除
     * @param SysUser $user
     * @return bool
     */
    public function delete(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('monitor:operlog:remove',$user);
    }

    /**
     * 日志导出
     * @param SysUser $user
     * @return bool
     */
    public function export(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('monitor:operlog:export',$user);
    }

}
