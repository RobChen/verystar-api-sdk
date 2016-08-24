<?php
/**
 * Created by PhpStorm.
 * User: Rob
 * Date: 15-6-15
 * Time: 下午3:06
 * To change this template use File | Settings | File Templates.
 */

namespace rob\ApiSdk;
use rob\ApiSdkHelper\Singleton;

class CreditStoreApi{
    private $_client_code;
    private $_client_secret;
    private $_interface;
    private $_interface_group = 'credits_store/';

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
     * 获取分类下的商品列表接口
     * @param $category_id
     * @param int $cur_page
     * @param int $limit
     * @return array
     */
    public function getPurchaseByCategory($category_id, $cur_page = 1, $limit = 10){
        $this->_interface = 'get_purchase_by_category';
        $post_data = array(
            'category_id'   => $category_id,
            'cur_page'      => $cur_page,
            'limit'         => $limit,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 获取商品详情接口
     * @param $purchase_id
     * @return array
     */
    public function getPurchaseInfo($purchase_id){
        $this->_interface = 'get_purchase_info';
        $post_data = array(
            'purchase_id'   => $purchase_id,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 兑换商品接口
     * @param $open_id
     * @param $purchase_id
     * @return array
     */
    public function exchangePurchase($open_id, $purchase_id){
        $this->_interface = 'exchange_purchase';
        $post_data = array(
            'open_id'       => $open_id,
            'purchase_id'   => $purchase_id,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 商品兑换冲正接口
     * @param $open_id
     * @param $order_sn
     * @return array
     */
    public function flushesExchange($open_id, $order_sn){
        $this->_interface = 'flushes_exchange';
        $post_data = array(
            'open_id'       => $open_id,
            'order_sn'      => $order_sn,
        );
        return $this->postRequest($post_data);
    }
}