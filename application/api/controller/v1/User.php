<?php

namespace app\api\controller\v1;

use lib\Aes;

class User extends AuthBase {

    /**
     * 获取用户信息
     * 用户的信息需要加密传输
     */
    public function read() {
        return responseData(1, 'ok', Aes::encrypt($this->user, config('app.aeskey')));
    }

    /*
     * 修改数据
     */

    public function update() {
        $params = $this->request->param();
        $result = $this->validate($params, 'app\common\validate\User.update');
        if (true !== $result) {
            // 验证失败 输出错误信息
            return responseData(0, $result, '', 403);
        }
        try {
            if(!empty($params['password'])){
                $params['password'] = Aes::encrypt($params['password'], config('app.aeskey'));
            }
            return model('user')->save($params, ['id' => $this->user->id]) ? responseData(1, 'ok') : responseData(0, '更新失败', [], 401);
        } catch (\Exception $e) {
            return responseData(0, $e->getMessage(), [], 500);
        }
    }

}
