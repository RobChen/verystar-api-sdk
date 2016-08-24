<?php
/**
 * Created by VeryStar.
 * User: Rob
 * Date: 2016/7/13
 * Time: 15:56
 */

namespace rob\ApiSdk;
use rob\ApiSdkHelper\Singleton;

class UploadImage{
    private $_client_code;
    private $_client_secret;
    private $_interface;
    private $_interface_group = 'upload_image/';

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
     * 图片增加水印
     * @param $file_url
     * @param $text
     * @param string $font
     * @param string $size
     * @param string $align
     * @param string $margin
     * @param string $opacity
     * @param string $color
     * @param string $border
     * @return array
     */
    public function uploadUpyunPicAddWatermark($file_url, $text, $font = '', $size = '', $align = '', $margin = '', $opacity = '', $color = '', $border = ''){
        $this->_interface = 'upyun_upload_pic_add_watermark';
        $post_data = array(
            'file_url'  => $file_url,
            'text'      => $text,
            'font'      => $font,
            'size'      => $size,
            'align'     => $align,
            'margin'    => $margin,
            'opacity'   => $opacity,
            'color'     => $color,
            'border'    => $border,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 上传base64编码图片到又拍云
     * @param $pic_data
     * @param $pic_type
     * @return array
     */
    public function uploadUpyunPicBase64($pic_data, $pic_type){
        $this->_interface = 'upyun_upload_pic_base64';
        $post_data = array(
            'pic_data'  => $pic_data,
            'pic_type'  => $pic_type,
        );
        return $this->postRequest($post_data);
    }

    /**
     * 上传base64编码图片到阿里云OSS
     * @param $pic_data
     * @param $pic_type
     * @param string $folder_name
     * @return array
     */
    public function uploadOssPicBase64($pic_data, $pic_type, $folder_name = ''){
        $this->_interface = 'oss_upload_pic_base64';
        $post_data = array(
            'pic_data'      => $pic_data,
            'pic_type'      => $pic_type,
            'folder_name'   => $folder_name,
        );
        return $this->postRequest($post_data);
    }
}