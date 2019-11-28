<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SysPost extends Model
{
    /**
     * 自定义存储时间戳的字段名
     */
    const CREATED_AT = 'create_time';
    const UPDATED_AT = 'update_time';

    /**
     * 与模型关联的表名
     */
    protected $table = 'sys_post';

    /**
     * 重定义主键
     */
    protected $primaryKey = 'post_id';

    /**
     * 白名单
     */
    protected $fillable = [
        "post_code",
        "post_name",
        "post_sort",
        "status",
        "remark",
        "create_by",
        "update_by",
    ];

    /**
     * 指示是否自动维护时间戳，默认created_at和updated_at，可以自定义，默认true
     */
    public $timestamps = true;

}
