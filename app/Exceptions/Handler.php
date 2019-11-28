<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class Handler extends ExceptionHandler
{
    /**
     * A list of the exception types that are not reported.
     *
     * @var array
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed for validation exceptions.
     *
     * @var array
     */
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    /**
     * Report or log an exception.
     *
     * @param  \Exception  $exception
     * @return void
     */
    public function report(Exception $exception)
    {
        parent::report($exception);
    }

    /**
     * Render an exception into an HTTP response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Exception  $exception
     * @return \Illuminate\Http\Response
     */
    public function render($request, Exception $exception)
    {
//        $guards = $exception->guards();
//        foreach ($guards as $guard) {
//            if($guard != 'admin') {
//                return parent::render($request, $exception);
//            }
//        }

        if ($exception instanceof NotFoundHttpException) {
            if($request->ajax() || $request->wantsJson()){
                $result = array();
                $result['code']	= 404 ;
                $result['msg']  = "请求路径未找到" ;
                $result['data']	= [] ;
                return response()->json($result, Response::HTTP_NOT_FOUND);
            }else{
                return response()->view('admin.errors.404', [], Response::HTTP_NOT_FOUND);
            }
        }else if($exception instanceof AuthorizationException){
            if($request->ajax() || $request->wantsJson()){
                $result = array();
                $result['code']	= 403 ;
                $result['msg']  = "您没有访问权限" ;
                $result['data']	= [] ;
                return response()->json($result, Response::HTTP_FORBIDDEN);
            }else{
                return response()->view('admin.errors.403', [], Response::HTTP_FORBIDDEN);
            }
        }else if($exception instanceof MethodNotAllowedHttpException){
            if($request->ajax() || $request->wantsJson()){
                $result = array();
                $result['code']	= 405 ;
                $result['msg']  = "请求方式不正确" ;
                $result['data']	= [] ;
                return response()->json($result, Response::HTTP_METHOD_NOT_ALLOWED);
            }else{
                return response()->view('admin.errors.500', [], Response::HTTP_METHOD_NOT_ALLOWED);
            }
        }else if($exception instanceof BusinessException) {
            $result = [
                "code" => 500,
                "msg"    => $exception->getMessage(),
                "data"   => [],
            ];
            return response()->json($result,Response::HTTP_OK);
        }
        return parent::render($request, $exception);
    }

    /**
     * Convert an authentication exception into a response.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Illuminate\Auth\AuthenticationException  $exception
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function unauthenticated($request, AuthenticationException $exception)
    {
        if ($request->expectsJson()) {
            return response()->json(['message' => $exception->getMessage()], 401);
        }
        $guards = $exception->guards();
        if(!empty($guards)) {
            foreach ($guards as $guard) {
                if($guard == 'admin') {
                    return redirect()->guest('/admin/login');
                }
                if($guard == 'web') {
                    return redirect()->guest('/login');
                }
                if($guard == 'api') {
                    return response()->json(['message' => $exception->getMessage()], 401);
                }
            }
        }
    }

}
