<?php

namespace App\Http\Controllers\Admin\System;

use Agent;
use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Models\SysUser;
use App\Repositories\System\SysDeptRepository;
use App\Repositories\System\SysPostRepository;
use App\Repositories\System\SysRoleRepository;
use App\Repositories\System\SysUserRepository;
use Illuminate\Http\Request;

class SysUserController extends Controller
{

    protected $prefix = 'admin/system/user';
    protected $sysUserRepository;
    protected $sysDeptRepository;
    protected $sysRoleRepository;
    protected $sysPostRepository;

    public function __construct(SysUserRepository $sysUserRepository,SysDeptRepository $sysDeptRepository,
                                SysRoleRepository $sysRoleRepository,SysPostRepository $sysPostRepository){
        $this->sysUserRepository = $sysUserRepository;
        $this->sysDeptRepository = $sysDeptRepository;
        $this->sysRoleRepository = $sysRoleRepository;
        $this->sysPostRepository = $sysPostRepository;
    }

    /**
     * 列表页面
     */
    public function index(){
        $this->authorize('view',SysUser::class);

        return view($this->prefix."/index");
    }

    /**
     * 列表查询
     */
    public function list(Request $request)
    {
        $this->authorize('list',SysUser::class);

        $result = $this->sysUserRepository->selectUserList($request->all());
        return $this->showPageResult($result);
    }

    /**
     * 新增页面
     */
    public function add()
    {
        $this->authorize('create',SysUser::class);

        $data = array();
        $data['roles'] = $this->sysRoleRepository->selectRoleAll();
        $data['posts'] = $this->sysPostRepository->selectPostAll();
        return view($this->prefix."/add",$data);
    }

    /**
     * 保存操作
     */
    public function save(Request $request){
        $this->authorize('create',SysUser::class);

        if (Constants::USER_NAME_NOT_UNIQUE == $this->sysUserRepository->checkLoginNameUnique($request['login_name']))
        {
            return $this->showJsonResult(false, '新增用户'.$request['login_name'].'失败，登录账号已存在', []);
        }
        else if (Constants::USER_PHONE_NOT_UNIQUE == $this->sysUserRepository->checkPhoneUnique($request->all()))
        {
            return $this->showJsonResult(false, '新增用户'.$request['login_name'].'失败，手机号码已存在', []);
        }
        else if (Constants::USER_EMAIL_NOT_UNIQUE == $this->sysUserRepository->checkEmailUnique($request->all()))
        {
            return $this->showJsonResult(false, '新增用户'.$request['login_name'].'失败，手机号码已存在', []);
        }
        $this->sysUserRepository->insertUser($request->all());
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 编辑页面
     */
    public function edit($user_id)
    {
        $this->authorize('update',SysUser::class);

        $data = array();
        $user = $this->sysUserRepository->selectUserById($user_id);
        $data['user'] = $user ;
        $dept = $this->sysDeptRepository->selectDeptById($user['dept_id']);
        $data['dept'] = $dept ;
        $data['roles'] = $this->sysRoleRepository->selectRolesByUserId($user_id);
        $data['posts'] = $this->sysPostRepository->selectPostsByUserId($user_id);
        return view($this->prefix."/edit",$data);
    }

    /**
     * 更新操作
     */
    public function update(Request $request){
        $this->authorize('update',SysUser::class);

        $this->sysUserRepository->checkUserAllowed($request->all());
        if (Constants::USER_PHONE_NOT_UNIQUE == $this->sysUserRepository->checkPhoneUnique($request->all()))
        {
            return $this->showJsonResult(false, '修改用户'.$request['login_name'].'失败，手机号码已存在', []);
        }
        else if (Constants::USER_EMAIL_NOT_UNIQUE == $this->sysUserRepository->checkEmailUnique($request->all()))
        {
            return $this->showJsonResult(false, '修改用户'.$request['login_name'].'失败，邮箱账号已存在', []);
        }
        $this->sysUserRepository->updateUser($request->all());
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 重置密码页面
     */
    public function resetPwd($user_id)
    {
        $this->authorize('resetPwd',SysUser::class);

        $data = array();
        $user = $this->sysUserRepository->selectUserById($user_id);
        $data['user'] = $user ;
        return view($this->prefix."/resetPwd",$data);
    }

    /**
     * 重置密码保存
     */
    public function resetPwdSave(Request $request)
    {
        $this->authorize('resetPwd',SysUser::class);

        $this->sysUserRepository->checkUserAllowed($request->all());
//        user.setSalt(ShiroUtils.randomSalt());
//        user.setPassword(passwordService.encryptPassword(user.getLoginName(), user.getPassword(), user.getSalt()));
        if ($this->sysUserRepository->resetUserPwd($request->all()) > 0)
        {
//            if (ShiroUtils.getUserId() == user.getUserId())
            {
//                ShiroUtils.setSysUser(userService.selectUserById(user.getUserId()));
            }
            return $this->showJsonResult(true, '操作成功', []);
        }
        return $this->showJsonResult(false, '操作失败', []);
    }

    /**
     * 删除操作
     */
    public function remove(Request $request){
        $this->authorize('delete',SysUser::class);

        $this->sysUserRepository->deleteUserById($request['ids']);
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 校验用户名
     */
    public function checkLoginNameUnique(Request $request)
    {
        return $this->sysUserRepository->checkLoginNameUnique($request->all());
    }

    /**
     * 校验手机号码
     */
    public function checkPhoneUnique(Request $request)
    {
        return $this->sysUserRepository->checkPhoneUnique($request->all());
    }

    /**
     * 校验email邮箱
     */
    public function checkEmailUnique(Request $request)
    {
        return $this->sysUserRepository->checkEmailUnique($request->all());
    }

    /**
     * 用户状态修改
     */
    public function changeStatus(Request $request)
    {
        $this->sysUserRepository->checkUserAllowed($request->all());
        $this->sysUserRepository->changeStatus($request->all());
        return $this->showJsonResult(true, '操作成功', []);
    }

}
