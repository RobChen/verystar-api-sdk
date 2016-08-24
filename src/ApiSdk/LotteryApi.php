<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 14-12-15
 * Time: 下午1:26
 * To change this template use File | Settings | File Templates.
 */

namespace rob\ApiSdk;
use rob\ApiSdkHelper\Singleton;

class LotteryApi{
    private $_client_code;
    private $_client_secret;
    private $_interface;
    private $_interface_group = 'lottery/';

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
     * 概率抽奖接口
     * @param $open_id
     * @param $event_id
     * @return array
     */
    public function lotteryReward($open_id, $event_id){
        $this->_interface = 'lottery_reward';
        $post_data = array(
            'open_id'       => $open_id,
            'event_id'      => $event_id,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 序列抽奖接口
     * @param $open_id
     * @param $event_id
     * @return array
     */
    public function lotteryOptionReward($open_id, $event_id){
        $this->_interface = 'lottery_option_reward';
        $post_data = array(
            'open_id'       => $open_id,
            'event_id'      => $event_id,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 获取活动详情接口
     * @param $event_id
     * @return array
     */
    public function GetLotteryEventInfo($event_id){
        $this->_interface = 'get_lottery_event_info';
        $post_data = array(
            'event_id'      => $event_id,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 获取奖品详情接口
     * @param $event_id
     * @return array
     */
    public function GetLotteryEventItemInfo($event_id){
        $this->_interface = 'get_lottery_event_item_info';
        $post_data = array(
            'event_id'      => $event_id,
        );
        return $this->postRequest($post_data);
    }
}