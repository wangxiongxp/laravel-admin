<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SysRoleMenu extends Model
{
    /**
     * 与模型关联的表名
     */
    protected $table = 'sys_role_menu';

    /**
     * 白名单
     */
    protected $fillable = [
        "role_id",
        "menu_id",
    ];

    /**
     * 指示是否自动维护时间戳，默认created_at和updated_at，可以自定义，默认true
     */
    public $timestamps = false;

}
