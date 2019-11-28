<?php

namespace App\Utils;

use Linfo\Linfo;

class Sysinfo
{
    protected $info;

    public function __construct()
    {
        $this->info = (new Linfo())->getParser();
    }

    /**
     * 获取服务器系统信息
     */
    public function server()
    {
        return $this->info->getModel().' '.$this->info->getOS();
    }

    /**
     * 获取cpu信息
     */
    public function cpu()
    {
        $cpu = $this->info->getCPU();
        return $cpu[0]['Model']
            .' '
            .$cpu[0]['MHz']
            .' '
            .$cpu[0]['Vendor'];
    }

    /**
     * 获取内存信息
     */
    public function memory()
    {
        $ram 	= $this->info->getRam();
        return $ram['type']
            .' '
            .ceil(intval($ram['total'])/(1024*1024*1024))
            .'GB';
    }

    /**
     * Laravel版本
     */
    public function laravel()
    {
        return app()->version();
    }

    /**
     * 时区设置
     */
    public function timezone()
    {
        return config('app.timezone');
    }

    /**
     * 安装模式
     */
    public function safeMode()
    {
        return (boolean) ini_get('safe_mode') ?  '是':'否';
    }

    /**
     * 上传文件最大大小
     */
    public function upload_max_filesize()
    {
        return ini_get("upload_max_filesize");
    }

    /**
     * web server
     */
    public function webserver()
    {
        return request()->server('SERVER_SOFTWARE');
    }

    /**
     * 获取数据库信息
     */
    public function mysql()
    {
        $host           =  env('DB_HOST');
        $database       =  env('DB_DATABASE');
        $username       =  env('DB_USERNAME');
        $password       =  env('DB_PASSWORD');
        $mysqli 	= new mysqli($host, $username, $password);
        return $mysqli->server_info;
    }

    /**
     * php的版本
     */
    public function php()
    {
        return phpversion();
    }

    /**
     * 获取服务器ip地址
     */
    public function ip()
    {
        return request()->server('SERVER_ADDR');
    }
}
