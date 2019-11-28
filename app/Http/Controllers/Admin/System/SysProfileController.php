<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Repositories\System\SysDeptRepository;
use App\Repositories\System\SysPostRepository;
use App\Repositories\System\SysUserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SysProfileController extends Controller
{

    protected $prefix = 'admin/system/user/profile';

    protected $sysUserRepository;
    protected $sysDeptRepository;

    public function __construct(SysUserRepository $sysUserRepository, SysDeptRepository $sysDeptRepository){
        $this->sysUserRepository = $sysUserRepository;
        $this->sysDeptRepository = $sysDeptRepository;
    }

    /**
     * 个人信息
     */
    public function profile()
    {
        $user = Auth::user();
        $data['user'] = $this->sysUserRepository->selectUserById($user->user_id) ;
        $dept = $this->sysDeptRepository->selectDeptById($user['dept_id']);
        $data['dept'] = $dept ;
        $data['posts'] = $this->sysUserRepository->selectUserPostGroup($user->user_id);
        return view($this->prefix."/profile",$data);
    }

    public function checkPassword(Request $request)
    {
        $user = Auth::user();
        if (Hash::check($request['password'], $user->getAuthPassword()))
        {
            return $this->showResult(true);
        }
        return $this->showResult(false);
    }

    public function resetPwd()
    {
        $data = array();
        $user = $this->sysUserRepository->selectUserById(Auth::user()->user_id);
        $data['user'] = $user;
        return view($this->prefix."/resetPwd",$data);
    }

    public function resetPwdSave(Request $request)
    {
        $user = Auth::user();
        if (!empty($request['new_password']) && Hash::check($request['old_password'], $user->getAuthPassword()))
        {
            $arrData['user_id'] = $user->user_id;
            $arrData['password'] = Hash::make($request['new_password']);
            if ($this->sysUserRepository->resetUserPwd($arrData) > 0)
            {
                return $this->showJsonResult(true,"修改成功",[]);
            }
            return $this->showJsonResult(false,"修改失败",[]);
        }
        else
        {
            return $this->showJsonResult(false,"修改密码失败，旧密码错误",[]);
        }
    }

    /**
     * 修改头像
     */
    public function avatar()
    {
        $user = Auth::user();
        $data['user'] = $this->sysUserRepository->selectUserById($user->user_id);
        return view($this->prefix."/avatar",$data);
    }

    /**
     * 修改用户
     */
    public function update(Request $request)
    {
        $user = Auth::user();
        $arrData['user_id'] = $user->user_id;
        $arrData['user_name'] = $request['user_name'];
        $arrData['email'] = $request['email'];
        $arrData['phonenumber'] = $request['phonenumber'];
        $arrData['sex'] = $request['sex'];
        if ($this->sysUserRepository->updateUserInfo($arrData) > 0)
        {
            return $this->showJsonResult(true,"修改成功",[]);
        }
        return $this->showJsonResult(false,"修改失败",[]);
    }

    /**
     * 保存头像
     */
    public function updateAvatar(Request $request)
    {
        $user = Auth::user();
        $file = $request->file('avatarfile');
        if(!$file) {
            return $this->showJsonResult(false, ['上传文件为空']);
        }
        if(!$file->isValid()) {
            return $this->showJsonResult(false, ['上传文件无效']);
        }
        $allowed_extensions = ["png", "jpg", "gif"];
        $extension  = $file->getClientOriginalExtension();
        if ($extension && !in_array($extension, $allowed_extensions)) {
            return $this->showJsonResult(false, ['上传文件格式不正确, 当前支持png/jpg/gif格式']);
        }
        $destinationPath = 'upload/user_photo/';
        if(!file_exists($destinationPath)) {
            mkdir($destinationPath, 0777, true);
        }
        $fileName = date('Ymd').rand().'.'.$extension;
        $file->move($destinationPath, $fileName);

        $path = '/'.$destinationPath.$fileName;
        $arrData['user_id'] = $user->user_id;
        $arrData['avatar']  = $path;
        if ($this->sysUserRepository->updateUserInfo($arrData) > 0)
        {
            return $this->showJsonResult(true,"修改成功",[]);
        }
        return $this->showJsonResult(false,"修改失败",[]);
    }

}
