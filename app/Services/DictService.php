<?php

namespace App\Services;

use App\Repositories\System\SysDictDataRepository;

class DictService
{
    protected $sysDictDataRepository;

    public function __construct(SysDictDataRepository $sysDictDataRepository){
        $this->sysDictDataRepository = $sysDictDataRepository;
    }

    /**
     * 根据字典类型查询字典数据信息
     *
     * @param $dict_type
     * @return
     */
    public function getType($dict_type)
    {
        return $this->sysDictDataRepository->selectDictDataByType($dict_type);
    }

    /**
     * 根据字典类型和字典键值查询字典数据信息
     *
     * @param $dict_type 字典类型
     * @param $dict_value 字典键值
     * @return \App\Repositories\System\字典标签
     */
    public function getLabel($dict_type, $dict_value)
    {
        return $this->sysDictDataRepository->selectDictLabel($dict_type, $dict_value);
    }

}
