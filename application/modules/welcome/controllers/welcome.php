<?php
/**
 * Created by PhpStorm.
 * User: PeterLeng
 * Date: 2018/5/25
 * Time: 17:18
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends MX_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->service('welcome', 'welcome_service');
//        $this->load->model('article');
    }

    public function index()
    {
        $user = $this->welcome_service->index(1);
        $this->twig->display('welcome/views/welcome_message.html', ['name' => $user]);
    }

    public function get_welcome_info()
    {
        $user = $this->article->get_user_info_by_id(1);
        return $user;
    }

    public function runTest()
    {
        echo '<h1>this is a run test!</h1>';
        $user = $this->article->get_user_info_by_id(1);
        $this->twig->display('welcome/views/welcome_message.html');
    }
}
