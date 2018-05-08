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

use think\Exception;

class ApiException extends Exception
{
    //http状态码
    public $httpCode = 500;
    //提示信息
    public $message = '';
    //业务状态码
    public $code = 0;

    /**
     * 输出exception
     * @access public
     * @param  Exception $e 异常实例
     * @return json
     */
    public function __construct($message = '', $httpCode = 0, $code = 0)
    {
        $this->httpCode = $httpCode;
        $this->code = $code;
        $this->message = $message;
    }

}
