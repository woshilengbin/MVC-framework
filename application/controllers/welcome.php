<?php
/**
 * Created by PhpStorm.
 * User: PeterLeng
 * Date: 2018/5/25
 * Time: 17:18
 */
defined('BASEPATH') OR exit('No direct script access allowed');

class Welcome extends CI_Controller
{

    public function __construct()
    {

        parent::__construct();
        $this->load->service('welcome_service');
    }

    public function index()
    {
        $user = $this->welcome_service->index(2);
        $this->twig->display('welcome_message.html', ['name'=>$user]);
    }

}
