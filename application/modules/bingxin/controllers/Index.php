<?php
/**
 * Created by PhpStorm.
 * User: PeterLeng
 * Date: 2018/5/25
 * Time: 17:18
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends MX_Controller
{

    public function __construct()
    {

        parent::__construct();
//        $this->load->service('welcome_service');
//        $this->load->model('article');
        $this->load->model('welcome/article');
        $this->load->module('welcome/welcome');
        $this->load->module('welcome/test');
    }

    public function index()
    {
        modules::run('welcome/welcome/runTest');
//        $user = $this->welcome_service->index(1);
//        $user = $this->article->get_user_info_by_id(4);
        $user = $this->welcome->get_welcome_info();
        $test = $this->test->getTest();
//        $this->controller->index();
        $this->twig->display('bingxin/views/index.html', ['name' => $user,'test'=>$test]);
    }

}
