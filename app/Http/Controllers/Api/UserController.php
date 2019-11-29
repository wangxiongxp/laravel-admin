<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class UserController extends Controller
{

    public function __construct(){
    }

    /**
     * 用户信息
     */
    public function profile(Request $request)
    {
        $request->user();
        return $this->showJsonResult(true,'查询成功',$request->user());
    }

}
