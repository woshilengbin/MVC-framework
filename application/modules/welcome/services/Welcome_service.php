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
        $this->load->model('Article.bak');
    }

    public function index($id)
    {
        $user = $this->article->get_user_info_by_id($id);
        return $user;
    }
}