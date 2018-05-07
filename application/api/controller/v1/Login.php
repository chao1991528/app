<?php
namespace app\api\controller\v1;
use app\api\controller\Common;
use lib\Isms;

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

            if(Isms::getInstance()->checkSms($data['phone'], $data['code'])){
                echo 'yan zheng ok';
            }else{
                echo 'fail';
            }

            die;
            if($news){
                return json(['code' => 200, 'msg' => '新增成功', 'jump_url' => url('news/index')]);
            }else{
                return json(['code' => 0, 'msg' => 'failed']);    
            }
            return ['code' => 200, 'msg' => 'ok'];
        }
        return responseData(0, '非法访问', '', 403);
    }
}
