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

class WechatApi{
    private $_client_code;
    private $_client_secret;
    private $_interface;
    private $_interface_group = 'weixinapi/';

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
     * 获取微信 AppId
     * @return array
     */
    public function getAppId(){
        $this->_interface = 'get_appid';
        $post_data = array();
        return $this->postRequest($post_data);
    }

    /**
     * 获取微信 Client Info
     * @return array
     */
    public function getClientInfos(){
        $this->_interface = 'get_client_infos';
        $post_data = array();
        return $this->postRequest($post_data);
    }

    /**
     * 获取微信 JS API TICKET
     * @return array
     */
    public function getJsApiTicket(){
        $this->_interface = 'get_jsapi_ticket';
        $post_data = array();
        return $this->postRequest($post_data);
    }

    /**
     * 获取微信 API TICKET
     * @return array
     */
    public function getApiTicket(){
        $this->_interface = 'get_api_ticket';
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
     * 获取非自定义CODE微信卡券领券地址
     * @param $card_id
     * @param $redirect_uri
     * @param $redirect_uri_name
     * @param $main_color
     * @param $show_btn
     * @param int $outer_id
     * @return array
     */
    public function setWxCardCodeDrawboardData($card_id, $redirect_uri, $redirect_uri_name, $main_color, $show_btn, $outer_id = 0){
        $this->_interface = 'set_wxcard_code_drawboard_data';
        $post_data = array(
            'card_id'           => $card_id,
            'redirect_uri'      => $redirect_uri,
            'redirect_uri_name' => $redirect_uri_name,
            'main_color'        => $main_color,
            'show_btn'          => $show_btn,
            'outer_id'          => $outer_id,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 获取自定义CODE微信卡券领券地址接口
     * @param $code
     * @param $redirect_uri
     * @param $redirect_uri_name
     * @param $main_color
     * @param int $outer_id
     * @return array
     */
    public function setWxCardDrawboardData($code, $redirect_uri, $redirect_uri_name, $main_color, $outer_id = 0){
        $this->_interface = 'set_wxcard_drawboard_data';
        $post_data = array(
            'code'              => $code,
            'redirect_uri'      => $redirect_uri,
            'redirect_uri_name' => $redirect_uri_name,
            'main_color'        => $main_color,
            'outer_id'          => $outer_id,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 生成微信JS领取卡券需要的JSON参数接口
     * @param $code
     * @param $card_id
     * @param int $outer_id
     * @return array
     */
    public function generateCardParam($code, $card_id, $outer_id = 1){
        $this->_interface = 'generate_card_param';
        $post_data = array(
            'code'      => $code,
            'card_id'   => $card_id,
            'outer_id'  => $outer_id,
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

    /**
     * 核销微信卡券接口
     * @param $code
     * @param $card_id
     * @return array
     */
    public function consumeCardCode($code, $card_id){
        $this->_interface = 'consume_card_code';
        $post_data = array(
            'code'      => $code,
            'card_id'   => $card_id,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 下载微信媒体文件并上传至又拍云接口
     * @param $media_id
     * @return array
     */
    public function downloadMedia($media_id){
        $this->_interface = 'download_media';
        $post_data = array(
            'media_id' => $media_id,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 下载微信语音文件并上传至又拍云转码为MP3接口（异步转码）
     * @param $media_id
     * @param string $notify_url
     * @return array
     */
    public function downLoadAmrToMp3($media_id, $notify_url = ''){
        $this->_interface = 'download_amr_to_mp3';
        $post_data = array(
            'media_id'      => $media_id,
            'notify_url'    => $notify_url,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 查询又拍云转码进度接口
     * @param $media_id
     * @return array
     */
    public function checkUpyunStatus($media_id){
        $this->_interface = 'check_upyun_status';
        $post_data = array(
            'media_id'   => $media_id,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 设置微信卡券失效接口
     * @param $code
     * @param $card_id
     * @return array
     */
    public function abrogateCardCode($code, $card_id){
        $this->_interface = 'abrogate_card_code';
        $post_data = array(
            'code'      => $code,
            'card_id'   => $card_id,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 解密微信卡券跳转的加密参数接口
     * @param $encrypt_code
     * @return array
     */
    public function decryptCardCode($encrypt_code){
        $this->_interface = 'decrypt_card_code';
        $post_data = array(
            'encrypt_code'  => $encrypt_code,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 获取微信卡券下的卡号列表接口
     * @param $open_id
     * @param $card_id
     * @return array
     */
    public function getCardList($open_id, $card_id){
        $this->_interface = 'get_card_list';
        $post_data = array(
            'open_id'   => $open_id,
            'card_id'   => $card_id,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 生成微信二维码接口
     * @param $scene_id
     * @param $qrcode_type string TMP：临时二维码 LIMIT: 永久二维码 LIMIT_STR： 永久字符串二维码
     * @param $expire_seconds
     * @return array
     */
    public function generateQrCode($scene_id, $qrcode_type, $expire_seconds){
        $this->_interface = 'generate_qrcode';
        $post_data = array(
            'scene_id'          => $scene_id,
            'qrcode_type'       => $qrcode_type,
            'expire_seconds'    => $expire_seconds,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 发送微信客服消息接口
     * @param $msg_data
     * @return array
     */
    public function customMsgSend($msg_data){
        $this->_interface = 'custom_msg_send';
        $post_data = array(
            'msg_data'          => $msg_data,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 获取摇一摇相关信息
     * @param $ticket
     * @return array
     */
    public function getShakeInfo($ticket){
        $this->_interface = 'get_shake_info';
        $post_data = array(
            'ticket'            => $ticket,
        );
        return $this->postRequest($post_data);
    }
}