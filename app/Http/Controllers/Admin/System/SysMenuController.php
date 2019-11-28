<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Repositories\System\SysMenuRepository;
use Illuminate\Http\Request;

class SysMenuController extends Controller
{

    protected $prefix = 'admin/system/menu';
    protected $sysMenuRepository;

    public function __construct(SysMenuRepository $sysMenuRepository){
        $this->sysMenuRepository = $sysMenuRepository;
    }

    public function index(){
        return view($this->prefix."/index");
    }

    public function list(Request $request)
    {
        $result = $this->sysMenuRepository->selectMenuList($request->all());
        return $this->showListResult($result);
    }

    public function add($parent_id)
    {
        $data = array();
        if (0 != $parent_id){
            $menu = $this->sysMenuRepository->selectMenuById($parent_id);
        }else{
            $menu = array();
            $menu['menu_id'] = 0;
            $menu['menu_name'] = '主目录';
        }
        $data['menu'] = $menu;
        return view($this->prefix."/add",$data);
    }

    public function save(Request $request){
        $this->sysMenuRepository->insertMenu($request->all());
        return $this->showJsonResult(true, '操作成功', []);
    }

    public function edit($menu_id)
    {
        $data = array();
        $menu = $this->sysMenuRepository->selectMenuById($menu_id);
        $parent = $this->sysMenuRepository->selectMenuById($menu['parent_id']);
        if(!is_null($parent)){
            $data['parent'] = $parent ;
        }
        $data['menu'] = $menu ;
        return view($this->prefix."/edit",$data);
    }

    public function update(Request $request){
        $this->sysMenuRepository->updateMenu($request->all());
        return $this->showJsonResult(true, '操作成功', []);
    }

    public function remove($menu_id){
        if ($this->sysMenuRepository->selectCountMenuByParentId($menu_id) > 0)
        {
            return $this->showJsonResult(false, '存在子菜单,不允许删除', []);
        }
        if ($this->sysMenuRepository->selectCountRoleMenuByMenuId($menu_id) > 0)
        {
            return $this->showJsonResult(false, '菜单已分配,不允许删除', []);
        }
//        ShiroUtils.clearCachedAuthorizationInfo();
        $this->sysMenuRepository->deleteMenuById($menu_id);
        return $this->showJsonResult(true, '操作成功', []);
    }

    public function checkMenuNameUnique(Request $request)
    {
        return $this->sysMenuRepository->checkMenuNameUnique($request);
    }

    /**
     * 加载角色菜单列表树
     */
    public function roleMenuTreeData(Request $request)
    {
//        Long userId = ShiroUtils.getUserId();
        $user_id = 1;
        return $this->sysMenuRepository->roleMenuTreeData($request->all(), $user_id);
    }

    /**
     * 加载所有菜单列表树
     */
    public function menuTreeData()
    {
//        Long userId = ShiroUtils.getUserId();
        $user_id = 1;
        return $this->sysMenuRepository->menuTreeData($user_id);
    }

    /**
     * 选择菜单树
     */
    public function selectMenuTree($menu_id)
    {
        $data = array();
        $menu = $this->sysMenuRepository->selectMenuById($menu_id);
        $data['menu'] = $menu;
        return view($this->prefix."/tree",$data);
    }

}
