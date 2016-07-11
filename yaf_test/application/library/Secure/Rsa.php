<?php
/**
 * RSA加密,公钥加密 私钥解密
 * 产生对称密钥
 * $res = openssl_pkey_new();
 * openssl_pkey_export($res,$pri);
 * $d= openssl_pkey_get_details($res);
 * $pub = $d['key'];
 * var_dump($pri,$pub);
 *
 * <code>
 * <?php
 * $prikey_file = "/opt/rsa/keyfile/private.key";
 * $pubkey_file = "/opt/rsa/keyfile/public.key";
 * $rsa = new Secure_Rsa($pubkey_file, $prikey_file);
 * $content = '123456';
 * // 加密
 * $en_content = $rsa->encrypt($content);
 * // 解密
 * $deJson = $rsa->decrypt($en_content);
 * $rsa->sign($content);
 * ?>
 * </code>
 */
class Secure_Rsa {
    public static $outAlg = 'base64_encode'; //bin2hex方式无法用本类中的verify方法校验,专用于UUID校验(对方是nodejs)
    public static $signAlg = 'SHA1'; //默认是SHA1
    // 私钥
    private $_priKey = '';
    // 公钥
    private $_pubKey = '';

    /**
     * 架构函数
     */
    public function __construct($pubkey_file = '', $prikey_file = ''){
        $this->_priKey = $this->_readFile($prikey_file);
        $this->_pubKey = $this->_readFile($pubkey_file);
    }

    /**
     * 读取文件
     * @param string $file
     * @return string
     */
    private function _readFile($file){
        //读取文件
        if ( !is_file($file) ){
            $key = '';
        }else{
            $key = file_get_contents($file);
        }

        return $key;
    }

    /**
     * RSA签名
     * @param string $data
     * @param string $key_file
     * @return boolean|string
     */
    public function sign($data) {
        //读取私钥文件
        if ( empty($this->_priKey) ){
            return false;
        }
        $priKey = $this->_priKey;

        $res = openssl_get_privatekey($priKey);
        //调用openssl内置签名方法，生成签名$sign
        openssl_sign($data, $sign, $res, self::$signAlg);
        //释放资源
        openssl_free_key($res);
        //base64编码
        if (self::$outAlg == 'bin2hex') {
            $sign = bin2hex($sign);
        } else {
            $sign = base64_encode($sign);
        }
        return $sign;
    }

    /**
     * RSA验签
     * @param String $string 验证内容
     * @param String $sign 签名
     * @param String $key_file 密钥
     * @return boolean
     */
    public function verify($string, $sign) {
        if ( empty($this->_pubKey) ){
            return false;
        }
        $pubKey = $this->_pubKey;

        //转换为openssl格式密钥
        $res = openssl_get_publickey($pubKey);

        //调用openssl内置方法验签，返回bool值
        $sign = base64_decode($sign);
        $result = (bool) openssl_verify($string, $sign, $res, self::$signAlg);

        //释放资源
        openssl_free_key($res);

        //返回资源是否成功
        return $result;
    }

    /**
     * 加密
     * @param string $content 加密的内容
     * @param string $key_file 加密的密钥
     * @return string 返回加密后的内容
     */
    public function encrypt($content) {
        if ( empty($this->_pubKey) ){
            return false;
        }
        $pubKey = $this->_pubKey;
        $res = openssl_get_publickey($pubKey);

        $result = '';
        $s = 117;
        $len = ceil(strlen($content) / $s);

        for ($i = 0; $i < $len; $i++) {
            $data = substr($content, $i * $s, $s);
            openssl_public_encrypt($data, $decrypt, $res);
            $result .= $decrypt;
        }
        openssl_free_key($res);
        $result = base64_encode($result);
        //返回明文
        return $result;
    }

    /**
     * 解密
     * @param string $content 解密的内容
     * @param string $key_file 解密的密钥
     * @return 返回解密后的明文
     */
    public function decrypt($content) {
        if ( empty($this->_priKey) ){
            return false;
        }
        $priKey = $this->_priKey;
        $res = openssl_get_privatekey($priKey);

        $content = base64_decode($content);

        $result = '';
        for ($i = 0; $i < strlen($content) / 128; $i++) {
            $data = substr($content, $i * 128, 128);
            openssl_private_decrypt($data, $decrypt, $res);
            $result .= $decrypt;
        }
        openssl_free_key($res);
        return $result;
    }

}
