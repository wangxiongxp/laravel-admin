<?php

namespace App\Repositories\System;

use App\Models\SysLoginInfo;
use App\Utils\CommonUtil;

class SysLoginInfoRepository
{
    /**
     * 查询列表
     * @param $arrData
     * @return array
     */
    public function selectLogininforList($arrData)
    {
        $pageNum     = $arrData['pageNum'] ;
        $pageSize    = $arrData['pageSize'] ;

        $query = SysLoginInfo::query();
        if(!empty($arrData['ipaddr'])){
            $query->where('ipaddr','like', '%'.$arrData['ipaddr'].'%');
        }
        if(!empty($arrData['status'])){
            $query->where('status','=', $arrData['status']);
        }
        if(!empty($arrData['loginName'])){
            $query->where('loginName','like', '%'.$arrData['loginName'].'%');
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
     * 新增系统登录日志
     *
     * @param $arrData
     * @return mixed
     */
    public function insertLogininfor($arrData)
    {
        $arrData['ipaddr']         = CommonUtil::getIP();
//        $arrData['login_location'] = Utils::GetDatetimeWithUTC();
        $arrData['browser']        = CommonUtil::getBrowser();
        $arrData['os']             = CommonUtil::getPlatform();
        $arrData['login_time']     = CommonUtil::getDatetime();

        return SysLoginInfo::create($arrData);
    }

    /**
     * 批量删除系统登录日志
     *
     * @param $ids
     * @return mixed
     */
    public function deleteLogininforByIds($ids)
    {
        $id_arr = explode(",",$ids);
        return SysLoginInfo::whereIn('info_id', $id_arr)->delete();
    }

    /**
     * 清空系统登录日志
     */
    public function cleanLogininfor()
    {
        SysLoginInfo::truncate();
    }
}
