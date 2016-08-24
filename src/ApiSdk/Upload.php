<?php
/**
 * Created by VeryStar.
 * User: Rob
 * Date: 2016/7/13
 * Time: 13:30
 */

namespace rob\ApiSdk;
use rob\ApiSdkHelper\Singleton;
use CURLFile;

class Upload{
    private $_client_code;
    private $_client_secret;
    private $_interface;
    private $_interface_group = 'upload_file/';

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
     * 向费芮接口发起上传文件POST请求私有方法
     * @param $post_data
     * @return array
     */
    private function postFileRequest($post_data){
        $interface_uri  = $this->_interface_group . $this->_interface;
        $_very_api_curl = Singleton::getClassInstance('rob\\ApiSdkHelper\\VeryApiCurl');
        $_very_api_curl->setClientCode($this->_client_code);
        $_very_api_curl->setClientSecret($this->_client_secret);
        $_very_api_curl->setIterfaceUri($interface_uri);
        return $_very_api_curl->postVeryApiFileRequest($post_data);
    }

    /**
     * 上传图片到又拍云
     * @param $image_path
     * @return array
     */
    public function uploadUpyunImageFile($image_path){
        $this->_interface = 'upyun_upload_pic_binary';
        $post_data = array(
            'pic_binary'    => new CURLFile($image_path),
        );
        return $this->postFileRequest($post_data);
    }

    /**
     * 上传文件到又拍云
     * @param $file_path
     * @return array
     */
    public function uploadUpyunFile($file_path){
        $this->_interface = 'upyun_upload_file';
        $post_data = array(
            'file_binary'   => new CURLFile($file_path),
        );
        return $this->postFileRequest($post_data);
    }

    /**
     * 上传文件到阿里云OSS
     * @param $file_path
     * @return array
     */
    public function uploadOssFile($file_path){
        $this->_interface = 'oss_upload_file_binary';
        $post_data = array(
            'file_binary'   => new CURLFile($file_path),
        );
        return $this->postFileRequest($post_data);
    }
}