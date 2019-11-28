<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SysOperationLog extends Model
{
    /**
     * 与模型关联的表名
     */
    protected $table = 'sys_oper_log';

    /**
     * 重定义主键
     */
    protected $primaryKey = 'oper_id';

    /**
     * 白名单
     */
    protected $fillable = [
        "title",
        "business_type",
        "method",
        "request_method",
        "operator_type",
        "oper_name",
        "dept_name",
        "oper_url",
        "oper_ip",
        "oper_location",
        "oper_param",
        "json_result",
        "status",
        "error_msg",
        "oper_time",
    ];

    /**
     * 指示是否自动维护时间戳，默认created_at和updated_at，可以自定义，默认true
     */
    public $timestamps = false;

}
