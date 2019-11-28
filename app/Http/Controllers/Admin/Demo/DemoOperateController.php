<?php

namespace App\Http\Controllers\Admin\Demo;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DemoOperateController extends Controller
{
    protected $prefix = 'admin/demo/operate';

    protected $users = array();

    public function __construct()
    {
        $this->users[] = array('userId'=>1,'userCode'=>'1000001','userName'=>'测试1','userSex'=>'1','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>2,'userCode'=>'1000002','userName'=>'测试2','userSex'=>'0','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>3,'userCode'=>'1000003','userName'=>'测试3','userSex'=>'1','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
        $this->users[] = array('userId'=>4,'userCode'=>'1000004','userName'=>'测试4','userSex'=>'1','userPhone'=>'15888888888','userEmail'=>'ry@qq.com','userBalance'=>150.0,'status'=>'0');
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
     * 表格
     */
    public function table()
    {
        return view($this->prefix."/table");
    }

    /**
     * 其他
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
        $resultData = array();
        $userList = $this->users;

        // 查询条件过滤
        if (!empty($request['searchValue']))
        {
            $userList = array();
            foreach ($this->users as $user)
            {
                if ($user['userName'] == $request['searchValue'])
                {
                    $userList[] = $user;
                }
            }
        }else if (!empty($request['userName']))
        {
            $userList = array();
            foreach ($this->users as $user)
            {
                if ($user['userName'] == $request['userName'])
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

    /**
     * 新增用户
     */
    public function add()
    {
        return view($this->prefix."/add");
    }

    /**
     * 新增保存用户
     */
    public function addSave(Request $request)
    {
        // 调用保存逻辑
        $user = array();
        return $this->showJsonResult(true, '操作成功', $user);
    }

    /**
     * 修改用户
     */
    public function edit($userId)
    {
        $return = array();
        foreach ($this->users as $key=>$user)
        {
            if($user['userId']==$userId){
                $return['user'] = $user;
            }
        }
        return view($this->prefix."/edit",$return);
    }

    /**
     * 修改保存用户
     */
    public function editSave(Request $request)
    {
        // 调用更新逻辑
        $user = array();
        return $this->showJsonResult(true, '操作成功', $user);
    }

    /**
     * 导出
     */
//    @PostMapping("/export")
//    @ResponseBody
//    public AjaxResult export(UserOperateModel user)
//    {
//        List<UserOperateModel> list = new ArrayList<UserOperateModel>(users.values());
//        ExcelUtil<UserOperateModel> util = new ExcelUtil<UserOperateModel>(UserOperateModel.class);
//        return util.exportExcel(list, "用户数据");
//    }

    /**
     * 下载模板
     */
//    @GetMapping("/importTemplate")
//    @ResponseBody
//    public AjaxResult importTemplate()
//    {
//    ExcelUtil<UserOperateModel> util = new ExcelUtil<UserOperateModel>(UserOperateModel.class);
//        return util.importTemplateExcel("用户数据");
//    }

    /**
     * 导入数据
     */
//    @PostMapping("/importData")
//    public AjaxResult importData(MultipartFile file, boolean updateSupport) throws Exception
//    {
//        ExcelUtil<UserOperateModel> util = new ExcelUtil<UserOperateModel>(UserOperateModel.class);
//        List<UserOperateModel> userList = util.importExcel(file.getInputStream());
//        String message = importUser(userList, updateSupport);
//        return AjaxResult.success(message);
//    }

    /**
     * 删除用户
     * java中静态变量是一次JVM中有效，PHP中是一次请求内有效，所以删除后在list获取数据还是完整数据
     */
    public function remove(Request $request)
    {
        $ids = $request['ids'];
        $id_arr = explode(",",$ids);
        foreach ($this->users as $key=>$user)
        {
            if(in_array($user['userId'],$id_arr) ){
                array_slice($this->users,$key,1);
            }
        }
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 查看详细
     */
    public function detail($userId)
    {
        $return = array();
        foreach ($this->users as $key=>$user)
        {
            if($user['userId']==$userId){
                $return['user'] = $user;
            }
        }
        return view($this->prefix."/detail",$return);
    }

    /**
     * 清空
     */
    public function clean()
    {
        return $this->showJsonResult(true, '操作成功', []);
    }

    /**
     * 导入用户数据
     *
     * @param userList 用户数据列表
     * @param isUpdateSupport 是否更新支持，如果已存在，则进行更新数据
     * @return 结果
     */
//    public String importUser(List<UserOperateModel> userList, Boolean isUpdateSupport)
//    {
//        if (StringUtils.isNull(userList) || userList.size() == 0)
//        {
//            throw new BusinessException("导入用户数据不能为空！");
//        }
//        int successNum = 0;
//        int failureNum = 0;
//        StringBuilder successMsg = new StringBuilder();
//        StringBuilder failureMsg = new StringBuilder();
//        for (UserOperateModel user : userList)
//        {
//            try
//            {
//                // 验证是否存在这个用户
//                boolean userFlag = false;
//                for (Map.Entry<Integer, UserOperateModel> entry : users.entrySet())
//                {
//                    if (entry.getValue().getUserName().equals(user.getUserName()))
//                    {
//                        userFlag = true;
//                        break;
//                    }
//                }
//                if (!userFlag)
//                {
//                    Integer userId = users.size() + 1;
//                    user.setUserId(userId);
//                    users.put(userId, user);
//                    successNum++;
//                    successMsg.append("<br/>" + successNum + "、用户 " + user.getUserName() + " 导入成功");
//                }
//                else if (isUpdateSupport)
//                {
//                    users.put(user.getUserId(), user);
//                    successNum++;
//                    successMsg.append("<br/>" + successNum + "、用户 " + user.getUserName() + " 更新成功");
//                }
//                else
//                {
//                    failureNum++;
//                    failureMsg.append("<br/>" + failureNum + "、用户 " + user.getUserName() + " 已存在");
//                }
//            }
//            catch (Exception e)
//            {
//                failureNum++;
//                String msg = "<br/>" + failureNum + "、账号 " + user.getUserName() + " 导入失败：";
//                failureMsg.append(msg + e.getMessage());
//            }
//        }
//        if (failureNum > 0)
//        {
//            failureMsg.insert(0, "很抱歉，导入失败！共 " + failureNum + " 条数据格式不正确，错误如下：");
//            throw new BusinessException(failureMsg.toString());
//        }
//        else
//        {
//            successMsg.insert(0, "恭喜您，数据已全部导入成功！共 " + successNum + " 条，数据如下：");
//        }
//        return successMsg.toString();
//    }

}
