<?php

namespace App\Http\Controllers\Admin\System;

use App\Http\Controllers\Controller;
use App\Models\SysUser;
use App\Repositories\System\SysLoginInfoRepository;
use App\Utils\CommonUtil;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class SysLoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    public function __construct()
    {
        $this->middleware('guest:admin', ['except' => 'logout']);
    }

    /**
     * The user has been authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  mixed  $user
     * @return mixed
     */
    protected function authenticated(Request $request, $user)
    {
        $user_id = $user->user_id;

        //保存登录记录
        $loginInfo = array();
        $loginInfo['login_name'] = $user->login_name;
        $loginInfo['status']     = 1;
        $loginInfo['msg']        = "登录成功";
        $sysLoginInfoRepository  = new SysLoginInfoRepository();
        $sysLoginInfoRepository->insertLogininfor($loginInfo);

        //更新最后一次登录记录
        $arrData = array();
        $arrData['login_ip']   = CommonUtil::getIP();
        $arrData['login_date'] = CommonUtil::getDatetime();
        SysUser::where('user_id','=',$user_id)->update($arrData);

        return $this->showJsonResult(true, '登录成功', []);
    }

    protected function sendFailedLoginResponse(Request $request)
    {
        //保存登录记录
        $loginInfo = array();
        $loginInfo['login_name'] = $request['login_name'];
        $loginInfo['status']     = 0;
        $loginInfo['msg']        = "用户名或密码错误";
        $sysLoginInfoRepository  = new SysLoginInfoRepository();
        $sysLoginInfoRepository->insertLogininfor($loginInfo);

        return $this->showJsonResult(false, '用户名或密码错误', []);
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('admin/login');
    }

    protected function guard()
    {
        return Auth::guard('admin');
    }

    /**
     * Get the login username to be used by the controller.
     *
     * @return string
     */
    public function username()
    {
        return 'login_name';
    }

    public function logout(Request $request)
    {
        //保存登录记录
        $loginInfo = array();
        $loginInfo['login_name'] = Auth::user()->login_name ;
        $loginInfo['status']     = 1;
        $loginInfo['msg']        = "退出成功";
        $sysLoginInfoRepository  = new SysLoginInfoRepository();
        $sysLoginInfoRepository->insertLogininfor($loginInfo);

        $this->guard()->logout();
        $request->session()->invalidate();

        return redirect('/admin/login');
    }

}
