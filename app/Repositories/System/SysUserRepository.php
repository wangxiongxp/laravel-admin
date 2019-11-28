<?php

namespace App\Repositories\System;

use App\Constants\Constants;
use App\Exceptions\BusinessException;
use App\Models\SysUser;
use App\Models\SysUserPost;
use App\Models\SysUserRole;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class SysUserRepository
{
    /**
     * 查询列表
     */
    public function selectUserList($arrData)
    {
        $pageNum     = $arrData['pageNum'] ;
        $pageSize    = $arrData['pageSize'] ;

        $query = SysUser::query();
        if(!empty($arrData['login_name'])){
            $query->where('login_name','like', '%'.$arrData['login_name'].'%');
        }
        if(!empty($arrData['status'])){
            $query->where('status','=', $arrData['status']);
        }
        if(!empty($arrData['phonenumber'])){
            $query->where('phonenumber','like', '%'.$arrData['phonenumber'].'%');
        }
        if(!empty($arrData['start_time'])){
            $query->whereDate('create_time','>=', $arrData['start_time']);
        }
        if(!empty($arrData['end_time'])){
            $query->whereDate('create_time','<=', $arrData['end_time']);
        }
        if(!empty($arrData['dept_id'])){
            $data = DB::table('sys_dept')
                ->selectRaw('dept_id')
                ->whereRaw('FIND_IN_SET (?,ancestors)', [$arrData['dept_id']])
                ->get()
                ->map(function ($value) {return (array)$value;})->toArray();
            $query->where(function ($query) use ($arrData,$data) {
                $query->where('dept_id', '=', $arrData['dept_id'])
                    ->orWhereIn('dept_id', $data);
            });
        }

        if(!empty($orderByColumn) && !empty($isAsc)){
            $query->orderBy($orderByColumn, $isAsc);
        }

        $sum = $query->count();
        if($sum > 0){
            //从第几条开始
            $start = ( intval($pageNum) - 1 ) * $pageSize ;
            $rows = $query->skip($start)->take($pageSize)->get();
        }else{
            $rows = array();
        }

        $resultData = array();
        $resultData['pageNum']   = $pageNum;
        $resultData['pageSize']  = $pageSize ;
        $resultData['total']     = $sum ;
        $resultData['rows']      = $rows ;
        return $resultData ;
    }

    /**
     * 根据条件分页查询已分配用户角色列表
     * @param $arrData
     * @return array
     */
    public function selectAllocatedList($arrData)
    {
        $pageNum     = $arrData['pageNum'] ;
        $pageSize    = $arrData['pageSize'] ;

        $query = DB::table('sys_user_role')
            ->join('sys_user', 'sys_user.user_id', '=', 'sys_user_role.user_id')
            ->where('sys_user_role.role_id',$arrData['role_id']);
        if(!empty($arrData['login_name'])){
            $query->where('sys_user.login_name','like', '%'.$arrData['login_name'].'%');
        }
        if(!empty($arrData['phonenumber'])){
            $query->where('sys_user.phonenumber','like', '%'.$arrData['phonenumber'].'%');
        }
        if(!empty($orderByColumn) && !empty($isAsc)){
            $query->orderBy('sys_user.'.$orderByColumn, $isAsc);
        }

        $sum = $query->count();
        if($sum > 0){
            //从第几条开始
            $start = ( intval($pageNum) - 1 ) * $pageSize ;
            $rows = $query->skip($start)->take($pageSize)->get();
        }else{
            $rows = array();
        }

        $resultData = array();
        $resultData['pageNum']   = $pageNum;
        $resultData['pageSize']  = $pageSize ;
        $resultData['total']     = $sum ;
        $resultData['rows']      = $rows ;
        return $resultData ;
    }

    /**
     * 根据条件分页查询未分配用户角色列表
     * @param $arrData
     * @return array
     */
    public function selectUnallocatedList($arrData)
    {
        $pageNum     = $arrData['pageNum'] ;
        $pageSize    = $arrData['pageSize'] ;

        $query = DB::table('sys_user')
            ->leftJoin('sys_user_role', function ($query) use ($arrData) {
                $query->on('sys_user.user_id', '=', 'sys_user_role.user_id')
                    ->where('sys_user_role.role_id', '=', $arrData['role_id']);
            })
            ->select('sys_user.*')
            ->where('sys_user.del_flag', '0')
            ->where(function ($query) use ($arrData) {
                $query->where('sys_user_role.role_id', '!=', $arrData['role_id'])
                    ->orWhereNull('sys_user_role.role_id');
            })
            ->distinct();
        if(!empty($arrData['login_name'])){
            $query->where('sys_user.login_name','like', '%'.$arrData['login_name'].'%');
        }
        if(!empty($arrData['phonenumber'])){
            $query->where('sys_user.phonenumber','like', '%'.$arrData['phonenumber'].'%');
        }
        if(!empty($orderByColumn) && !empty($isAsc)){
            $query->orderBy('sys_user.'.$orderByColumn, $isAsc);
        }

        $sum = $query->count();
        if($sum > 0){
            //从第几条开始
            $start = ( intval($pageNum) - 1 ) * $pageSize ;
            $rows = $query->skip($start)->take($pageSize)->get();
        }else{
            $rows = array();
        }

        $resultData = array();
        $resultData['pageNum']   = $pageNum;
        $resultData['pageSize']  = $pageSize ;
        $resultData['total']     = $sum ;
        $resultData['rows']      = $rows ;
        return $resultData ;
    }

    /**
     * 通过用户名查询用户
     *
     * @param $login_name
     * @return mixed
     */
    public function selectUserByLoginName($login_name)
    {
        return SysUser::where('login_name', '=', $login_name)->first();
    }

    /**
     * 通过手机号码查询用户
     *
     * @param $phoneNumber
     * @return mixed
     */
    public function selectUserByPhoneNumber($phoneNumber)
    {
        return SysUser::where('phonenumber', '=', $phoneNumber)->first();
    }

    /**
     * 通过邮箱查询用户
     *
     * @param $email
     * @return mixed
     */
    public function selectUserByEmail($email)
    {
        return SysUser::where('email', '=', $email)->first();
    }

    /**
     * 通过用户ID查询用户
     *
     * @param $user_id
     * @return mixed
     */
    public function selectUserById($user_id)
    {
        return SysUser::where('user_id', '=', $user_id)->first();
    }

    /**
     * 通过用户ID删除用户
     *
     * @param $user_id
     */
    public function deleteUserById($user_id)
    {
        DB::transaction(function() use($user_id){
            // 删除用户与角色关联
            SysUserRole::where('user_id',$user_id)->delete();
            // 删除用户与岗位表
            SysUserPost::where('user_id',$user_id)->delete();
            SysUser::where("user_id",$user_id)->delete();
        });
    }

    /**
     * 批量删除用户信息
     *
     * @param $ids
     * @return mixed
     * @throws BusinessException
     */
    public function deleteUserByIds($ids)
    {
        $id_arr = explode(",",$ids);
        foreach ($ids as $user_id)
        {
            $this->checkUserAllowed(array('user_id'=>$user_id));
        }
        return SysUser::whereIn('user_id', $id_arr)->delete();
    }

    /**
     * 新增保存用户信息
     *
     * @param $arrData
     */
    public function insertUser($arrData)
    {
        // 新增用户信息
        $arrData['password'] = Hash::make($arrData['password']);
        $arrData['create_by'] = Auth::user()->user_name;
        $user = SysUser::create($arrData);
        $arrData['user_id'] = $user->user_id;
        // 新增用户岗位关联
        $this->insertUserPost($arrData);
        // 新增用户与角色管理
        $this->insertUserRole($arrData);
    }

    /**
     * 修改保存用户信息
     *
     * @param $arrData
     * @return mixed
     */
    public function updateUser($arrData)
    {
        $arrData['update_by'] = Auth::user()->user_name;
        $user_id = $arrData['user_id'];
        // 删除用户与角色关联
        SysUserRole::where('user_id',$user_id)->delete();
        // 新增用户与角色管理
        $this->insertUserRole($arrData);
        // 删除用户与岗位关联
        SysUserPost::where('user_id',$user_id)->delete();
        // 新增用户与岗位管理
        $this->insertUserPost($arrData);
        unset($arrData['role']);
        unset($arrData['role_ids']);
        unset($arrData['post_ids']);
        return SysUser::where('user_id','=',$arrData['user_id'])->update($arrData);
    }

    /**
     * 修改用户个人详细信息
     *
     * @param $arrData
     * @return mixed
     */
    public function updateUserInfo($arrData)
    {
        return SysUser::where('user_id',$arrData['user_id'])->update($arrData);
    }

    /**
     * 修改用户密码
     *
     * @param $arrData
     * @return mixed
     */
    public function resetUserPwd($arrData)
    {
        return $this->updateUserInfo($arrData);
    }

    /**
     * 新增用户角色信息
     *
     * @param $arrData
     */
    public function insertUserRole($arrData)
    {
        $role_ids = $arrData['role_ids'];
        if (!empty($role_ids))
        {
            // 新增用户与角色管理
            $list = array();
            foreach (explode(",",$role_ids) as $role_id)
            {
                $user_role = array();
                $user_role['user_id'] = $arrData['user_id'];
                $user_role['role_id'] = $role_id;
                $list[] = $user_role;
            }
            if (count($list) > 0)
            {
                DB::table('sys_user_role')->insert($list);
            }
        }
    }

    /**
     * 新增用户岗位信息
     *
     * @param user 用户对象
     */
    public function insertUserPost($arrData)
    {
        $post_ids = $arrData['post_ids'];
        if (!empty($post_ids))
        {
            // 新增用户与岗位管理
            $list = array();
            foreach (explode(",",$post_ids) as $post_id)
            {
                $user_post = array();
                $user_post['user_id'] = $arrData['user_id'];
                $user_post['post_id'] = $post_id;
                $list[] = $user_post;
            }
            if (count($list) > 0)
            {
                DB::table('sys_user_post')->insert($list);
            }
        }
    }

    /**
     * 校验登录名称是否唯一
     *
     * @param $loginName
     * @return string
     */
    public function checkLoginNameUnique($loginName)
    {
        $sys_user = SysUser::where('login_name', '=', $loginName)->first();
        if (!is_null($sys_user))
        {
            return Constants::USER_NAME_NOT_UNIQUE;
        }
        return Constants::USER_NAME_UNIQUE;
    }

    /**
     * 校验用户名称是否唯一
     *
     * @param $arrData
     * @return string
     */
    public function checkPhoneUnique($arrData)
    {
        $user_id = empty($arrData['user_id']) ? -1 : $arrData['user_id'];
        $sys_user = SysUser::where('phonenumber', '=', $arrData['phonenumber'])->first();
        if (!is_null($sys_user) && $sys_user['user_id'] != $user_id)
        {
            return Constants::USER_PHONE_NOT_UNIQUE;
        }
        return Constants::USER_PHONE_UNIQUE;
    }

    /**
     * 校验email是否唯一
     *
     * @param $arrData
     * @return string
     */
    public function checkEmailUnique($arrData)
    {
        $user_id = empty($arrData['user_id']) ? -1 : $arrData['user_id'];
        $sys_user = SysUser::where('email', '=', $arrData['email'])->first();
        if (!is_null($sys_user) && $sys_user['user_id'] != $user_id)
        {
            return Constants::USER_EMAIL_NOT_UNIQUE;
        }
        return Constants::USER_EMAIL_UNIQUE;
    }

    /**
     * 校验用户是否允许操作
     *
     * @param $arrData
     * @throws BusinessException
     */
    public function checkUserAllowed($arrData)
    {
        if (!empty($arrData['user_id']) && $arrData['user_id']==1)
        {
            throw new BusinessException("不允许操作超级管理员用户");
        }
    }

    /**
     * 查询用户所属角色组
     *
     * @param $user_id
     * @return false|string
     */
    public function selectUserRoleGroup($user_id)
    {
        $roles = DB::table('sys_user_role')
            ->leftJoin('sys_role', 'sys_role.role_id','=','sys_user_role.role_id' )
            ->select('sys_role.*')
            ->where('sys_user_role.user_id' ,'=', $user_id)
            ->get();

        $idsStr = '';
        foreach ($roles as $role)
        {
            $idsStr = $idsStr . $role->role_name . ',' ;
        }
        if (!empty($idsStr))
        {
            return substr($idsStr,0,strlen($idsStr)-1) ;
        }
        return $idsStr;
    }

    /**
     * 查询用户所属岗位组
     *
     * @param $user_id
     * @return false|string
     */
    public function selectUserPostGroup($user_id)
    {
        $posts = DB::table('sys_user_post')
            ->leftJoin('sys_post', 'sys_post.post_id','=','sys_user_post.post_id' )
            ->select('sys_post.*')
            ->where('sys_user_post.user_id' ,'=', $user_id)
            ->get();

        $idsStr = '';
        foreach ($posts as $post)
        {
            $idsStr = $idsStr . $post->post_name . ',' ;
        }
        if (!empty($idsStr))
        {
            return substr($idsStr,0,strlen($idsStr)-1) ;
        }
        return $idsStr;
    }

//    /**
//     * 导入用户数据
//     *
//     * @param userList 用户数据列表
//     * @param isUpdateSupport 是否更新支持，如果已存在，则进行更新数据
//     * @param operName 操作用户
//     * @return 结果
//     */
//    @Override
//    public String importUser(List<SysUser> userList, Boolean isUpdateSupport, String operName)
//    {
//        if (StringUtils.isNull(userList) || userList.size() == 0)
//        {
//            throw new BusinessException("导入用户数据不能为空！");
//        }
//        int successNum = 0;
//        int failureNum = 0;
//        StringBuilder successMsg = new StringBuilder();
//        StringBuilder failureMsg = new StringBuilder();
//        String password = configService.selectConfigByKey("sys.user.initPassword");
//        for (SysUser user : userList)
//        {
//            try
//            {
//                // 验证是否存在这个用户
//                SysUser u = userMapper.selectUserByLoginName(user.getLoginName());
//                if (StringUtils.isNull(u))
//                {
//                    user.setPassword(Md5Utils.hash(user.getLoginName() + password));
//                    user.setCreateBy(operName);
//                    this.insertUser(user);
//                    successNum++;
//                    successMsg.append("<br/>" + successNum + "、账号 " + user.getLoginName() + " 导入成功");
//                }
//                else if (isUpdateSupport)
//                {
//                    user.setUpdateBy(operName);
//                    this.updateUser(user);
//                    successNum++;
//                    successMsg.append("<br/>" + successNum + "、账号 " + user.getLoginName() + " 更新成功");
//                }
//                else
//                {
//                    failureNum++;
//                    failureMsg.append("<br/>" + failureNum + "、账号 " + user.getLoginName() + " 已存在");
//                }
//            }
//            catch (Exception e)
//            {
//                failureNum++;
//                String msg = "<br/>" + failureNum + "、账号 " + user.getLoginName() + " 导入失败：";
//                failureMsg.append(msg + e.getMessage());
//                log.error(msg, e);
//            }
//        }
//        if (failureNum > 0)
//        {
//            failureMsg.insert(0, "很抱歉，导入失败！共 " + failureNum + " 条数据格式不正确，错误如下：");
//            throw new BusinessException(failureMsg.toString());
//        }
//        else
//        {
//            successMsg.insert(0, "恭喜您，数据已全部导入成功！共 " + successNum + " 条，数据如下：");
//        }
//        return successMsg.toString();
//    }

    /**
     * 用户状态修改
     *
     * @param $arrData
     * @return mixed
     */
    public function changeStatus($arrData)
    {
        return SysUser::where('user_id',$arrData['user_id'])->update($arrData);
    }

}
