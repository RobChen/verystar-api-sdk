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

class EticketApi{
    private $_client_code;
    private $_client_secret;
    private $_interface;
    private $_interface_group = 'eticket/';

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
     * 获取电子券号接口
     * @param $ticket_id
     * @param $open_id
     * @param $order_sn
     * @param int $grant_num
     * @param string $callback_url
     * @return array
     */
    public function grant($ticket_id, $open_id, $order_sn, $grant_num = 1, $callback_url = ''){
        $this->_interface = 'grant';
        $post_data = array(
            'ticket_id'     => $ticket_id,
            'open_id'       => $open_id,
            'order_sn'      => $order_sn,
            'grant_num'     => $grant_num,
            'callback_url'  => $callback_url,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 核销电子券号接口
     * @param $ticket_code
     * @param $store_serial
     * @return array
     */
    public function verify($ticket_code, $store_serial){
        $this->_interface = 'verify';
        $post_data = array(
            'ticket_code'   => $ticket_code,
            'store_serial'  => $store_serial,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 设置电子券为转赠中的状态接口
     * @param $ticket_code
     * @param $open_id
     * @return array
     */
    public function setPresentStatus($ticket_code, $open_id){
        $this->_interface = 'set_presenting_status';
        $post_data = array(
            'ticket_code'   => $ticket_code,
            'open_id'       => $open_id,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 取消电子券的转赠中状态接口
     * @param $ticket_code
     * @param $open_id
     * @return array
     */
    public function cancelPresentStatus($ticket_code, $open_id){
        $this->_interface = 'cancel_presenting_status';
        $post_data = array(
            'ticket_code'   => $ticket_code,
            'open_id'       => $open_id,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 冻结电子券接口
     * @param $ticket_code
     * @param $open_id
     * @return array
     */
    public function setFreezeStatus($ticket_code, $open_id){
        $this->_interface = 'set_freeze_status';
        $post_data = array(
            'ticket_code'   => $ticket_code,
            'open_id'       => $open_id,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 取消冻结电子券接口
     * @param $ticket_code
     * @param $open_id
     * @return array
     */
    public function setUnfreezeStatus($ticket_code, $open_id){
        $this->_interface = 'set_unfreeze_status';
        $post_data = array(
            'ticket_code'   => $ticket_code,
            'open_id'       => $open_id,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 转赠电子券接口
     * @param $ticket_code
     * @param $to_open_id
     * @param $from_open_id
     * @return array
     */
    public function present($ticket_code, $to_open_id, $from_open_id){
        $this->_interface = 'present';
        $post_data = array(
            'ticket_code'   => $ticket_code,
            'to_open_id'    => $to_open_id,
            'from_open_id'  => $from_open_id,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 获取用户的电子券列表接口
     * @param $open_id
     * @param $tpl_id
     * @param int $start
     * @param int $end
     * @return array
     */
    public function getUserTickets($open_id, $tpl_id, $start = 0, $end = 25){
        $this->_interface = 'get_user_tickets';
        $post_data = array(
            'open_id'       => $open_id,
            'tpl_id'        => $tpl_id,
            'start'         => $start,
            'end'           => $end,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 获取用户已使用的电子券列表接口
     * @param $open_id
     * @param $tpl_id
     * @param int $start
     * @param int $end
     * @return array
     */
    public function getUserUsedTickets($open_id, $tpl_id, $start = 0, $end = 25){
        $this->_interface = 'get_user_used_tickets';
        $post_data = array(
            'open_id'       => $open_id,
            'tpl_id'        => $tpl_id,
            'start'         => $start,
            'end'           => $end,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 获取用户的电子券信息接口
     * @param $open_id
     * @param $ticket_code
     * @return array
     */
    public function getUserTicket($open_id, $ticket_code){
        $this->_interface = 'get_user_ticket';
        $post_data = array(
            'open_id'       => $open_id,
            'ticket_code'   => $ticket_code,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 根据trand id查询电子券号生成进度接口
     * @param $trand_id
     * @return array
     */
    public function queryTransId($trand_id){
        $this->_interface = 'query_transid';
        $post_data = array(
            'trand_id'  => $trand_id,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 根据电子券号获取电子券信息接口
     * @param $ticket_code
     * @return array
     */
    public function GetUserTicketByCode($ticket_code){
        $this->_interface = 'get_user_ticket_by_code';
        $post_data = array(
            'ticket_code'   => $ticket_code,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 获取电子券信息
     * @param $ticket_id
     * @return array
     */
    public function GetTicketInfo($ticket_id){
        $this->_interface = 'get_ticket_info';
        $post_data = array(
            'ticket_id'     => $ticket_id,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 获取电子券模板信息
     * @param $tpl_id
     * @return array
     */
    public function getTicketTplInfo($tpl_id){
        $this->_interface = 'get_ticket_tpl_info';
        $post_data = array(
            'tpl_id'    => $tpl_id,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 补单核销接口
     * @param $ticket_code
     * @param $store_serial
     * @return array
     */
    public function replenish($ticket_code, $store_serial){
        $this->_interface = 'replenish';
        $post_data = array(
            'ticket_code'   => $ticket_code,
            'store_serial'  => $store_serial,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 删除用户电子券接口
     * @param $open_id
     * @param $ticket_code
     * @return array
     */
    public function deleteTicket($open_id, $ticket_code){
        $this->_interface = 'delete_ticket';
        $post_data = array(
            'open_id'       => $open_id,
            'ticket_code'   => $ticket_code,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 导入第三方券号接口
     * @param $ticket_id
     * @param $codes
     * @return array
     */
    public function importTicketCodes($ticket_id, $codes){
        $this->_interface = 'import_ticket_codes';
        $post_data = array(
            'ticket_id'     => $ticket_id,
            'codes'         => $codes,
        );
        return $this->postRequest($post_data);
    }
}