<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    function showPageResult($data){
        $result = array();
        $result['code']	= 0 ;
        $result['msg']  = '' ;
        $result['total'] = $data['total'] ;
        $result['rows']	 = $data['rows'] ;
        return response()->json($result, Response::HTTP_OK);
    }

    function showListResult($data){
        return response()->json($data, Response::HTTP_OK);
    }

    function showResult($data){
        return response()->json($data, Response::HTTP_OK);
    }

    function showJsonResult($code, $msg , $data = array()){
        $result = array();
        $result['code']	= $code ? 0 : 500 ;
        $result['msg']  = $msg ;
        $result['data']	= $data ;
        return response()->json($result, Response::HTTP_OK) ;
    }
}
