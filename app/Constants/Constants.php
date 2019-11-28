<?php

namespace App\Constants;

class Constants
{

    /**
     * 平台内系统用户的唯一标志
     */
    const SYS_USER = "SYS_USER";

    /** 正常状态 */
    const NORMAL = "0";

    /** 异常状态 */
    const EXCEPTION = "1";

    /** 用户封禁状态 */
    const USER_BLOCKED = "1";

    /** 角色封禁状态 */
    const ROLE_BLOCKED = "1";

    /** 部门正常状态 */
    const DEPT_NORMAL = "0";

    /** 字典正常状态 */
    const DICT_NORMAL = "0";

    /** 是否为系统默认（是） */
    const YES = "Y";

    /** 登录名称是否唯一的返回结果码 */
    const USER_NAME_UNIQUE = "0";
    const USER_NAME_NOT_UNIQUE = "1";

    /** 手机号码是否唯一的返回结果 */
    const USER_PHONE_UNIQUE = "0";
    const USER_PHONE_NOT_UNIQUE = "1";

    /** e-mail 是否唯一的返回结果 */
    const USER_EMAIL_UNIQUE = "0";
    const USER_EMAIL_NOT_UNIQUE = "1";

    /** 部门名称是否唯一的返回结果码 */
    const DEPT_NAME_UNIQUE = "0";
    const DEPT_NAME_NOT_UNIQUE = "1";

    /** 角色名称是否唯一的返回结果码 */
    const ROLE_NAME_UNIQUE = "0";
    const ROLE_NAME_NOT_UNIQUE = "1";

    /** 岗位名称是否唯一的返回结果码 */
    const POST_NAME_UNIQUE = "0";
    const POST_NAME_NOT_UNIQUE = "1";

    /** 角色权限是否唯一的返回结果码 */
    const ROLE_KEY_UNIQUE = "0";
    const ROLE_KEY_NOT_UNIQUE = "1";

    /** 岗位编码是否唯一的返回结果码 */
    const POST_CODE_UNIQUE = "0";
    const POST_CODE_NOT_UNIQUE = "1";

    /** 菜单名称是否唯一的返回结果码 */
    const MENU_NAME_UNIQUE = "0";
    const MENU_NAME_NOT_UNIQUE = "1";

    /** 字典类型是否唯一的返回结果码 */
    const DICT_TYPE_UNIQUE = "0";
    const DICT_TYPE_NOT_UNIQUE = "1";

    /** 参数键名是否唯一的返回结果码 */
    const CONFIG_KEY_UNIQUE = "0";
    const CONFIG_KEY_NOT_UNIQUE = "1";

}
