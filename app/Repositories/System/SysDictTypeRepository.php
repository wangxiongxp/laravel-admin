<?php

namespace App\Repositories\System;

use App\Constants\Constants;
use App\Exceptions\BusinessException;
use App\Models\SysDictData;
use App\Models\SysDictType;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SysDictTypeRepository
{
    /**
     * 查询列表
     * @param $arrData
     * @return array
     */
    public function selectDictTypeList($arrData)
    {
        $pageNum     = $arrData['pageNum'] ;
        $pageSize    = $arrData['pageSize'] ;

        $query = SysDictType::query();
        if(!empty($arrData['dict_name'])){
            $query->where('dict_name','like', '%'.$arrData['dict_name'].'%');
        }
        if(!empty($arrData['status'])){
            $query->where('status','=', $arrData['status']);
        }
        if(!empty($arrData['dict_type'])){
            $query->where('dict_type','like', '%'.$arrData['dict_type'].'%');
        }
        if(!empty($arrData['start_time'])){
            $query->whereDate('create_time','>=', $arrData['start_time']);
        }
        if(!empty($arrData['end_time'])){
            $query->whereDate('create_time','<=', $arrData['end_time']);
        }
        if(!empty($orderByColumn) && !empty($isAsc)){
            $query->orderBy($orderByColumn, $isAsc);
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
     * 根据所有字典类型
     *
     * @return mixed
     */
    public function selectDictTypeAll()
    {
        return SysDictType::all();
    }

    /**
     * 根据字典类型ID查询信息
     *
     * @param $dict_id
     * @return mixed
     */
    public function selectDictTypeById($dict_id)
    {
        return SysDictType::where('dict_id', '=', $dict_id)->first();
    }

    /**
     * 根据字典类型查询信息
     *
     * @param $dict_type
     * @return mixed
     */
    public function selectDictTypeByType($dict_type)
    {
        return SysDictType::where('dict_type', '=', $dict_type)->first();
    }

    /**
     * 通过字典ID删除字典信息
     *
     * @param $dict_id
     * @return mixed
     */
    public function deleteDictTypeById($dict_id)
    {
        return SysDictType::where('dict_id', '=', $dict_id)->delete();
    }

    /**
     * 批量删除字典类型
     *
     * @param $ids
     * @return mixed
     * @throws BusinessException
     */
    public function deleteDictTypeByIds($ids)
    {
        $id_arr = explode(",",$ids);
        foreach ($id_arr as $dict_id)
        {
            $sys_dict = $this->selectDictTypeById($dict_id);
            if ($this->countDictDataByType($sys_dict['dict_type']) > 0)
            {
                throw new BusinessException($sys_dict['dict_name'].'已分配,不能删除');
            }
        }
        return SysDictType::whereIn('dict_id', $id_arr)->delete();
    }

    /**
     * 新增保存字典类型信息
     *
     * @param $arrData
     * @return mixed
     */
    public function insertDictType($arrData)
    {
        $arrData['create_by'] = Auth::user()->user_name;
        return SysDictType::create($arrData);
    }

    /**
     * 修改保存字典类型信息
     *
     * @param $arrData
     */
    public function updateDictType($arrData)
    {
        DB::transaction(function () use ($arrData) {
            $oldDict = $this->selectDictTypeById($arrData['dict_id']);
            SysDictData::where('dict_type','=',$oldDict['dict_type'])->update(['dict_type'=>$arrData['dict_type']]);
            $arrData['update_by'] = Auth::user()->user_name;
            SysDictType::where('dict_id','=',$arrData['dict_id'])->update($arrData);
        });
    }

    /**
     * 校验字典类型称是否唯一
     *
     * @param $arrData
     * @return string
     */
    public function checkDictTypeUnique($arrData)
    {
        $dict_id = empty($arrData['dict_id']) ? -1 : $arrData['dict_id'];
        $sys_dict = SysDictType::where('dict_type', '=', $arrData['dict_type'])->first();
        if (!is_null($sys_dict) && $sys_dict['dict_id'] != $dict_id)
        {
            return Constants::DICT_TYPE_NOT_UNIQUE;
        }
        return Constants::DICT_TYPE_UNIQUE;
    }

    /**
     * 查询字典类型树
     *
     * @param $dictType
     * @return array
     */
    public function selectDictTree($dictType)
    {
        $ztrees = array();
        $dictList = $this->selectDictTypeList($dictType);
        foreach ($dictList as $dict)
        {
            if (Constants::DICT_NORMAL == $dict['status'])
            {
                $ztree = array();
                $ztree['id'] = $dict['dict_id'];
                $ztree['name'] = self::transDictName($dict);
                $ztree['title'] = $dict['dict_type'];
                $ztrees[] = $ztree;
            }
        }
        return $ztrees;
    }

    private function transDictName($dictType)
    {
         return '(' . $dictType['dict_name'] . ')&nbsp;&nbsp;&nbsp' . $dictType['dict_type'] ;
    }

}
