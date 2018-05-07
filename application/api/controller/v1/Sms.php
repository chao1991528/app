<?php
namespace app\api\controller\v1;
use app\api\controller\Common;
use lib\Isms;
use think\Validate;

class Sms extends Common
{
    public function send()
    {
        if(request()->isPost()){
            $data = $this->request->post();

            $validate = Validate::make([
                'phone|手机号'  => 'require|mobile',
            ]);
            $result = $validate->check($data);
            if (true !== $result) {
                return responseData(0, $validate->getError(), '', 403);
            }
            if(Isms::getInstance()->sendSms($data['phone'])){
                return responseData(1, '短信发送ok', '', 200);
            }
        }
        return responseData(0, '非法访问', '', 403);
    }
}
