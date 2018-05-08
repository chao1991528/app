<?php
namespace lib;
/**
 * Aes加密解密
 * @author zyc
 * Class Aes
 * @package lib
 */
class Aes{
		
	/**
	 * [encrypt aes加密]
	 * @param    [type]                   $input [要加密的数据]
	 * @param    [type]                   $key   [加密key]
	 * @return   [type]                          [加密后的数据]
	 */
	public static function encrypt($input, $key)
	{
		$data = openssl_encrypt($input, 'AES-128-ECB', $key, OPENSSL_RAW_DATA);
		$data = base64_encode($data);
		return $data;
	}
	/**
	 * [decrypt aes解密]
	 * @param    [type]                   $sStr [要解密的数据]
	 * @param    [type]                   $sKey [加密key]
	 * @return   [type]                         [解密后的数据]
	 */
	public static function decrypt($sStr, $sKey)
	{
		$decrypted = openssl_decrypt(base64_decode($sStr), 'AES-128-ECB', $sKey, OPENSSL_RAW_DATA);
		return $decrypted;
	}
}