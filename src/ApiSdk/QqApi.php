<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 15-5-15
 * Time: 上午11:15
 * To change this template use File | Settings | File Templates.
 */

namespace rob\ApiSdk;
use rob\ApiSdkHelper\Singleton;

class QqApi{
    private $_client_code;
    private $_client_secret;
    private $_interface;
    private $_interface_group = 'qqapi/';

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
     * 获取微信 Access Token
     * @return array
     */
    public function getAccessToken(){
        $this->_interface = 'get_access_token';
        $post_data = array();
        return $this->postRequest($post_data);
    }

    /**
     * 获取跳板地址接口
     * @param $redirect_uri string 回跳网址
     * @param $oauth_type string OAUTH类型 oauth_snsapi_base 静默 oauth_snsapi_openid 仅获取openID oauth_snsapi_userinfo 授权
     * @return array
     */
    public function setDrawBoardData($redirect_uri, $oauth_type){
        $this->_interface = 'set_drawboard_data';
        $post_data = array(
            'redirect_uri'  => $redirect_uri,
            'oauth_type'    => $oauth_type,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 获取用户信息
     * @param $key
     * @return array
     */
    public function getUserData($key){
        $this->_interface = 'get_user_data';
        $post_data = array(
            'key'           => $key,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 异步发送微信模板消息接口
     * @param $tpl_data
     * @return array
     */
    public function asyncSendTpl($tpl_data){
        $this->_interface = 'async_send_tpl';
        $post_data = array(
            'tpl_data'  => $tpl_data,
        );
        return $this->postRequest($post_data);
    }
}