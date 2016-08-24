# 费芮API SDK

---

#### 此SDK基于composer进行安装

>根目录需包含index.php文件
>   include 'vendor/autoload.php';

#### 非composer方式使用
>如果以非composer方式使用，请自行提取src中的目录文件，并自行在代码中包含相关文件。

    
#### composer安装使用方式

    在文件头部引入需要使用的API SDK类库
        use rob\ApiSdk\EticketApi; //引入费芮电子券SDK类库
    实例化类库
        $_eticket_api       = new EticketApi(CLIENT_CODE, CLIENT_SECRET);
    调用
        $ticket_info        = $_eticket_api->grant($ticket_id, $open_id, $order_sn);
