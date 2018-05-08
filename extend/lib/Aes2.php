<?php
namespace lib;

/**
 * aes 加密 解密类库
 * @by singwa
 * Class Aes
 * @package app\common\lib
 */
class Aes {

    private $key = null;
    //密码学方式
    private $method = 'AES-128-CBC';

    /**
     *
     * @param $key 		密钥
     * @return String
     */
    public function __construct() {
        // 需要小伙伴在配置文件app.php中定义aeskey
        $this->key = config('app.aeskey');
    }

    /**
     * 加密
     * @param String input 加密的字符串
     * @param String key   解密的key
     * @return HexString
     */
    public function encrypt($input = '') {
        $cipher=$this->method;
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = openssl_random_pseudo_bytes($ivlen);
        $ciphertext_raw = openssl_encrypt($input, $cipher, $this->key, OPENSSL_RAW_DATA, $iv);
        $hmac = hash_hmac('sha256', $ciphertext_raw, $this->key, true);
        $ciphertext = base64_encode( $iv.$hmac.$ciphertext_raw );
        return $ciphertext;
    }
    /**
     * 填充方式 pkcs5
     * @param String text 		 原始字符串
     * @param String blocksize   加密长度
     * @return String
     */
    private function pkcs5_pad($text, $blocksize) {
        $pad = $blocksize - (strlen($text) % $blocksize);
        return $text . str_repeat(chr($pad), $pad);
    }

    /**
     * 解密
     * @param String input 解密的字符串
     * @param String key   解密的key
     * @return String
     */
    public function decrypt($sStr) {
        $key = $this->key;
        $cipher=$this->method;
        $c = base64_decode($sStr);
        $ivlen = openssl_cipher_iv_length($cipher);
        $iv = substr($c, 0, $ivlen);
        $hmac = substr($c, $ivlen, $sha2len=32);
        $ciphertext_raw = substr($c, $ivlen+$sha2len);
        $original_str = openssl_decrypt($ciphertext_raw, $cipher, $key, $options=OPENSSL_RAW_DATA, $iv);

        return $original_str;
    }

}