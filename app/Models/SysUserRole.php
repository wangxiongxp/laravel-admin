<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SysUserRole extends Model
{
    /**
     * 与模型关联的表名
     */
    protected $table = 'sys_user_role';

    /**
     * 白名单
     */
    protected $fillable = [
        "user_id",
        "role_id",
    ];

    /**
     * 指示是否自动维护时间戳，默认created_at和updated_at，可以自定义，默认true
     */
    public $timestamps = false;

}
