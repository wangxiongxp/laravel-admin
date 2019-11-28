<?php

namespace App\Http\Controllers\Admin\System;

use App\Constants\Constants;
use App\Http\Controllers\Controller;
use App\Repositories\System\SysPostRepository;
use Illuminate\Http\Request;

class SysPostController extends Controller
{

    protected $prefix = 'admin/system/post';
    protected $sysPostRepository;

    public function __construct(SysPostRepository $sysPostRepository){
        $this->sysPostRepository = $sysPostRepository;
    }

    /**
     * 列表页面
     */
    public function index(){
        return view($this->prefix."/index");
    }

    /**
     * 列表查询
     */
    public function list(Request $request)
    {
        $result = $this->sysPostRepository->selectPostList($request->all());
        return $this->showPageResult($result);
    }

    /**
     * 新增页面
     */
    public function add()
    {
        return view($this->prefix."/add");
    }

    /**
     * 保存操作
     */
    public function save(Request $request){
        if (Constants::POST_NAME_NOT_UNIQUE == $this->sysPostRepository->checkPostNameUnique($request->all())){
            return $this->showJsonResult(false, '新增岗位'.$request['post_name'].'失败，岗位名称已存在', []);
        }else if (Constants::POST_CODE_NOT_UNIQUE == $this->sysPostRepository->checkPostCodeUnique($request->all())){
            return $this->showJsonResult(false, '新增岗位'.$request['post_code'].'失败，岗位编码已存在', []);
        }
        $this->sysPostRepository->insertPost($request->all());
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 编辑页面
     */
    public function edit($post_id)
    {
        $data = array();
        $post = $this->sysPostRepository->selectPostById($post_id);
        $data['post'] = $post ;
        return view($this->prefix."/edit",$data);
    }

    /**
     * 更新操作
     */
    public function update(Request $request){
        if (Constants::POST_NAME_NOT_UNIQUE == $this->sysPostRepository->checkPostNameUnique($request->all())){
            return $this->showJsonResult(false, '修改岗位'.$request['post_name'].'失败，岗位名称已存在', []);
        }
        else if (Constants::POST_CODE_NOT_UNIQUE == $this->sysPostRepository->checkPostCodeUnique($request->all())){
            return $this->showJsonResult(false, '修改岗位'.$request['post_code'].'失败，岗位编码已存在', []);
        }
        $this->sysPostRepository->updatePost($request->all());
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 删除操作
     */
    public function remove(Request $request){
        $this->sysPostRepository->deletePostByIds($request['ids']);
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 校验岗位名称
     */
    public function checkPostNameUnique(Request $request)
    {
        return $this->sysPostRepository->checkPostNameUnique($request);
    }

    /**
     * 校验岗位编码
     */
    public function checkPostCodeUnique(Request $request)
    {
        return $this->sysPostRepository->checkPostCodeUnique($request);
    }
}
