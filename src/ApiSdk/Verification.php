<?php
/**
 * Created by VeryStar.
 * User: Rob
 * Date: 2016/7/11
 * Time: 17:44
 */

namespace rob\ApiSdk;
use rob\ApiSdkHelper\Singleton;

class Verification{
    private $_client_code;
    private $_client_secret;
    private $_interface;
    private $_interface_group = 'verification/';

    /**
     * 构造函数 设置 client_code 和 client_secret
     * @param $client_code
     * @param $client_secret
     */
    public function __construct($client_code, $client_secret){
        $this->_client_code     = $client_code;
        $this->_client_secret   = $client_secret;
    }

    /**
     * 向费芮接口发起POST请求私有方法
     * @param $post_data
     * @return array
     */
    private function postRequest($post_data){
        $interface_uri  = $this->_interface_group . $this->_interface;
        $_very_api_curl = Singleton::getClassInstance('rob\\ApiSdkHelper\\VeryApiCurl');
        $_very_api_curl->setClientCode($this->_client_code);
        $_very_api_curl->setClientSecret($this->_client_secret);
        $_very_api_curl->setIterfaceUri($interface_uri);
        return $_very_api_curl->postVeryApiRequest($post_data);
    }

    /**
     * 获取配置
     * @param $id
     * @return array
     */
    public function getSuperviseInfo($id){
        $this->_interface = 'get_supervise_info';
        $post_data = array(
            'id'    => $id,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 获取OPENID白名单
     * @param $id
     * @return array
     */
    public function getSuperviseOpenId($id){
        $this->_interface = 'get_supervise_open_id';
        $post_data = array(
            'id'    => $id,
        );
        return $this->postRequest($post_data);
    }
}