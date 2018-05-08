<?php
namespace app\api\controller\v1;
use app\api\controller\Common;
use lib\Aes;
use apiExceptionHandle\ApiException;

/*
*  客户端登陆权限基础控制器
*/

class AuthBase extends Common
{
    public $user;
    public function initialize() {
        parent::initialize();
        if(!$this->isLogin()){
            throw new ApiException("no login !", 401);
            
        }
    }
    public function isLogin()
    {
        if(!empty($this->header['access-user-token'])){
            $accessUserToken = Aes::decrypt($this->header['access-user-token'], config('app.aeskey'));
            if($accessUserToken){
                list($token, $id) = explode('|', $accessUserToken);
                $user = model('user')::get(['token' => $token, 'status' => 1]);
                if($user && (time() <= $user->time_out)){
                    $this->user = $user;
                    return true;
                } 
            }                
        }
        return false;
    }
}
