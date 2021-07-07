<?php

/**
 * @author Ravi Tamada
 * @link URL Tutorial link
 */
class Push {

    // push message title
    private $title;
    private $message;
    private $image;
    // push message payload
    private $data;
    private $order_id;
    private $status;
    // flag indicating whether to show the push
    // notification or not
    // this flag will be useful when perform some opertation
    // in background when push is recevied
    private $is_background;

    function __construct() {
        
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function setOrderID($order_id) {
        $this->order_id = $order_id;
    }

    public function setstatus($status) {
        $this->status = $status;
    }

    public function setImage($imageUrl) {
        $this->image = $imageUrl;
    }

    public function setPayload($data) {
        $this->data = $data;
    }

    public function job_detail($data) {
        $this->job_detail = $data;
    }

    public function setIsBackground($is_background) {
        $this->is_background = $is_background;
    }

    public function getPush() {
        $res = array();
        $res['data']['order_id'] = $this->order_id;
        $res['data']['status'] = $this->status;
        $res['data']['title'] = $this->title;
        $res['data']['is_background'] = $this->is_background;
        $res['data']['message'] = $this->message;
        $res['data']['image'] = $this->image;
        $res['data']['payload'] = $this->data;
        $res['data']['job_detail'] = $this->job_detail;
        $res['data']['timestamp'] = date('Y-m-d G:i:s');
        return $res;
    }

}
