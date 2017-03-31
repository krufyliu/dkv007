<?php
/**
 * Created by PhpStorm.
 * User: liujun
 * Date: 2017/3/31
 * Time: 下午4:10
 */

namespace App\Traits;

Trait JsonResponse
{
    protected  function successJsonResponse($data=null, $statusCode=200)
    {
        $ret = [
            'err_code' => '0',
            'err_msg' => 'SUCCESS',
        ];
        if (!is_null($data)) {
            $ret['data'] = $data;
        }
        return response()->json($ret, $statusCode);
    }

    protected function errorJsonResponse($errCode, $statusCode=200, $errors=null)
    {
        return response()->json([
            'err_code' => $errCode,
            'err_msg' => $errors ?: ErrCode::errorMessage($errCode),
        ], $statusCode);
    }

    protected function paginateJsonResponse($data, $statusCode=200)
    {
        $result = [];
        $result['total'] = $data->total();
        $result['current'] = $data->currentPage();
        $result['per_page'] = $data->perPage();
        $result['has_more_page'] = $data->hasMorePages();
        $result['last_page'] = $data->lastPage();
        $result['list'] = $data->values();
        return $this->successJsonResponse($result, $statusCode);
    }
}