<?php
namespace lib;

/**
 * aes 加密 解密类库
 * @author zyc
 * Class MyEncrypt
 * @package lib
 */
class MyEncrypt {

    /**
     * 生成sign加密串(多种写法，下面只是其中一种)
     * @param [] $data 加密的数据
     * @return string
     */
    public static function setSign($data = []) {
        //1 字段排序
        ksort($data);
        //2 用&成拼接字符串
        $str = http_build_query($data);
        //3 通过aes加密
        return Aes::encrypt($str, config('app.aeskey'));

    }

    /**
     * 解密
     * @param [] $header 需要解密的header
     * @return bool
     */
    public static function checkSign($header) {
        $str = Aes::decrypt($header['sign'], config('app.aeskey'));
        if(!$str){
            echo 1;
            return false;
        }
        parse_str($str, $data);
        if(!is_array($data) || ($data['did'] != $header['did']) || ($data['app-type'] != $header['app-type']) || ($data['time'] != $header['time']) ){
            return false;
        }
        //时间验证
        if( (time()-$data['time']) > config('app.sign_expire_time')){
            return false;
        }
        //唯一性验证
        if(cache($header['sign'])){
            return false;
        }

        return true;
    }

    /*
    * 生成登录token
    */
    public static function setLoginToken($phone = ''){
        return md5(uniqid(microtime(true), true)); 
    }

}