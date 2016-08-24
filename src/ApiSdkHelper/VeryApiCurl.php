<?php
/**
 * Created by VeryStar.
 * User: Rob
 * Date: 2016/6/30
 * Time: 13:43
 */

namespace rob\ApiSdkHelper;

class VeryApiCurl{
    private $_client_code;
    private $_client_secret;
    private $_interface_uri;
    private $_verystar_api_uri = 'http://hiproapi.verystar.cn/';

    public function setClientCode($client_code){
        $this->_client_code     = $client_code;
    }

    public function setClientSecret($client_secret){
        $this->_client_secret   = $client_secret;
    }

    public function setIterfaceUri($interface_uri){
        $this->_interface_uri   = $interface_uri;
    }

    public function postVeryApiRequest($post_data){
        $post_data['req_time']      = time();
        $post_data['client_code']   = $this->_client_code;
        $tmp_data = $post_data;
        $tmp_data['client_secret']  = $this->_client_secret;
        ksort($tmp_data);
        $tmp_str = '';
        foreach ($tmp_data as $v) {
            if (!is_array($v)) {
                $tmp_str .= $v;
            }
        }
        $auth_code = md5($tmp_str);
        $url = $this->_verystar_api_uri . $this->_interface_uri . "?authcode=" . $auth_code;
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_TIMEOUT, 3);
        if ($post_data) {
            curl_setopt($curl, CURLOPT_POST, 1);
            $post_data = http_build_query($post_data);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        }
        $ret = curl_exec($curl);
        curl_close($curl);
        return json_decode($ret, true);
    }

    public function postVeryApiFileRequest($post_data){
        $head_data['req_time']      = time();
        $head_data['client_code']   = $this->_client_code;
        $tmp_data = $head_data;
        $tmp_data['client_secret']  = $this->_client_secret;
        ksort($tmp_data);
        $tmp_str = '';
        foreach ($tmp_data as $v) {
            if (!is_array($v)) {
                $tmp_str .= $v;
            }
        }
        $auth_code = md5($tmp_str);
        $head_data['authcode'] = $auth_code;
        $url = $this->_verystar_api_uri . $this->_interface_uri;
        $headers = array();
        foreach( $head_data as $n => $v ) {
           $headers[] = $n .':' . $v;
        }
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HEADER, 0);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
        if ($post_data) {
            curl_setopt($curl, CURLOPT_POST, 1);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $post_data);
        }
        $ret = curl_exec($curl);
        return json_decode($ret, true);
    }
}