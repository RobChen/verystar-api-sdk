<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 16/8/22
 * Time: 下午1:49
 */

namespace rob\ApiSdk;
use rob\ApiSdkHelper\Singleton;

class WechatMcardApi{
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
     * 激活微信会员卡接口
     * @param $membership_number
     * @param $code
     * @param $card_id
     * @param $ext_data
     * @return array
     */
    public function membercardActive($membership_number, $code, $card_id, $ext_data){
        $this->_interface = 'membercard_active';
        $post_data = array(
            'membership_number' => $membership_number,
            'code'              => $code,
            'card_id'           => $card_id,
        );
        if(isset($ext_data['init_bonus'])){
            $post_data['init_bonus']                = $ext_data['init_bonus'];
        }
        if(isset($ext_data['init_balance'])){
            $post_data['init_balance']              = $ext_data['init_balance'];
        }
        if(isset($ext_data['init_custom_field_value1'])){
            $post_data['init_custom_field_value1']  = $ext_data['init_custom_field_value1'];
        }
        if(isset($ext_data['init_custom_field_value2'])){
            $post_data['init_custom_field_value2']  = $ext_data['init_custom_field_value2'];
        }
        if(isset($ext_data['init_custom_field_value3'])){
            $post_data['init_custom_field_value3']  = $ext_data['init_custom_field_value3'];
        }
        if(isset($ext_data['activate_begin_time'])){
            $post_data['activate_begin_time']       = $ext_data['activate_begin_time'];
        }
        if(isset($ext_data['activate_end_time'])){
            $post_data['activate_end_time']         = $ext_data['activate_end_time'];
        }
        return $this->postRequest($post_data);
    }

    /**
     * 更新微信会员卡信息接口
     * @param $code
     * @param $card_id
     * @param $ext_data
     * @return array
     */
    public function memberCardUpdate($code, $card_id, $ext_data){
        $this->_interface = 'membercard_update';
        $post_data = array(
            'code'              => $code,
            'card_id'           => $card_id,
        );
        if(isset($ext_data['add_bonus'])){
            $post_data['add_bonus']                 = $ext_data['add_bonus'];
        }
        if(isset($ext_data['add_balance'])){
            $post_data['add_balance']               = $ext_data['add_balance'];
        }
        if(isset($ext_data['bonus'])){
            $post_data['bonus']                     = $ext_data['bonus'];
        }
        if(isset($ext_data['balance'])){
            $post_data['balance']                   = $ext_data['balance'];
        }
        if(isset($ext_data['record_bonus'])){
            $post_data['record_bonus']              = $ext_data['record_bonus'];
        }
        if(isset($ext_data['record_balance'])){
            $post_data['record_balance']            = $ext_data['record_balance'];
        }
        if(isset($ext_data['activate_end_time'])){
            $post_data['activate_end_time']         = $ext_data['activate_end_time'];
        }
        if(isset($ext_data['init_custom_field_value1'])){
            $post_data['init_custom_field_value1']  = $ext_data['init_custom_field_value1'];
        }
        if(isset($ext_data['init_custom_field_value2'])){
            $post_data['init_custom_field_value2']  = $ext_data['init_custom_field_value2'];
        }
        if(isset($ext_data['init_custom_field_value3'])){
            $post_data['init_custom_field_value3']  = $ext_data['init_custom_field_value3'];
        }
        return $this->postRequest($post_data);
    }

    /**
     * 拉取会员信息接口
     * @param $code
     * @param $card_id
     * @return array
     */
    public function memberCardGetUserInfo($code, $card_id){
        $this->_interface = 'membercard_get_user_info';
        $post_data = array(
            'code'      => $code,
            'card_id'   => $card_id,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 获取用户激活会员卡提交资料接口
     * @param $activate_ticket
     * @return array
     */
    public function membercardActivateTempInfo($activate_ticket){
        $this->_interface = 'membercard_activate_temp_info';
        $post_data = array(
            'activate_ticket'      => $activate_ticket,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 支付即会员规则接口
     * @param $card_id
     * @param $jump_url
     * @param $mchid_list
     * @param $begin_time
     * @param $end_time
     * @param $min_cost
     * @param $max_cost
     * @param bool $is_locked
     * @return array
     */
    public function payGiftMemberCardAdd($card_id, $jump_url, $mchid_list, $begin_time, $end_time, $min_cost, $max_cost, $is_locked = true){
        $this->_interface = 'pay_gift_membercard_add';
        $post_data = array(
            'add_data'          => json_encode(array(
                'card_id'       => $card_id,
                'jump_url'      => $jump_url,
                'mchid_list'    => $mchid_list,
                'begin_time'    => $begin_time,
                'end_time'      => $end_time,
                'min_cost'      => $min_cost,
                'max_cost'      => $max_cost,
                'is_locked'     => $is_locked,
            ), JSON_UNESCAPED_UNICODE),
        );
        return $this->postRequest($post_data);
    }

    /**
     * 删除支付即会员规则接口
     * @param $card_id
     * @param $mchid_list
     * @return array
     */
    public function payGiftMembercardDelete($card_id, $mchid_list){
        $this->_interface = 'pay_gift_membercard_delete';
        $post_data = array(
            'delete_data'       => json_encode(array(
                'card_id'       => $card_id,
                'mchid_list'    => $mchid_list,
            ), JSON_UNESCAPED_UNICODE),
        );
        return $this->postRequest($post_data);
    }

    /**
     * 查询商户号支付即会员规则接口
     * @param $mchid
     * @return array
     */
    public function payGiftMembercardGet($mchid){
        $this->_interface = 'pay_gift_membercard_get';
        $post_data = array(
            'get_data'      => json_encode(array(
                'mchid'     => $mchid,
            ), JSON_UNESCAPED_UNICODE),
        );
        return $this->postRequest($post_data);
    }
}