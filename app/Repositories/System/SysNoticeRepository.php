<?php

namespace App\Repositories\System;

use App\Models\SysNotice;
use Illuminate\Support\Facades\Auth;

class SysNoticeRepository
{

    /**
     * 查询公告列表
     *
     * @param $arrData
     * @return array
     */
    public function selectNoticeList($arrData)
    {
        $pageNum     = $arrData['pageNum'] ;
        $pageSize    = $arrData['pageSize'] ;

        $query = SysNotice::query();
        if(!empty($arrData['notice_title'])){
            $query->where('notice_title','like', '%'.$arrData['notice_title'].'%');
        }
        if(!empty($arrData['notice_type'])){
            $query->where('notice_type','=', $arrData['notice_type']);
        }
        if(!empty($arrData['create_by'])){
            $query->where('create_by','like', '%'.$arrData['create_by'].'%');
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
     * 查询公告信息
     *
     * @param $notice_id
     * @return mixed
     */
    public function selectNoticeById($notice_id)
    {
        return SysNotice::where('notice_id', '=', $notice_id)->first();
    }

    /**
     * 新增公告
     *
     * @param $arrData
     * @return mixed
     */
    public function insertNotice($arrData)
    {
        $arrData['create_by'] = Auth::user()->user_name;
        return SysNotice::create($arrData);
    }

    /**
     * 修改公告
     *
     * @param $arrData
     * @return mixed
     */
    public function updateNotice($arrData)
    {
        $arrData['update_by'] = Auth::user()->user_name;
        return SysNotice::where('notice_id','=',$arrData['notice_id'])->update($arrData);
    }

    /**
     * 删除公告对象
     *
     * @param $ids
     * @return mixed
     */
    public function deleteNoticeByIds($ids)
    {
        $id_arr = explode(",",$ids);
        return SysNotice::whereIn('notice_id', $id_arr)->delete();
    }
}
