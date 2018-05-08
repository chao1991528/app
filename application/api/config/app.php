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

// +----------------------------------------------------------------------
// | 应用设置
// +----------------------------------------------------------------------

return [
    // 异常处理handle类 留空使用 \think\exception\Handle
    'exception_handle'       => '\apiExceptionHandle\ApiExceptionHandle',
    'aeskey' => 'ZYC_',
    'app_type' => ['ios', 'android'],
    'sign_expire_time' => 100000,
    'sign_cache_time' => 10,

    'user_token_out_day' => 7,
    'phone_sms_out_time' => 10 * 60 * 60

];
