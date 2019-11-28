<?php

namespace App\Repositories\System;

use App\Constants\Constants;
use App\Exceptions\BusinessException;
use App\Models\SysPost;
use App\Models\SysUserPost;
use Illuminate\Support\Facades\Auth;

class SysPostRepository
{

    /**
     * 查询列表
     * @param $arrData
     * @return array
     */
    public function selectPostList($arrData)
    {
        $pageNum     = $arrData['pageNum'] ;
        $pageSize    = $arrData['pageSize'] ;

        $query = SysPost::query();
        if(!empty($arrData['post_code'])){
            $query->where('post_code','like', '%'.$arrData['post_code'].'%');
        }
        if(!empty($arrData['status'])){
            $query->where('status','=', $arrData['status']);
        }
        if(!empty($arrData['post_name'])){
            $query->where('post_name','like', '%'.$arrData['post_name'].'%');
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
     * 查询所有岗位
     * @return SysPost[]|\Illuminate\Database\Eloquent\Collection
     */
    public function selectPostAll()
    {
        return SysPost::all();
    }

    /**
     * 根据用户ID查询岗位
     *
     * @param $user_id
     * @return mixed
     */
    public function selectPostsByUserId($user_id)
    {
        $posts = $this->selectPostAll();
        foreach ($posts as $post)
        {
            $post['flag'] = false ;
            $user_post = SysUserPost::where('user_id',$user_id)->where('post_id',$post['post_id'])->first();
            if (!is_null($user_post)){
                $post['flag'] = true ;
            }
        }
        return $posts;
    }

    /**
     * 通过岗位ID查询岗位信息
     *
     * @param $post_id
     * @return mixed
     */
    public function selectPostById($post_id)
    {
        return SysPost::where('post_id', '=', $post_id)->first();
    }

    /**
     * 批量删除岗位信息
     *
     * @param $ids
     * @return mixed
     * @throws BusinessException
     */
    public function deletePostByIds($ids)
    {
        $id_arr = explode(",",$ids);
        foreach ($id_arr as $post_id)
        {
            $sys_post = $this->selectPostById($post_id);
            if ($this->countUserPostById($post_id) > 0)
            {
                throw new BusinessException($sys_post['post_name'].'已分配,不能删除');
            }
        }
        return SysPost::whereIn('post_id', $id_arr)->delete();
    }

    /**
     * 新增保存岗位信息
     *
     * @param $arrData
     * @return mixed
     */
    public function insertPost($arrData)
    {
        $arrData['create_by'] = Auth::user()->user_name;
        return SysPost::create($arrData);
    }

    /**
     * 修改保存岗位信息
     *
     * @param $arrData
     * @return mixed
     */
    public function updatePost($arrData)
    {
        $arrData['update_by'] = Auth::user()->user_name;
        return SysPost::where('post_id','=',$arrData['post_id'])->update($arrData);
    }

    /**
     * 通过岗位ID查询岗位使用数量
     *
     * @param $post_id
     * @return mixed
     */
    public function countUserPostById($post_id)
    {
        return SysUserPost::where('post_id','=',$post_id)->count();
    }

    /**
     * 校验岗位名称是否唯一
     *
     * @param $arrData
     * @return string
     */
    public function checkPostNameUnique($arrData)
    {
        $post_id = empty($arrData['post_id']) ? -1 : $arrData['post_id'];
        $sys_post = SysPost::where('post_name', '=', $arrData['post_name'])->first();
        if (!is_null($sys_post) && $sys_post['post_id'] != $post_id)
        {
            return Constants::POST_NAME_NOT_UNIQUE;
        }
        return Constants::POST_NAME_UNIQUE;
    }

    /**
     * 校验岗位编码是否唯一
     *
     * @param $arrData
     * @return string
     */
    public function checkPostCodeUnique($arrData)
    {
        $post_id = empty($arrData['post_id']) ? -1 : $arrData['post_id'];
        $sys_post = SysPost::where('post_code', '=', $arrData['post_code'])->first();
        if (!is_null($sys_post) && $sys_post['post_id'] != $post_id)
        {
            return Constants::POST_CODE_NOT_UNIQUE;
        }
        return Constants::POST_CODE_UNIQUE;
    }
}
