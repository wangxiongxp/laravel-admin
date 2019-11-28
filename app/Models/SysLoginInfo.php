<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SysLoginInfo extends Model
{
    /**
     * 与模型关联的表名
     */
    protected $table = 'sys_logininfor';

    /**
     * 重定义主键
     */
    protected $primaryKey = 'info_id';

    /**
     * 白名单
     */
    protected $fillable = [
        "login_name",
        "ipaddr",
        "login_location",
        "browser",
        "os",
        "status",
        "msg",
        "login_time",
    ];

    /**
     * 指示是否自动维护时间戳，默认created_at和updated_at，可以自定义，默认true
     */
    public $timestamps = false;

}
