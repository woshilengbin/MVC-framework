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
        $this->load->service('welcome/welcome_service');
        $this->load->model('welcome/article');
        $this->load->module('welcome/welcome');
        $this->load->module('welcome/test');
    }

    public function index()
    {
//        $user = $this->welcome_service->index(1);
        $user = $this->article->get_user_info_by_id(4);
//        $user = $this->welcome->get_welcome_info();
        $test = $this->test->getTest();
//        $this->controller->index();
        $this->twig->display('bingxin/views/index.html', ['name' => $user, 'test' => $test]);
    }

    public function serviceTest()
    {
        $user1 = $this->welcome_service->getAll(2, 5);
        $user2 = $this->welcome_service->get_article_info_by_id(2);
        var_dump($user1);
        var_dump($user2);
    }


    public function modelTest()
    {
        $user = $this->article->get_user_info_by_id(4);
        $user1 = $this->article->getAll(2, 5);
        var_dump($user);
        var_dump($user1);
    }

    public function controllerTest()
    {
        $this->welcome->runTest();
//        $this->twig->display('welcome/views/update.html');
    }


}
