<?php

namespace App\Repositories\System;

use App\Constants\Constants;
use App\Models\SysConfig;
use Illuminate\Support\Facades\Auth;

class SysConfigRepository
{
    /**
     * 查询列表
     * @param $arrData
     * @return array
     */
    public function selectConfigList($arrData)
    {
        $pageNum     = $arrData['pageNum'] ;
        $pageSize    = $arrData['pageSize'] ;

        $query = SysConfig::query();
        if(!empty($arrData['config_name'])){
            $query->where('config_name','like', '%'.$arrData['config_name'].'%');
        }
        if(!empty($arrData['config_type'])){
            $query->where('config_type','=', $arrData['config_type']);
        }
        if(!empty($arrData['config_key'])){
            $query->where('config_key','like', '%'.$arrData['config_key'].'%');
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
     * 查询参数配置信息
     *
     * @param $config_id
     * @return mixed
     */
    public function selectConfigById($config_id)
    {
        //查询构造器操作
        //$sys_config = DB::table('sys_config')->where('config_id', $config_id)->first();

        return SysConfig::where('config_id', '=', $config_id)->first();
    }

    /**
     * 根据键名查询参数配置信息
     *
     * @param $config_key
     * @return mixed
     */
    public function selectConfigByKey($config_key)
    {
        $sys_config = SysConfig::where('config_key', '=', $config_key)->first();
        if(!is_null($sys_config)){
            return $sys_config->config_value;
        }else{
            return '';
        }
    }

    /**
     * 新增参数配置
     *
     * @param $arrData
     * @return mixed
     */
    public function insertConfig($arrData)
    {
        //查询构造器操作
        //$bool = DB::table("sys_config")->insert($arrData);
        //$id   = DB::table("sys_config")->insertGetId($arrData);

        //通过模型save方法，返回bool值
        //$sysConfig = new SysConfig();
        //$sysConfig->config_name = '张三';
        //$bool = $sysConfig->save();

        //返回SysConfig实体对象
        $arrData['create_by'] = Auth::user()->user_name;
        return SysConfig::create($arrData);
    }

    /**
     * 修改参数配置
     *
     * @param $arrData
     * @return mixed
     */
    public function updateConfig($arrData)
    {
        //查询构造器操作，返回bool值
        //$bool = DB::table("sys_config")->where('config_id',$config_id)->update($arrData);

        //通过模型更新数据,返回bool值
        //$sysConfig = SysConfig::find($arrData['config_id']);
        //$sysConfig->config_name = "张三";
        //$bool = $sysConfig->save();

        //返回更新的行数
        $arrData['update_by'] = Auth::user()->user_name;
        return SysConfig::where('config_id','=',$arrData['config_id'])->update($arrData);
    }

    /**
     * 删除参数配置对象
     * @param $config_id
     * @return mixed
     */
    public function deleteConfigById($config_id)
    {
        //查询构造器操作，返回删除的行数
        //$rows = DB::table("sys_config")->where('config_id',$config_id)->delete();

        //根据主键删除，返回删除的行数
        //SysConfig::destroy($config_id);

        //返回bool|null
        return SysConfig::where('config_id', '=', $config_id)->delete();
    }

    /**
     * 批量删除参数配置对象
     *
     * @param $ids
     * @return mixed
     */
    public function deleteConfigByIds($ids)
    {
        $id_arr = explode(",",$ids);
        return SysConfig::whereIn('config_id', $id_arr)->delete();
    }

    /**
     * 校验参数键名是否唯一
     *
     * @param $arrData
     * @return string
     */
    public function checkConfigKeyUnique($arrData)
    {
        $config_id = empty($arrData['config_id']) ? -1 : $arrData['config_id'];
        $sys_config = SysConfig::where('config_key', '=', $arrData['config_key'])->first();
        if (!is_null($sys_config) && $sys_config['config_id'] != $config_id)
        {
            return Constants::CONFIG_KEY_NOT_UNIQUE;
        }
        return Constants::CONFIG_KEY_UNIQUE;
    }

}
