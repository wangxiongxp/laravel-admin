<?php

namespace App\Services;

use App\Repositories\System\SysConfigRepository;

class ConfigService
{
    protected $sysConfigRepository;

    public function __construct(SysConfigRepository $sysConfigRepository){
        $this->sysConfigRepository = $sysConfigRepository;
    }

    /**
     * 根据键名查询参数配置信息
     *
     * @param $config_key
     * @return mixed
     */
    public function getKey($config_key)
    {
        return $this->sysConfigRepository->selectConfigByKey($config_key);
    }

}
