<?php

namespace App\Http\Controllers\Admin\System;

use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Repositories\System\SysRoleRepository;
use App\Repositories\System\SysUserRepository;
use Illuminate\Http\Request;

class SysRoleController extends Controller
{

    protected $prefix = 'admin/system/role';
    protected $sysRoleRepository;
    protected $sysUserRepository;

    public function __construct(SysRoleRepository $sysRoleRepository, SysUserRepository $sysUserRepository){
        $this->sysRoleRepository = $sysRoleRepository;
        $this->sysUserRepository = $sysUserRepository;
    }

    /**
     * 列表页面
     */
    public function index(){
        return view($this->prefix."/index");
    }

    /**
     * 列表查询
     */
    public function list(Request $request)
    {
        $result = $this->sysRoleRepository->selectRoleList($request->all());
        return $this->showPageResult($result);
    }

    /**
     * 新增页面
     */
    public function add()
    {
        return view($this->prefix."/add");
    }

    /**
     * 保存操作
     */
    public function save(Request $request)
    {
        if (Constants::ROLE_NAME_NOT_UNIQUE == $this->sysRoleRepository->checkRoleNameUnique($request->all()))
        {
            return $this->showJsonResult(false, '新增角色'.$request['role_name'].'失败，角色名称已存在', []);
        }
        else if (Constants::ROLE_KEY_NOT_UNIQUE == $this->sysRoleRepository->checkRoleKeyUnique($request->all()))
        {
            return $this->showJsonResult(false, '新增角色'.$request['role_name'].'失败，角色权限已存在', []);
        }
//        role.setCreateBy(ShiroUtils.getLoginName());
//        ShiroUtils.clearCachedAuthorizationInfo();
        $this->sysRoleRepository->insertRole($request->all());
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 编辑页面
     */
    public function edit($role_id)
    {
        $data = array();
        $role = $this->sysRoleRepository->selectRoleById($role_id);
        $data['role'] = $role ;
        return view($this->prefix."/edit",$data);
    }

    /**
     * 更新操作
     */
    public function update(Request $request)
    {
        $this->sysRoleRepository->checkRoleAllowed($request->all());
        if (Constants::ROLE_NAME_NOT_UNIQUE == $this->sysRoleRepository->checkRoleNameUnique($request->all()))
        {
            return $this->showJsonResult(false, '修改角色'.$request['role_name'].'失败，角色名称已存在', []);
        }
        else if (Constants::ROLE_KEY_NOT_UNIQUE == $this->sysRoleRepository->checkRoleKeyUnique($request->all()))
        {
            return $this->showJsonResult(false, '修改角色'.$request['role_name'].'失败，角色权限已存在', []);
        }
//        role.setUpdateBy(ShiroUtils.getLoginName());
//        ShiroUtils.clearCachedAuthorizationInfo();
        $this->sysRoleRepository->updateRole($request->all());
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 数据权限页面
     */
    public function authDataScope($role_id)
    {
        $data = array();
        $role = $this->sysRoleRepository->selectRoleById($role_id);
        $data['role'] = $role ;
        return view($this->prefix."/dataScope",$data);
    }

    /**
     * 数据权限保存
     */
    public function authDataScopeSave(Request $request)
    {
        $this->sysRoleRepository->checkRoleAllowed($request->all());
//        role.setUpdateBy(ShiroUtils.getLoginName());
        if ($this->sysRoleRepository->authDataScope($request->all()) > 0)
        {
//            ShiroUtils.setSysUser(userService.selectUserById(ShiroUtils.getSysUser().getUserId()));
            return $this->showJsonResult(true, '操作成功', []);
        }
        return $this->showJsonResult(false, '操作失败', []);
    }

    /**
     * 删除操作
     */
    public function remove(Request $request)
    {
        $this->sysRoleRepository->deleteRoleByIds($request['ids']);
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 校验角色名称
     */
    public function checkRoleNameUnique(Request $request)
    {
        return $this->sysRoleRepository->checkRoleNameUnique($request);
    }

    /**
     * 校验角色权限
     */
    public function checkRoleKeyUnique(Request $request)
    {
        return $this->sysRoleRepository->checkRoleKeyUnique($request);
    }

    /**
     * 选择菜单树页面
     */
    public function selectMenuTree()
    {
        return view($this->prefix."/tree");
    }

    /**
     * 角色状态修改
     */
    public function changeStatus(Request $request)
    {
        $this->sysRoleRepository->checkRoleAllowed($request->all());
        $this->sysRoleRepository->changeStatus($request->all());
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 分配用户
     */
    public function authUser($role_id)
    {
        $data = array();
        $role = $this->sysRoleRepository->selectRoleById($role_id);
        $data['role'] = $role ;
        return view($this->prefix."/authUser",$data);
    }

    /**
     * 查询已分配用户角色列表
     */
    public function allocatedList(Request $request)
    {
        $result = $this->sysUserRepository->selectAllocatedList($request->all());
        return $this->showPageResult($result);
    }

    /**
     * 取消授权
     */
    public function cancelAuthUser(Request $request)
    {
        $this->sysRoleRepository->deleteAuthUser($request->all());
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 批量取消授权
     */
    public function cancelAuthUserAll(Request $request)
    {
        $this->sysRoleRepository->deleteAuthUsers($request['role_id'],$request['user_ids']);
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 选择用户
     */
    public function selectUser($role_id)
    {
        $data = array();
        $data['role'] = $this->sysRoleRepository->selectRoleById($role_id);
        return view($this->prefix."/selectUser",$data);
    }

    /**
     * 查询未分配用户角色列表
     */
    public function unallocatedList(Request $request)
    {
        $result = $this->sysUserRepository->selectUnallocatedList($request->all());
        return $this->showPageResult($result);
    }

    /**
     * 批量选择用户授权
     */
    public function selectAuthUserAll(Request $request)
    {
        $this->sysRoleRepository->insertAuthUsers($request['role_id'],$request['user_ids']);
        return $this->showJsonResult(true, '操作成功', []);
    }

}
