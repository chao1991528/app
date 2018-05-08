<?php
namespace lib;

use think\Log;
/**
 * 发送短信
 * @author zyc
 * Class Isms
 * @package lib
 */
class Isms{
	private static $_instance = null;

	/**
	 * 私有构造方法
	 */
	private function __contruct()
	{
		
	}
	/**
	 * 获取单例
	 */
	public static function getInstance()
	{
		if(is_null(self::$_instance)){
			self::$_instance = new self();	
		}
		return self::$_instance;
	}

	/*发送验证码*/
	public function sendSms($phone = ''){
		try {
			$code = rand(1000, 9999);
			cache($phone, $code, 60*5);
			return true;
			
		} catch (\Exception $e) {
			Log::write('send sms error : ' . $e->getMessage());
		}

	}

	/*验证手机验证码*/
	public function checkSms($phone, $code){
		return (cache($phone) == $code) ? true : false;
	}

}