<?php
namespace app\api\controller\v1;
use app\api\controller\Common;
use lib\Isms;
use lib\Aes;
use lib\MyEncrypt;

class Login extends Common
{
    public function doLogin()
    {
        if(request()->isPost()){
            $data = $this->request->post();

            $result = $this->validate($data,'app\common\validate\User.login_with_sms');

            if(true !== $result){
                // 验证失败 输出错误信息
                return responseData(0, $result, '', 403);
            }

            //code客户端最好加密，后台收到后再解密
            if(!Isms::getInstance()->checkSms($data['phone'], $data['code'])){
                return responseData(0, '手机验证码错误', '', 404);
            }

            //第一次登陆 是注册
            $token = MyEncrypt::setLoginToken($data['phone']);
            $user_data = [
                'token' => $token,
                'time_out' => strtotime('+'.config('app.user_token_out_day').' days'),
                'username' => substr_replace($data['phone'],'****',3,4),
                'status' => 1,
                'phone' => $data['phone']
            ];

            $newUser = model('user')::create($user_data);
            if($newUser){
                $returnData = [
                    'token' => Aes::encrypt($token.'|'.$newUser->id, config('app.aeskey'))
                ];
                return responseData(1, '登陆成功', $returnData, 200);
            }
            return responseData(0, '登陆失败', $returnData, 403);
        }
        return responseData(0, '非法访问', '', 403);
    }
}
