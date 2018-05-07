<?php
namespace app\api\controller\v1;
use app\api\controller\Common;
use apiExceptionHandle\ApiException;
use lib\Isms;
use lib\MyEncrypt;
class Index extends Common
{
    public function index()
    {
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

    /**客户端初始化
    * 1.版本检测
    *
    */
    public function init(){
        $version = model('version')->getLastestVersionByAppType($this->header['app-type']);
        if(!$version){
            throw new ApiException('版本错误', 400);            
        }
        if($version->version > $this->header['version']){
            $version->is_update = $version->is_force ? 2 : 1;// 1需要更新 2强制更新
        }else{
            $version->is_update = 0;//0不更新
        }
        return responseData(1, 'ok', $version, 200);
    }

    public function testSms(){
        echo MyEncrypt::setLoginToken('123');
        //echo Isms::getInstance()->sendSms('12345');
    }

}
