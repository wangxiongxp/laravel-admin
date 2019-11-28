<?php

namespace App\Models\Policies;

use App\Models\SysUser;
use App\Repositories\System\SysMenuRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class SysDictTypePolicy
{
    use HandlesAuthorization;

    protected $sysMenuRepository;

    public function __construct(SysMenuRepository $sysMenuRepository){
        $this->sysMenuRepository = $sysMenuRepository;
    }

    /**
     * 字典管理
     * @param SysUser $user
     * @return bool
     */
    public function view(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:dict:view',$user);
    }

    /**
     * 字典查询
     * @param SysUser $user
     * @return bool
     */
    public function list(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:dict:list',$user);
    }

    /**
     * 字典新增
     * @param SysUser $user
     * @return bool
     */
    public function create(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:dict:add',$user);
    }

    /**
     * 字典修改
     * @param SysUser $user
     * @return bool
     */
    public function update(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:dict:edit',$user);
    }

    /**
     * 字典删除
     * @param SysUser $user
     * @return bool
     */
    public function delete(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:dict:remove',$user);
    }

    /**
     * 字典导出
     * @param SysUser $user
     * @return bool
     */
    public function export(SysUser $user)
    {
        return $this->sysMenuRepository->selectMenuByPerms('system:dict:export',$user);
    }

}
