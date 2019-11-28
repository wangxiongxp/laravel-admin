<?php

namespace App\Http\Controllers\Admin\Demo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DemoTableController extends Controller
{
    protected $prefix = 'admin/demo/table';

    protected $users = array();

    public function __construct()
    {
        $this->users[] = array('userId'=>1,'userCode'=>'1000001','userName'=>'测试1','userSex'=>'1','userPhone'=>'15888888899','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>2,'userCode'=>'1000002','userName'=>'测试2','userSex'=>'0','userPhone'=>'15888888388','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>3,'userCode'=>'1000003','userName'=>'测试3','userSex'=>'1','userPhone'=>'15888884888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>4,'userCode'=>'1000004','userName'=>'测试4','userSex'=>'1','userPhone'=>'15888885888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>5,'userCode'=>'1000005','userName'=>'测试5','userSex'=>'0','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>6,'userCode'=>'1000006','userName'=>'测试6','userSex'=>'1','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>7,'userCode'=>'1000007','userName'=>'测试7','userSex'=>'0','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>8,'userCode'=>'1000008','userName'=>'测试8','userSex'=>'1','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>9,'userCode'=>'1000009','userName'=>'测试9','userSex'=>'0','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>10,'userCode'=>'1000010','userName'=>'测试10','userSex'=>'0','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>11,'userCode'=>'1000011','userName'=>'测试11','userSex'=>'1','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>12,'userCode'=>'1000012','userName'=>'测试12','userSex'=>'0','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>13,'userCode'=>'1000013','userName'=>'测试13','userSex'=>'1','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>14,'userCode'=>'1000014','userName'=>'测试14','userSex'=>'0','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>15,'userCode'=>'1000015','userName'=>'测试15','userSex'=>'1','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>16,'userCode'=>'1000016','userName'=>'测试16','userSex'=>'0','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>17,'userCode'=>'1000017','userName'=>'测试17','userSex'=>'1','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>18,'userCode'=>'1000018','userName'=>'测试18','userSex'=>'1','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>19,'userCode'=>'1000019','userName'=>'测试19','userSex'=>'0','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>20,'userCode'=>'1000020','userName'=>'测试20','userSex'=>'1','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>21,'userCode'=>'1000021','userName'=>'测试21','userSex'=>'0','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>22,'userCode'=>'1000022','userName'=>'测试22','userSex'=>'1','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>23,'userCode'=>'1000023','userName'=>'测试23','userSex'=>'1','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>24,'userCode'=>'1000024','userName'=>'测试24','userSex'=>'1','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>25,'userCode'=>'1000025','userName'=>'测试25','userSex'=>'0','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>26,'userCode'=>'1000026','userName'=>'测试26','userSex'=>'1','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
    }

    /**
     * 搜索相关
     */
    public function search()
    {
        return view($this->prefix."/search");
    }

    /**
     * 数据汇总
     */
    public function footer()
    {
        return view($this->prefix."/footer");
    }

    /**
     * 组合表头
     */
    public function groupHeader()
    {
        return view($this->prefix."/groupHeader");
    }

    /**
     * 表格导出
     */
    public function export()
    {
        return view($this->prefix."/export");
    }

    /**
     * 翻页记住选择
     */
    public function remember()
    {
        return view($this->prefix."/remember");
    }

    /**
     * 跳转至指定页
     */
    public function pageGo()
    {
        return view($this->prefix."/pageGo");
    }

    /**
     * 自定义查询参数
     */
    public function params()
    {
        return view($this->prefix."/params");
    }

    /**
     * 多表格
     */
    public function multi()
    {
        return view($this->prefix."/multi");
    }

    /**
     * 点击按钮加载表格
     */
    public function button()
    {
        return view($this->prefix."/button");
    }

    /**
     * 表格冻结列
     */
    public function fixedColumns()
    {
        return view($this->prefix."/fixedColumns");
    }

    /**
     * 自定义触发事件
     */
    public function event()
    {
        return view($this->prefix."/event");
    }

    /**
     * 表格细节视图
     */
    public function detail()
    {
        return view($this->prefix."/detail");
    }

    /**
     * 表格父子视图
     */
    public function child()
    {
        return view($this->prefix."/child");
    }

    /**
     * 表格图片预览
     */
    public function image()
    {
        return view($this->prefix."/image");
    }

    /**
     * 动态增删改查
     */
    public function curd()
    {
        return view($this->prefix."/curd");
    }

    /**
     * 表格拖拽操作
     */
    public function reorder()
    {
        return view($this->prefix."/reorder");
    }

    /**
     * 表格行内编辑操作
     */
    public function editable()
    {
        return view($this->prefix."/editable");
    }

    /**
     * 表格其他操作
     */
    public function other()
    {
        return view($this->prefix."/other");
    }

    /**
     * 查询数据
     */
    public function list(Request $request)
    {
        $pageNum = $request['pageNum'];
        $pageSize = $request['pageSize'];
        $userName = $request['userName'];
        $resultData = array();
        $userList = $this->users;
        // 查询条件过滤
        if (!empty($request['userName']))
        {
            $userList = array();
            foreach ($this->users as $user)
            {
                if ($user['userName'] == $userName)
                {
                    $userList[] = $user;
                }
            }
        }
        if (empty($pageNum) || empty($pageSize))
        {
            $resultData['rows'] = $userList;
            $resultData['total'] = count($userList);
            return $resultData;
        }
        $pageSize = $pageNum * 10;
        $pageNum = ($pageNum - 1) * 10;
        if ($pageSize > count($userList))
        {
            $pageSize = count($userList);
        }
        $resultData['rows'] = array_slice($userList,$pageNum, $pageSize);
        $resultData['total'] = count($userList);
        $resultData['code'] = 0;
        $resultData['msg'] = 0;
        return $resultData;
    }

}
