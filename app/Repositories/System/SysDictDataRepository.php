<?php

namespace App\Repositories\System;

use App\Models\SysDictData;
use Illuminate\Support\Facades\Auth;

class SysDictDataRepository
{
    /**
     * 查询列表
     * @param $arrData
     * @return array
     */
    public function selectDictDataList($arrData)
    {
        $pageNum     = $arrData['pageNum'] ;
        $pageSize    = $arrData['pageSize'] ;

        $query = SysDictData::query();
        if(!empty($arrData['dict_type'])){
            $query->where('dict_type','=', $arrData['dict_type']);
        }
        if(!empty($arrData['dict_label'])){
            $query->where('dict_label','like', '%'.$arrData['dict_label'].'%');
        }
        if(!empty($orderByColumn) && !empty($isAsc)){
            $query->orderBy($orderByColumn, $isAsc);
        }
        if(!empty($arrData['status'])){
            $query->where('status','=', $arrData['status']);
        }

        $sum = $query->count();
        if($sum > 0){
            //从第几条开始
            $start = ( intval($pageNum) - 1 ) * $pageSize ;
            $rows = $query->skip($start)->take($pageSize)->get();
        }else{
            $rows = array();
        }

        $resultData = array();
        $resultData['pageNum']   = $pageNum;
        $resultData['pageSize']  = $pageSize ;
        $resultData['total']     = $sum ;
        $resultData['rows']      = $rows ;
        return $resultData ;
    }

    /**
     * 根据字典类型查询字典数据
     *
     * @param $dict_type
     * @return mixed
     */
    public function selectDictDataByType($dict_type)
    {
        return SysDictData::where('dict_type', '=', $dict_type)->get();
    }

    /**
     * 根据字典类型和字典键值查询字典数据信息
     *
     * @param $dict_type
     * @param $dict_value
     * @return mixed
     */
    public function selectDictLabel($dict_type, $dict_value)
    {
        return SysDictData::where('dict_type', '=', $dict_type)->where('dict_value', '=', $dict_value)->pluck('dict_label')->first();
    }

    /**
     * 根据字典数据ID查询信息
     *
     * @param $dict_code
     * @return mixed
     */
    public function selectDictDataById($dict_code)
    {
        return SysDictData::where('dict_code', '=', $dict_code)->first();
    }

    /**
     * 通过字典ID删除字典数据信息
     *
     * @param $dict_code
     * @return mixed
     */
    public function deleteDictDataById($dict_code)
    {
        return SysDictData::where('dict_code', '=', $dict_code)->delete();
    }

    /**
     * 批量删除字典数据
     *
     * @param $ids
     * @return mixed
     */
    public function deleteDictDataByIds($ids)
    {
        $id_arr = explode(",",$ids);
        return SysDictData::whereIn('dict_code', $id_arr)->delete();
    }

    /**
     * 新增保存字典数据信息
     *
     * @param $arrData
     * @return mixed
     */
    public function insertDictData($arrData)
    {
        $arrData['create_by'] = Auth::user()->user_name;
        return SysDictData::create($arrData);
    }

    /**
     * 修改保存字典数据信息
     *
     * @param $arrData
     * @return mixed
     */
    public function updateDictData($arrData)
    {
        $arrData['update_by'] = Auth::user()->user_name;
        return SysDictData::where('dict_code','=',$arrData['dict_code'])->update($arrData);
    }

}
