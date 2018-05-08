<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------

namespace apiExceptionHandle;

use think\exception\Handle;

class ApiExceptionHandle extends Handle
{
    //http状态码
    public $httpCode = 500;

    /**
     * 输出exception
     * @access public
     * @param  Exception $e 异常实例
     * @return json
     */
    public function render(\Exception $e)
    {
        if ($e instanceof ApiException) {
            $this->httpCode = $e->httpCode;
        } 
        return responseData(0, $e->getMessage(), [], $this->httpCode);
               
    }

}
