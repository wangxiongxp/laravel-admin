<?php

namespace App\Repositories\System;

use App\Constants\Constants;
use App\Models\SysMenu;
use App\Models\SysRoleMenu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SysMenuRepository
{
    /**
     * 查询菜单集合
     * @param $arrData
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function selectMenuList($arrData)
    {
        $query = SysMenu::query();
        if(!empty($arrData['menu_name'])){
            $query->where('menu_name','like', '%'.$arrData['menu_name'].'%');
        }
        if(!empty($arrData['visible'])){
            $query->where('visible','=', $arrData['visible']);
        }
        if(!empty($orderByColumn) && !empty($isAsc)){
            $query->orderBy($orderByColumn, $isAsc);
        }

        return $query->get();
    }

    /**
     * 根据用户查询菜单
     *
     * @param $arrData
     * @return array
     */
    public function selectMenusByUser($arrData)
    {
        // 管理员显示所有菜单信息
        if ($arrData['is_admin']){
            $menus = SysMenu::where('visible','0')
                ->whereIn('menu_type',['M','C'])
                ->orderBy('parent_id')
                ->orderBy('order_num')
                ->get()->toArray();
        }else{
            $menus = DB::table('sys_menu')
                ->join('sys_role_menu', 'sys_menu.menu_id', '=', 'sys_role_menu.menu_id')
                ->join('sys_user_role', 'sys_user_role.role_id', '=', 'sys_role_menu.role_id')
                ->join('sys_role', 'sys_role.role_id', '=', 'sys_user_role.role_id')
                ->where('sys_user_role.user_id','=',$arrData['user_id'])
                ->whereIn('sys_menu.menu_type',['M','C'])
                ->where('sys_menu.visible',0)
                ->where('sys_role.status',0)
                ->select('sys_menu.*')
                ->distinct()
                ->get()->map(function ($value) {return (array)$value;})->toArray();
        }
        return $this->getChildPerms($menus, 0);
    }

    /**
     * 查询菜单集合
     *
     * @return 所有菜单信息
     */
    public function selectMenuList1($menu, $user_id)
    {
        if (userId==1)
        {
            $menuList = menuMapper.selectMenuList(menu);
        }
        else
        {
            menu.getParams().put("userId", userId);
            $menuList = menuMapper.selectMenuListByUserId(menu);
        }
        return $menuList;
    }

    /**
     * 查询菜单集合
     *
     * @param $user_id
     * @return array|\Illuminate\Support\Collection
     */
    public function selectMenuAll($user_id)
    {
        if ($user_id==1){
            $menuList = SysMenu::get();
        }else {
            $menuList = DB::table('sys_menu')
                ->join('sys_role_menu', 'sys_menu.menu_id', '=', 'sys_role_menu.menu_id')
                ->join('sys_user_role', 'sys_user_role.role_id', '=', 'sys_role_menu.role_id')
                ->select('sys_menu.*')
                ->where('sys_user_role.user_id','=',$user_id)
                ->get();
        }
        return $menuList;
    }

    /**
     * 根据用户ID查询权限
     *
     * @param userId 用户ID
     * @return 权限列表
     */
    public function selectPermsByUserId($user_id)
    {
//        List<String> perms = menuMapper.selectPermsByUserId(userId);
//        Set<String> permsSet = new HashSet<>();
//        for (String perm : perms)
//        {
//            if (StringUtils.isNotEmpty(perm))
//            {
//                permsSet.addAll(Arrays.asList(perm.trim().split(",")));
//            }
//        }
//        return permsSet;
    }

    /**
     * 根据角色ID查询菜单
     *
     * @param $request
     * @param $user_id
     * @return array
     */
    public function roleMenuTreeData($request, $user_id)
    {
        $menuList = $this->selectMenuAll($user_id);
        if (!empty($request['role_id']))
        {
            $roleMenuList = DB::table('sys_menu')
                ->join('sys_role_menu', 'sys_menu.menu_id', '=', 'sys_role_menu.menu_id')
//                ->select('sys_menu.*')
                ->where('sys_role_menu.role_id','=',$request['role_id'])
                ->selectRaw('concat(sys_menu.menu_id, ifnull(sys_menu.perms,\'\')) as perms')
                ->get()->map(function ($value) {return (array)$value;})->toArray();
            $ztrees = $this->initZtree($menuList, $roleMenuList, true);
        }
        else
        {
            $ztrees = $this->initZtree($menuList, null, true);
        }
        return $ztrees;
    }

    /**
     * 查询所有菜单
     *
     * @param $user_id
     * @return array
     */
    public function menuTreeData($user_id)
    {
        $menuList = $this->selectMenuAll($user_id);
        return $this->initZtree($menuList,null,false);
    }

    /**
     * 查询系统所有权限
     *
     * @param $user_id
     */
    public function selectPermsAll($user_id)
    {
//        LinkedHashMap<String, String> section = new LinkedHashMap<>();
//        List<SysMenu> permissions = selectMenuAll(userId);
//        if (StringUtils.isNotEmpty(permissions))
//        {
//            for (SysMenu menu : permissions)
//            {
//                section.put(menu.getUrl(), MessageFormat.format(PREMISSION_STRING, menu.getPerms()));
//            }
//        }
//        return section;
    }

    /**
     * 对象转菜单树
     *
     * @param $menuList
     * @param $roleMenuList
     * @param $permsFlag
     * @return array
     */
    public function initZtree($menuList, $roleMenuList, $permsFlag)
    {
        $ztrees = array();
        $isCheck = !empty($roleMenuList);
        foreach ($menuList as $menu)
        {
            $ztree = array();
            $ztree['id']    = $menu['menu_id'];
            $ztree['pId']   = $menu['parent_id'];
            $ztree['name']  = self::transMenuName($menu,$permsFlag);
            $ztree['title'] = $menu['menu_name'];
            if ($isCheck)
            {
                $has = false;
                foreach ($roleMenuList as $roleMenu){
                    if($roleMenu['perms']==$menu['menu_id'].$menu['perms']){
                        $has = true;
                    }
                }
                $ztree['checked'] = $has;
            }
            $ztrees[] = $ztree;
        }
        return $ztrees;
    }

    public function transMenuName($menu, $permsFlag)
    {
        $return = $menu['menu_name'];
        if ($permsFlag)
        {
            $return = $return . "<font color=\"#888\">&nbsp;&nbsp;&nbsp;" . $menu['perms'] . "</font>";
        }
        return $return;
    }

    /**
     * 删除菜单管理信息
     *
     * @param $menu_id
     * @return mixed
     */
    public function deleteMenuById($menu_id)
    {
        return SysMenu::where('menu_id', '=', $menu_id)->delete();
    }

    /**
     * 根据菜单ID查询信息
     *
     * @param $menu_id
     * @return mixed
     */
    public function selectMenuById($menu_id)
    {
        return SysMenu::where('menu_id', '=', $menu_id)->first();
    }

    /**
     * 查询子菜单数量
     *
     * @param $parent_id
     * @return mixed
     */
    public function selectCountMenuByParentId($parent_id)
    {
        return SysMenu::where('parent_id', '=', $parent_id)->count();
    }

    /**
     * 查询菜单使用数量
     *
     * @param $menu_id
     * @return mixed
     */
    public function selectCountRoleMenuByMenuId($menu_id)
    {
        return SysRoleMenu::where('menu_id', '=', $menu_id)->count();
    }

    /**
     * 新增保存菜单信息
     *
     * @param $menu
     * @return mixed
     */
    public function insertMenu($menu)
    {
        $arrData['create_by'] = Auth::user()->user_name;
        return SysMenu::create($menu);
    }

    /**
     * 修改保存菜单信息
     *
     * @param $menu
     * @return mixed
     */
    public function updateMenu($menu)
    {
        $arrData['update_by'] = Auth::user()->user_name;
        return SysMenu::where('menu_id','=',$menu['menu_id'])->update($menu);
    }

    /**
     * 校验菜单名称是否唯一
     *
     * @param $request
     * @return string
     */
    public function checkMenuNameUnique($request)
    {
        $menu_id = empty($request['menu_id']) ? -1 : $request['menu_id'];
        $sys_menu = SysMenu::where('menu_name', '=', $request['menu_name'])->where('parent_id', '=', $request['parent_id'])->first();
        if (!is_null($sys_menu) && $sys_menu['menu_id'] != $menu_id)
        {
            return Constants::MENU_NAME_NOT_UNIQUE;
        }
        return Constants::MENU_NAME_UNIQUE;
    }

    /**
     * 根据父节点的ID获取所有子节点
     *
     * @param $sys_menus
     * @param $parent_id
     * @return array
     */
    public function getChildPerms($sys_menus, $parent_id)
    {
        $returnList = array();
        foreach ($sys_menus as &$sys_menu){
            if ($sys_menu['parent_id'] == $parent_id){
                $this->recursionFn($sys_menus, $sys_menu);
                $returnList[] = $sys_menu;
            }
        }
        return $returnList;
    }

    /**
     * 递归列表
     *
     * @param $sys_menus
     * @param $sys_menu
     * @return mixed
     */
    private function recursionFn($sys_menus, &$sys_menu)
    {
        // 得到子节点列表
        $childList = $this->getChildList($sys_menus, $sys_menu);
        foreach ($childList as &$child){
            if ($this->hasChild($sys_menus, $child)){
                // 判断是否有子节点
                $this->recursionFn($sys_menus,$child);
            }
        }
        $sys_menu['children'] = $childList;
    }

    /**
     * 得到子节点列表
     * @param $sys_menus
     * @param $parent_menu
     * @return array
     */
    private function getChildList($sys_menus, $parent_menu)
    {
        $return = array();
        foreach ($sys_menus as $sys_menu){
            if($sys_menu['parent_id'] == $parent_menu['menu_id']){
                $return[] = $sys_menu;
            }
        }
        return $return;
    }

    /**
     * 判断是否有子节点
     */
    private function hasChild($sys_menus, $parent_menu)
    {
        return count($this->getChildList($sys_menus, $parent_menu)) > 0 ? true : false;
    }

    public function selectMenuByPerms($perms,$user)
    {
        $menuList = DB::table('sys_menu')
            ->join('sys_role_menu', 'sys_menu.menu_id', '=', 'sys_role_menu.menu_id')
            ->join('sys_user_role', 'sys_user_role.role_id', '=', 'sys_role_menu.role_id')
            ->where('sys_menu.perms','=',$perms)
            ->where('sys_user_role.user_id','=',$user['user_id'])
            ->count();

        return $menuList>0?true:false;
    }
}
