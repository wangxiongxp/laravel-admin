<?php

namespace App\Repositories\System;

use App\Models\SysOperationLog;

class SysOperationLogRepository
{
    /**
     * 查询列表
     * @param $arrData
     * @return array
     */
    public function selectOperLogList($arrData)
    {
        $pageNum     = $arrData['pageNum'] ;
        $pageSize    = $arrData['pageSize'] ;

        $query = SysOperationLog::query();
        if(!empty($arrData['title'])){
            $query->where('title','like', '%'.$arrData['title'].'%');
        }
        if(!empty($arrData['business_type'])){
            $query->where('business_type','=', $arrData['business_type']);
        }
        if(!empty($arrData['status'])){
            $query->where('config_key','=', $arrData['status']);
        }
        if(!empty($arrData['oper_name'])){
            $query->where('oper_name','like', '%'.$arrData['oper_name'].'%');
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
     * 新增操作日志
     *
     * @param $arrData
     * @return mixed
     */
    public function insertOperlog($arrData)
    {
        return SysOperationLog::create($arrData);
    }

    /**
     * 批量删除系统操作日志
     *
     * @param $ids
     * @return mixed
     */
    public function deleteOperLogByIds($ids)
    {
        $id_arr = explode(",",$ids);
        return SysOperationLog::whereIn('oper_id', $id_arr)->delete();
    }

    /**
     * 查询操作日志详细
     *
     * @param $oper_id
     * @return mixed
     */
    public function selectOperLogById($oper_id)
    {
        return SysOperationLog::where('oper_id', '=', $oper_id)->first();
    }

    /**
     * 清空操作日志
     */
    public function cleanOperLog()
    {
        SysOperationLog::truncate();
    }

}
