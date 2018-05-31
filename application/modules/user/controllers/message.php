<?php

/**
 * Created by PhpStorm.
 * User: PeterLeng
 * Date: 2018/5/30
 * Time: 11:31
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class message extends Base
{
    function __construct()
    {
        parent::__construct();
    }

    public function help()
    {
        $myAdmin = $this->session->userdata('myadm');
        $username = $myAdmin['username'];
        $this->load->library('rtx');
        $this->rtx->makeRequest(array('receiver' => 'Messanger;' . $username, 'type' => 'rtx', 'title' => '测试第一次？', 'content' => '仅仅就是一次测试啦。'));
        redirect('welcome/index');
    }
}