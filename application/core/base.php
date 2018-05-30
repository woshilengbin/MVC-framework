<?php

/**
 * Created by PhpStorm.
 * User: PeterLeng
 * Date: 2018/5/29
 * Time: 10:16
 */
class Base extends MX_Controller
{
    function __construct()
    {
        $this->load->helper('url');
        parent::__construct();
        $myadmin = $this->session->userdata('myadm');
        $controller = $this->router->fetch_class();
        $method = $this->router->fetch_method();
        $tiaoshi = $this->input->get('tiaoshi');    //方便接口调试工具使用
        if (!$myadmin && ($controller != 'user' || $method != 'login') && $tiaoshi != 1) {
            redirect('user/login');
        }
    }
}