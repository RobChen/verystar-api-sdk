# 费芮API SDK

---
    
#### 使用方式

    在文件头部引入需要使用的API SDK类库
        use rob\ApiSdk\EticketApi; //引入费芮电子券SDK类库
    实例化类库
        $_eticket_api       = new EticketApi(CLIENT_CODE, CLIENT_SECRET);
    调用
        $ticket_info        = $_eticket_api->grant($ticket_id, $open_id, $order_sn);
