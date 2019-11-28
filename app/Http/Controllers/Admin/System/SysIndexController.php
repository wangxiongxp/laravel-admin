<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Repositories\System\SysMenuRepository;
use Illuminate\Support\Facades\Auth;

class SysIndexController extends Controller
{
    protected $prefix = 'admin';
    protected $sysMenuRepository;

    public function __construct(SysMenuRepository $sysMenuRepository){
        $this->sysMenuRepository = $sysMenuRepository;
    }

    // 系统首页
    public function index()
    {
        $data = array();
        // 根据用户id取出菜单
        $param = array();
        $user = Auth::user();
        if($user->user_id==1){
            $param['is_admin'] = true;
        }else{
            $param['is_admin'] = false;
            $param['user_id'] = $user->user_id;
        }
        $data['menus'] = $this->sysMenuRepository->selectMenusByUser($param);
        return view($this->prefix."/index",$data);
    }

    /**
     * 切换主题
     */
    public function switchSkin()
    {
        return view($this->prefix."/skin");
    }

    // 系统介绍
    public function main()
    {
        return view($this->prefix."/main");
    }

}
