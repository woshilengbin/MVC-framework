<?php

/**
 * Created by PhpStorm.
 * User: PeterLeng
 * Date: 2018/5/28
 * Time: 9:58
 */
include_once APPPATH . 'core/MY_service.php';

class Welcome_service extends MY_Service
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('article');
    }

    public function index($id)
    {
//        log_message('debug',$id.'11111111111111111111111111111111111111');
        $user = $this->article->get_user_info_by_id($id);
        return $user;
    }
}