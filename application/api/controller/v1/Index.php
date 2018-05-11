<?php

namespace app\api\controller\v1;

use app\api\controller\Common;
use apiExceptionHandle\ApiException;
use lib\MyEncrypt;
use lib\Aes;
use lib\Isms;

class Index extends Common {

    public function index() {
        //头部新闻
        $headers = model('news')->getHeadNews();

        //中间新闻
        $positions = model('news')->getPositionNews();

        $data = [
            'headers' => $headers,
            'positions' => $positions
        ];

        return responseData(1, 'ok', $data, 200);
    }

    /*     * 客户端初始化
     * 1.版本检测
     *
     */

    public function init() {
        $version = model('version')->getLastestVersionByAppType($this->header['app-type']);
        if (!$version) {
            throw new ApiException('版本错误', 400);
        }
        if ($version->version > $this->header['version']) {
            $version->is_update = $version->is_force ? 2 : 1; // 1需要更新 2强制更新
        } else {
            $version->is_update = 0; //0不更新
        }
        return responseData(1, 'ok', $version, 200);
    }

    public function register() {
        if (request()->isPost()) {
            $data = $this->request->post();

            $result = $this->validate($data, 'app\common\validate\User.register');

            if (true !== $result) {
                // 验证失败 输出错误信息
                return responseData(0, $result, '', 422);
            }

            //code客户端最好加密，后台收到后再解密
            if (!Isms::getInstance()->checkSms($data['phone'], $data['code'])) {
                return responseData(0, '手机验证码错误', '', 422);
            }

            //注册           
            $user = model('user')::get(['phone' => $data['phone']]);
            if ($user) {
                return responseData(0, '手机号已经使用', '', 403);
            }
            $token = MyEncrypt::setLoginToken($data['phone']);

            $user_data = [
                'token' => $token,
                'time_out' => strtotime('+' . config('app.user_token_out_day') . ' days'),
                'username' => substr_replace($data['phone'], '****', 3, 4),
                'status' => 1,
                'phone' => $data['phone']
            ];

            $newUser = model('user')::create($user_data);
            if ($newUser) {
                $returnData = [
                    'token' => Aes::encrypt($token . '|' . $newUser->id, config('app.aeskey'))
                ];
                return responseData(1, '注册成功', $returnData, 200);
            }
            return responseData(0, '注册失败', $returnData, 403);
        }
    }

}
