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
            if(empty($data['login_mode']) || !in_array($data['login_mode'], [1,2])){
                 return responseData(0, '登陆方式有误', [], 403);
            }
            $validate = ($data['login_mode'] == 1) ? 'app\common\validate\User.login_with_sms' : 'app\common\validate\User.login_with_password';
            $result = $this->validate($data , $validate);

            if(true !== $result){
                // 验证失败 输出错误信息
                return responseData(0, $result, '', 403);
            }

            //code客户端最好加密，后台收到后再解密
            if(($data['login_mode'] == 1)){
                if(!Isms::getInstance()->checkSms($data['phone'], $data['code'])){
                    return responseData(0, '手机验证码错误', '', 403);
                }
            }

            //登陆           
            $user = model('user')::get(['phone' => $data['phone'], 'status' => 1]);
            if($user){
                if(($data['login_mode'] == 2)){
                    if(Aes::decrypt($data['password'], config('app.aeskey'))){
                        return responseData(0, '密码错误', '', 403);
                    }
                }
                $token = MyEncrypt::setLoginToken($data['phone']);
                $user->time_out = strtotime('+'.config('app.user_token_out_day').' days');
                $user->token = $token;
                $res = $user->save();
                if($res){
                    $returnData = [
                        'token' => Aes::encrypt($token.'|'.$user->id, config('app.aeskey'))
                    ];
                    return responseData(1, '登陆成功', $returnData, 200);    
                }
                return responseData(0, '登陆信息更新失败', [], 403);                     
            }          
            return responseData(0, '用户不存在', [], 403);
        }
        return responseData(0, '非法访问', '', 401);
    }
}
