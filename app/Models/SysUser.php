<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class SysUser extends Authenticatable
{
    use Notifiable;

    /**
     * 自定义存储时间戳的字段名
     */
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    /**
     * 与模型关联的表名
     */
    protected $table = 'sys_user';

    /**
     * 重定义主键
     */
    protected $primaryKey = 'user_id';

    /**
     * 指示模型主键是否递增，默认true
     */
    public $incrementing = true;

    /**
     * 自动递增ID的“类型”，默认int
     */
    protected $keyType = 'int';

    /**
     * 白名单，字段可以写入/修改，只限制了 create 方法，不会限制 save
     */
    protected $fillable = [
        "dept_id",
        "login_name",
        "user_name",
        "user_type",
        "email",
        "phonenumber",
        "sex",
        "avatar",
        "password",
        "salt",
        "status",
        "del_flag",
        "login_ip",
        "login_date",
        "remark",
        "create_by",
        "update_by",
    ];

    /**
     * 黑名单，字段不可以写入/修改，只限制了 create 方法，不会限制 save
     */
    protected $guarded = [];

    /**
     * 指示是否自动维护时间戳，默认created_at和updated_at，可以自定义，默认true
     */
    public $timestamps = true;

    /**
     *  模型的默认属性值
     */
    protected $attributes = [
//        'delayed' => false,
    ];

    /**
     * 序列化时候忽略
     */
    protected $hidden = [];

    /**
     * 序列化时候显示
     */
    protected $visible = [];

}
